<?php

//Use CURL to download, then you can use file_get_contents to save file on server, or you can use some headers to force download the file.

$urls = [
    'https://file1.mp3',
    'https://file2.mp3',
    //...
];
$i = 1;
foreach($urls as $url){

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_NOBODY, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 2);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    $output = curl_exec($ch);
    $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($status == 200) {
        file_put_contents(dirname(__FILE__) ."/$i.mp3", $output);
        $i++;
    }
}
