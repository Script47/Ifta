<?php

require_once 'prepend.php';

if (isset($_POST['token']) && AjaxToken::verify($_POST['token'])) {
    if (isset($_POST['text']) && !empty(trim($_POST['text']))) {
        exit(json_encode([
            'success' => Analyser::find($_POST['text'])
        ]));
    }
}