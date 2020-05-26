<?php

/**
 * @return false|string
 */
function getSourceHtml($source)
{
    $html = file_get_contents($source);
    return $html;
}

/**
 * @param $html
 * @return mixed
 */
function getItemUrl($html)
{
    preg_match_all('/class="free-productLink" href="(.*)">/im', $html, $url);
    unset($url[0]);
    $urlResult = array_shift($url);
    return $urlResult;
}

/**
 * @param $url
 * @return array
 */
function getItemId($url)
{
    foreach ($url as $value) {
        $urlLower = mb_strtolower(mb_eregi_replace("[^a-zа-яё0-9]", '', $value));
        $itemId[] = md5($urlLower);
    }
    return $itemId;
}

/**
 * @param $id
 * @param $url
 */
function checkAndSaveItems($id, $url)
{
    $file = file_get_contents('items.json');
    $items = json_decode($file,TRUE);
    if (array_key_exists($id, $items)) {
        echo "Товар уже есть: https://www.sezane.com $url <br>";
    } else {
        echo "Новый товар: https://www.sezane.com $url <br>";
        $items[$id] = $url;
        }
    file_put_contents('items.json', json_encode($items));
}