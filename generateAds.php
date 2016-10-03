<?php

$tag = explode("$", $_GET['tags'])[1];
$data = "{\"data\" : [";
$content = simplexml_load_string(file_get_contents("http://svcs.sandbox.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=Gurpreet-Picandy-SBX-a2f5817e2-9d000f93&RESPONSE-DATA-FORMAT=XML&REST-PAYLOAD&keywords=$tag"));

for ($i = 0; $i < 4; $i += 1) {
    $url = $content->searchResult->item[$i]->viewItemURL;
    $title = $content->searchResult->item[$i]->title;

    $data = $data . "{\"url\" : \"$url\", \"title\" : \"$title\"}, ";
}

$data = substr($data, 0, -2) . "]}";
echo $data;