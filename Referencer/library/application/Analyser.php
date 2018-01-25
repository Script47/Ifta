<?php

class Analyser {
    
    /**
     * Make everything lowercase.
     * Remove everything EXCEPT alpha characters and spaces.
     * Split the string based on spaces.
     * Remove empty values from an array.
     * Then rejoin the array values with a ',' and QUOTE for the IN clause.
     */
    public static function clean(string $string) : string
    {
        $words = array_filter(explode(' ', preg_replace('#[^[:alpha:][:space:]]#', '', strtolower($string))));
        $str = '';
        $count = 0;

        foreach ($words as $word) {
            if (count($words) - 1 === $count) {
                $str .= Database::quote($word);
            } else {
                $str .= Database::quote($word) . ',';
            }

            $count++;
        }

        return $str;
    }

    public static function find(string $string)
    {
        $cleaned = self::clean($string);
        $find_keywords = Database::run('SELECT k.id AS `keyword_id`, r.id AS `reference_id`, k.word, b.id AS `book_id`, r.page_from, r.page_to, b.name, b.author, b.language FROM keyword k LEFT JOIN reference r ON k.reference_id = r.id LEFT JOIN book b ON b.id = r.book_id WHERE k.word IN (' . $cleaned . ')');

        while ($keyword = $find_keywords->fetch()) {
            $string = preg_replace_callback('/' . $keyword->word . '/i', function ($m) use ($keyword) {
                return '<a href="javascript:void(0);" data-book="' . $keyword->name . '" data-page-from="' . $keyword->page_from . '" data-page-to="' . $keyword->page_to . '" data-author="' . $keyword->author . '">' . $m[0] . '</a>';
            }, $txt);
        }

        return $string;
    }
}