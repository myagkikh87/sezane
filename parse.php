<?php
require_once('include/function.php');

$source = 'include/file.html';

$html = getSourceHtml($source);
$urlItems = getItemUrl($html);
$idItems = getItemId($urlItems);
$idUrl = array_combine($idItems, $urlItems);
    foreach ($idUrl as $id => $url) {
        checkAndSaveItems($id, $url);
}


