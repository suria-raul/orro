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
        6 => 'THOUSAND',
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
//        10 => 'TEN',
//        11 => 'ELEVEN',
//        12 => 'TWELVE',
//        13 => 'THIRTEEN',
//        14 => 'FOURTEEN',
//        15 => 'FIFTEEN',
//        16 => 'SIXTEEN',
//        17 => 'SEVENTEEN',
//        18 => 'EIGHTEEN',
//        19 => 'NINETEEN',
//        20 => 'TWENTY',
//        21 => 'TWENTY ONE',
//        22 => 'TWENTY TWO',
//        23 => 'TWENTY THREE',
//        24 => 'TWENTY FOUR',
//        25 => 'TWENTY FIVE',
//        26 => 'TWENTY SIX',
//        27 => 'TWENTY SEVEN',
//        28 => 'TWENTY EIGHT',
//        29 => 'TWENTY NINE',
//        30 => 'THIRTY',
//        31 => 'THIRTY ONE',
//        32 => 'THIRTY TWO',
//        33 => 'THIRTY THREE',
//        34 => 'THIRTY FOUR',
//        35 => 'THIRTY FIVE',
//        36 => 'THIRTY SIX',
//        37 => 'THIRTY SEVEN',
//        38 => 'THIRTY EIGHT',
//        39 => 'THIRTY NINE',
//        40 => 'FORTY',
//        41 => 'FORTY ONE',
//        42 => 'FORTY TWO',
//        43 => 'FORTY THREE',
//        44 => 'FORTY FOUR',
//        45 => 'FORTY FIVE',
//        46 => 'FORTY SIX',
//        47 => 'FORTY SEVEN',
//        48 => 'FORTY EIGHT',
//        49 => 'FORTY NINE',
//        50 => 'FIFTY',
//        51 => 'FIFTY ONE',
//        52 => 'FIFTY TWO',
//        53 => 'FIFTY THREE',
//        54 => 'FIFTY FOUR',
//        55 => 'FIFTY FIVE',
//        56 => 'FIFTY SIX',
//        57 => 'FIFTY SEVEN',
//        58 => 'FIFTY EIGHT',
//        59 => 'FIFTY NINE',
//        60 => 'SIXTY',
//        61 => 'SIXTY ONE',
//        62 => 'SIXTY TWO',
//        63 => 'SIXTY THREE',
//        64 => 'SIXTY FOUR',
//        65 => 'SIXTY FIVE',
//        66 => 'SIXTY SIX',
//        67 => 'SIXTY SEVEN',
//        68 => 'SIXTY EIGHT',
//        69 => 'SIXTY NINE',
//        70 => 'SEVENTY',
//        71 => 'SEVENTY ONE',
//        72 => 'SEVENTY TWO',
//        73 => 'SEVENTY THREE',
//        74 => 'SEVENTY FOUR',
//        75 => 'SEVENTY FIVE',
//        76 => 'SEVENTY SIX',
//        77 => 'SEVENTY SEVEN',
//        78 => 'SEVENTY EIGHT',
//        79 => 'SEVENTY NINE',
//        80 => 'EIGHTY',
//        81 => 'EIGHTY ONE',
//        82 => 'EIGHTY TWO',
//        83 => 'EIGHTY THREE',
//        84 => 'EIGHTY FOUR',
//        85 => 'EIGHTY FIVE',
//        86 => 'EIGHTY SIX',
//        87 => 'EIGHTY SEVEN',
//        88 => 'EIGHTY EIGHT',
//        89 => 'EIGHTY NINE',
//        90 => 'NINETY',
//        91 => 'NINETY ONE',
//        92 => 'NINETY TWO',
//        93 => 'NINETY THREE',
//        94 => 'NINETY FOUR',
//        95 => 'NINETY FIVE',
//        96 => 'NINETY SIX',
//        97 => 'NINETY SEVEN',
//        98 => 'NINETY EIGHT',
//        99 => 'NINETY NINE',
    ];

    if (strlen($number) == 2) {
        if (str_split($number)[0] == 1) {
            return teens($number);
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

function tens(int $key)
{

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
        return 'TWO';
    }

    return 'TWO HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function threeHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 300) {
        return 'THREE';
    }

    return 'THREE HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function fourHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 400) {
        return 'FOUR';
    }

    return 'FOUR HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function fiveHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 500) {
        return 'FIVE';
    }

    return 'FIVE HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function sixHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 600) {
        return 'SIX';
    }

    return 'SIX HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function sevenHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 700) {
        return 'SEVEN';
    }

    return 'SEVEN HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function eightHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 800) {
        return 'EIGHT';
    }

    return 'EIGHT HUNDRED ' . numberNames(number: $digits[1] . $digits[2]);
}

function nineHundred(int $number)
{
    $digits = str_split($number);

    if ($number == 900) {
        return 'NINE';
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