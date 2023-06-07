<?php

require_once "vendor/autoload.php";

$testNumbers = [
    100001.01,
    1789501.25,
    789481.00,
    2156175.50,
    1111111.11,
    10002005.77,
    99999999.99, //highest number that this script can handle
];

foreach ($testNumbers as $number) {
    echo (new \App\Controller\NumberController())->numberToWords(number: $number) . "<br>"; //<br> for rendering in html
}