<?php
$images = [
    'kei',
    'mayo',
    'midori',
    'midori1',
    'yukiyo',
    'tasogare',
    'tacuba',
    'mon',
    'miho'
];
function random_image($images){
    $i = random_int(0, count($images)-1);
    $selectedImage = "../albums/{$images[$i]}.jpg";
    return $selectedImage;
}