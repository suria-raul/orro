<?php

function scientificNotationName(int $number)
{
    $key = strlen($number);

    if ($key < 3) {
        return;
    }

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

        if (str_split($number)[0] == 4) {
            return forty($number);
        }

        if (str_split($number)[0] == 5) {
            return fifty($number);
        }

        if (str_split($number)[0] == 6) {
            return sixty($number);
        }

        if (str_split($number)[0] == 7) {
            return seventy($number);
        }

        if (str_split($number)[0] == 8) {
            return eighty($number);
        }

        if (str_split($number)[0] == 9) {
            return ninety($number);
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

function forty(int $number)
{
    $digits = str_split($number);

    if ($number == 40) {
        return 'FORTY';
    }

    return 'FORTY ' . numberNames(number: $digits[1]);
}

function fifty(int $number)
{
    $digits = str_split($number);

    if ($number == 50) {
        return 'FIFTY';
    }

    return 'FIFTY ' . numberNames(number: $digits[1]);
}

function sixty(int $number)
{
    $digits = str_split($number);

    if ($number == 60) {
        return 'SIXTY';
    }

    return 'SIXTY ' . numberNames(number: $digits[1]);
}

function seventy(int $number)
{
    $digits = str_split($number);

    if ($number == 70) {
        return 'SEVENTY';
    }

    return 'SEVENTY ' . numberNames(number: $digits[1]);
}

function eighty(int $number)
{
    $digits = str_split($number);

    if ($number == 80) {
        return 'EIGHTY';
    }

    return 'EIGHTY ' . numberNames(number: $digits[1]);
}


function ninety(int $number)
{
    $digits = str_split($number);

    if ($number == 90) {
        return 'NINETY';
    }

    return 'NINETY ' . numberNames(number: $digits[1]);
}

function cent($number)
{
    return ' AND ' . numberNames($number) . ' CENTS';
}

function groupNumbers($number): array
{
    $mainNumbers = explode('.', $number);
    $reverseOrder = strrev($mainNumbers[0]);
    $toArray = str_split($reverseOrder);
    $toGroup = array_chunk($toArray, 3);
    // grouped in reverse order
    $revGroup = array_reverse($toGroup);

    return array_map('backToString', $revGroup);
}

function backToString($number)
{
    $string = implode('', $number);
    return strrev($string);
}

function omitPrefixZero($number)
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
    $words = [];
    $notations = [];

    $numberLength = strlen($number[0]);
    $numberArrLength = count(groupNumbers($number[0])) - 1;
    for ($i = 0; $i < $numberArrLength; $i++) {
        $notations[] = scientificNotationName(omitPrefixZero(substr($number[0], $i, $numberLength)));
    }

    foreach (groupNumbers($number[0]) as $group) {
        $words[] = omitPrefixZero(numberNames($group));
    }

    $numberToWords = array_map(function ($word, $notation) {
        return $word . ' ' . $notation;
    }, $words, $notations);

    return implode(' ', $numberToWords) . cent($number[1]);
}

print_r(numberToWords(1789501.25));