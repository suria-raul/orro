<?php

function scientificNotationName(int $number)
{
    $key = strlen($number);

    if ($key < 3) {
        return;
    }

    $notations = [
//        3 => 'HUNDRED',
        4 => 'THOUSAND',
        5 => 'THOUSAND', //TEN
        6 => 'THOUSAND', // HUNDRED
        7 => 'MILLION',
        8 => 'MILLION', //TENS MILLION. This is the limit, if you put number bigger than this the script will fail
    ];

    return $notations[$key];
}

function numberNames(int $number): string
{
    $ones = [
        0 => '',
        1 => 'ONE',
        2 => 'TWO',
        3 => 'THREE',
        4 => 'FOUR',
        5 => 'FIVE',
        6 => 'SIX',
        7 => 'SEVEN',
        8 => 'EIGHT',
        9 => 'NINE',
    ];

    if (strlen($number) == 2) {
        if (str_split($number)[0] == 1) {
            return teens(key: $number);
        }

        if (str_split($number)[0] > 1) {
            return tensToWords(number: $number);
        }

    } elseif (strlen($number) == 3) {
        if (str_split($number)[0] > 0) {
            return hundredsToWords(number: $number);
        }
    }

    return $ones[$number];
}

function teens(int $key): string
{
    $numbers = [
        10 => 'TEN',
        11 => 'ELEVEN',
        12 => 'TWELVE',
        13 => 'THIRTEEN',
        14 => 'FOURTEEN',
        15 => 'FIFTEEN',
        16 => 'SIXTEEN',
        17 => 'SEVENTEEN',
        18 => 'EIGHTEEN',
        19 => 'NINETEEN',
    ];

    return $numbers[$key];
}

function tensToWords(int $number): string
{
    $tens = [
        20 => 'TWENTY',
        30 => 'THIRTY',
        40 => 'FORTY',
        50 => 'FIFTY',
        60 => 'SIXTY',
        70 => 'SEVENTY',
        80 => 'EIGHTY',
        90 => 'NINETY',
    ];

    $digits = str_split($number);

    if ($digits[1] > 0) {
        $key = $digits[0] * 10;
        return $tens[$key] . ' ' . numberNames(number: $digits[1]);
    }

    return $tens[$number];
}

function hundredsToWords(int $number): string
{
    $hundreds = [
        100 => 'ONE HUNDRED',
        200 => 'TWO HUNDRED',
        300 => 'THREE HUNDRED',
        400 => 'FOUR HUNDRED',
        500 => 'FIVE HUNDRED',
        600 => 'SIX HUNDRED',
        700 => 'SEVEN HUNDRED',
        800 => 'EIGHT HUNDRED',
        900 => 'NINE HUNDRED',
    ];

    $digits = str_split($number);

    if ($digits[1] == 0 && $digits[2] > 0) {
        $key = $digits[0] * 100;
        return $hundreds[$key] . ' ' . numberNames(number: $digits[2]);
    }

    if ($digits[1] > 0 && $digits[2] > 0) {
        $key = $digits[0] * 100;
        return $hundreds[$key] . ' ' . numberNames(number: $digits[1] . $digits[2]);
    }

    return $hundreds[$number];
}

function cent(int $number): string
{
    return 'AND ' . numberNames(number: $number) . ' CENTS';
}

function groupNumbers(float|int $number): array
{
    $mainNumbers = explode('.', $number);
    $reverseOrder = strrev($mainNumbers[0]);
    $toArray = str_split($reverseOrder);
    $toGroup = array_chunk($toArray, 3);
    // grouped in reverse order
    $revGroup = array_reverse($toGroup);

    return array_map('backToString', $revGroup);
}

function backToString(array $number): string
{
    $string = implode('', $number);
    return strrev($string);
}

function omitPrefixZero(string $number): string
{
    $toArray = str_split($number);
    if ($toArray[0] == 0) {
        return ltrim($number, '0');
    }

    return $number;
}

function numberToWords(float|int $number): string
{
    $number = explode('.', $number);
    $words = [];
    $notations = [];

    $numberLength = strlen($number[0]);
    $numberArrLength = count(groupNumbers(number: $number[0]));
    $arrCopy = groupNumbers(number: $number[0]);
    for ($i = 0; $i < $numberArrLength;) {
        $notations[] = scientificNotationName(number: omitPrefixZero(number: substr($number[0], $i, $numberLength)));
        $i += strlen($arrCopy[$i]);
    }

    foreach (groupNumbers($number[0]) as $group) {
        $words[] = omitPrefixZero(number: numberNames($group));
    }

    $numberToWords = array_map(function ($word, $notation) {
        return $word . ' ' . $notation;
    }, $words, $notations);

    if (count($number) < 2) {
        return implode(' ', $numberToWords) . PHP_EOL;
    }

    return implode(' ', $numberToWords) . cent(number: $number[1]) . PHP_EOL;
}

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
    echo numberToWords(number: $number);
}