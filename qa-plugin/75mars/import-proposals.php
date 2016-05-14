<?php

if (php_sapi_name() !== 'cli') {
    exit(1);
}

require __DIR__ . '/../../qa-include/qa-base.php';

require_once QA_INCLUDE_DIR.'db/users.php';
require_once QA_INCLUDE_DIR.'app/users.php';
require_once QA_INCLUDE_DIR.'app/users-edit.php';
require_once QA_INCLUDE_DIR.'app/posts.php';

/* @link http://stackoverflow.com/questions/4356289/php-random-string-generator */
function generate_random_string($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$proposals = [];
if (($handle = fopen(__DIR__."/propositions.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        list($id, $title, $username, $email) = $data;
        $proposals[] = [
            'title' => ucfirst(strtolower($title)),
            'email' => $email,
            'username' => $username,
        ];
    }
    fclose($handle);
}

foreach ($proposals as $proposal) {
    $results = qa_db_user_find_by_email($proposal['email']);
    if (!empty($results)) {
        list($userid) = $results;
    } else {
        $password = generate_random_string();
        list($username, $domain) = explode('@', $proposal['email']);

        $userid = qa_create_new_user($proposal['email'], $password, $username);
        echo "{$proposal['email']} ({$username}) : {$password}\n";
    }
    qa_post_create('Q', null, $proposal['title'], '', $format = '', $categoryid = 2, $tags = null, $userid, $notify = null);
}
