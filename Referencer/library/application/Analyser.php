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

    public static function find(string $string) : string
    {
        $cleaned = self::clean($string);
        $find_keywords = Database::run('SELECT k.id AS `keyword_id`, r.id AS `reference_id`, k.word, b.id AS `book_id`, r.page_from, r.page_to, b.name, b.author, b.volume, b.language FROM keyword k LEFT JOIN reference r ON k.reference_id = r.id LEFT JOIN book b ON b.id = r.book_id WHERE k.word IN (' . $cleaned . ')');

        while ($keyword = $find_keywords->fetch()) {
            $string = preg_replace_callback('/' . $keyword->word . '/i', function ($m) use ($keyword) {
                $html = '<div align=left>';
                $html .= '<p><strong>Book:</strong> ' . $keyword->name . ' (' . $keyword->volume . ')</p>';
                $html .= '<p><strong>Author:</strong> ' . $keyword->author . '</p>';
                $html .= '<p><strong>Language:</strong> ' . $keyword->language . '</p>';
                $html .= '<p><strong>Page From:</strong> ' . $keyword->page_from . '</p>';
                $html .= '<p><strong>Page To:</strong> ' . $keyword->page_to . '</p>';                
                $html .= '</div>';

                return '<a href="javascript:void(0);" data-toggle="tooltip" title="' . $html . '">' . $m[0] . '</a>';
            }, $string);
        }

        return $string;
    }
}

?>