<?php

require_once('idna_convert.class.php');
$converter = new idna_convert();
$domain = $converter->decode($_SERVER['HTTP_HOST']);
$url = 'https://api.telegram.org/bot<TOKEN_BOT>/sendMessage';
$params = array(
    'chat_id' => '<ID_ACCOUN_OR_NAME_CHANNEL>',
    'disable_web_page_preview' => 'True',
    'text' => "От: " . $domain . " \n \n " . $_POST["Имя"] . " \n \n " . $_POST["Фамилия"] . "  \n\n " . $_POST["Телефон"],
);
$result = file_get_contents($url, false, stream_context_create(array(
    'http' => array(
    'method'  => 'POST',
    'header'  => 'Content-type: application/x-www-form-urlencoded',
    'content' => http_build_query($params)
)
)));
//echo $result;
?>