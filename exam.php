<?php

function scientificNotationName(int $key)
{
    $notations = [
        3 => 'HUNDRED',
        4 => 'THOUSAND',
        5 => 'THOUSAND', //TEN
        6 => 'HUNDRED THOUSAND',
        7 => 'MILLION',
        8 => 'MILLION', //TEN
        9 => 'HUNDRED MILLION',
        10 => 'BILLION'
    ];

    return $notations[$key];
}

function numberNames(int $number)
{
    $ones = [
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

    $tens = [
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

    if (strlen($number) == 2) {
        if (str_split($number)[0] == 1) {
            return $tens[$number];
        }

        if (str_split($number)[0] == 2) {
            return twenty($number);
        }

        if (str_split($number)[0] == 3) {
            return thirty($number);
        }
    }

    return $ones[$number];
}

function twenty(int $number)
{
    $digits = str_split($number);

    if ($number == 20) {
        return 'TWENTY';
    }

    return 'TWENTY ' . numberNames(number: $digits[1]);
}

function thirty(int $number)
{
    $digits = str_split($number);

    if ($number == 30) {
        return 'THIRTY';
    }

    return 'THIRTY ' . numberNames(number: $digits[1]);
}

function firstGroup(int $number): string
{
    $length = strlen($number);

    $mainNotation = scientificNotationName(key: $length);

    $firstGroup = backToString(groupNumbers($number)[0]);

    return numberNames($firstGroup) . ' ' . $mainNotation;
}

function secondGroup($number)
{
    $secondGroup = omitZero(backToString(groupNumbers($number)[1]));
    $thirdGroup = backToString(groupNumbers($number)[2]);
    $length = strlen($secondGroup . $thirdGroup);
    $notation = scientificNotationName($length);

    return numberNames($secondGroup) . ' ' . $notation;
}

function groupNumbers($number)
{
    $reverseOrder = strrev($number);
    $toArray = str_split($reverseOrder);
    $toGroup = array_chunk($toArray, 3);
    // grouped in reverse order
    return array_reverse($toGroup);
}

function backToString($number)
{
    $string = implode('', $number);
    return strrev($string);
}

function omitZero($number)
{
    $toArray = str_split($number);
    if ($toArray[0] == 0) {
        return ltrim($number, '0');
    }

    return $number;
}

function numberToWords($number)
{
    $number = explode('.', $number);
    return firstGroup(number: $number[0]) . ' ' . secondGroup(number: $number[0]);
}

echo numberToWords(10002005.77);