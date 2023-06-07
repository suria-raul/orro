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
        8 => 'MILLION', //TEN
        9 => 'HUNDRED MILLION',
        10 => 'BILLION'
    ];

    return $notations[$key];
}

function numberNames(int $number)
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
            return teens($number);
        }

        if (str_split($number)[0] > 1) {
            return tensToWords($number);
        }

    } elseif (strlen($number) == 3) {
        if (str_split($number)[0] == 1) {
            return oneHundred($number);
        }

        if (str_split($number)[0] == 2) {
            return twoHundred($number);
        }

        if (str_split($number)[0] == 3) {
            return threeHundred($number);
        }

        if (str_split($number)[0] == 4) {
            return fourHundred($number);
        }

        if (str_split($number)[0] == 5) {
            return fiveHundred($number);
        }

        if (str_split($number)[0] == 6) {
            return sixHundred($number);
        }

        if (str_split($number)[0] == 7) {
            return sevenHundred($number);
        }

        if (str_split($number)[0] == 8) {
            return eightHundred($number);
        }

        if (str_split($number)[0] == 9) {
            return nineHundred($number);
        }
    }

    return $ones[$number];
}

function teens(int $key)
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

function tensToWords(int $number)
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
        return $tens[$key] . ' ' . numberNames($digits[1]);
    }

    return $tens[$number];
}

function oneHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 100) {
        return 'ONE HUNDRED';
    }

    return 'ONE HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function twoHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 200) {
        return 'TWO HUNDRED';
    }

    return 'TWO HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function threeHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 300) {
        return 'THREE HUNDRED';
    }

    return 'THREE HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function fourHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 400) {
        return 'FOUR HUNDRED';
    }

    return 'FOUR HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function fiveHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 500) {
        return 'FIVE HUNDRED';
    }

    return 'FIVE HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function sixHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 600) {
        return 'SIX HUNDRED';
    }

    return 'SIX HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function sevenHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 700) {
        return 'SEVEN HUNDRED';
    }

    return 'SEVEN HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function eightHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 800) {
        return 'EIGHT HUNDRED';
    }

    return 'EIGHT HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function nineHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 900) {
        return 'NINE HUNDRED';
    }

    return 'NINE HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function cent($number)
{
    return 'AND ' . numberNames($number) . ' CENTS';
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
    $numberArrLength = count(groupNumbers($number[0]));
    $arrCopy = groupNumbers($number[0]);
    for ($i = 0; $i < $numberArrLength;) {
        $notations[] = scientificNotationName(omitPrefixZero(substr($number[0], $i, $numberLength)));
        $i += strlen($arrCopy[$i]);
    }

    foreach (groupNumbers($number[0]) as $group) {
        $words[] = omitPrefixZero(numberNames($group));
    }

    $numberToWords = array_map(function ($word, $notation) {
        return $word . ' ' . $notation;
    }, $words, $notations);

    if (count($number) < 2) {
        return implode(' ', $numberToWords) . PHP_EOL;
    }

    return implode(' ', $numberToWords) . cent($number[1]) . PHP_EOL;
}

print_r(numberToWords(10002005.77));


// 100001.01 pass
// 1789501.25 pass
// 789481.00 pass
// 2156175.50 failed (5 cents)
// 1111111.11 pass
// 10002005.77 pass