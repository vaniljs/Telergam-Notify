<?php

$url = "http://api.sypexgeo.net/json/".$_SERVER['REMOTE_ADDR'];
$data = @file_get_contents($url);
$geo = json_decode( $data, true );

require_once('idna_convert.class.php');
$converter = new idna_convert();
$domain = $converter->decode($_SERVER['HTTP_HOST']);
$url = 'https://api.telegram.org/bot<TOKEN_BOT>/sendMessage';
$params = array(
    'chat_id' => '<ID_ACCOUN_OR_NAME_CHANNEL>',
    // How to know channel_id
    // https://api.telegram.org/bot<YourBOTToken>/getUpdates 
    
    'disable_web_page_preview' => 'True',
    'parse_mode' => 'HTML',
    'text' => "<b>От</b>: " .
        $domain
            . " \n \n " .
        $_POST["Имя"]
            . " \n " .
        $_POST["Фамилия"]
            . "  \n " .
        $_POST["Телефон"]
            . "  \n\n <i>".
        $_SERVER['REMOTE_ADDR']
            . "  \n " .
        $geo['city']['name_ru']
            . ", " .
        $geo['region']['name_ru']
            . ", " .
        $geo['country']['name_ru']
            . "</i>",
);
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
    'method'  => 'POST',
    'header'  => 'Content-type: application/x-www-form-urlencoded',
    'content' => http_build_query($params)
)
)));
?>
