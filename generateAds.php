<?php

$tags = explode("$", $_GET['tags']);
$data = "{\"data\" : [";

foreach ($tags as $tag) {
    if ($tag != "") {
        $content = simplexml_load_string(file_get_contents("http://svcs.sandbox.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsByKeywords&SERVICE-VERSION=1.0.0&SECURITY-APPNAME=Gurpreet-Picandy-SBX-a2f5817e2-9d000f93&RESPONSE-DATA-FORMAT=XML&REST-PAYLOAD&keywords=$tag"));
        $image = $content->searchResult->item[0]->galleryURL;
        $url = $content->searchResult->item[0]->viewItemURL;
        $title = $content->searchResult->item[0]->title;

//        echo "<div class='image-ad'><a href='$url'>$title</a></div>";
        $data = $data . "{\"url\" : \"$url\", \"title\" : \"$title\"}, ";
    }
}

$data = substr($data, 0, -2) . "]}";
echo $data;