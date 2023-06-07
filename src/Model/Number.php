<?php

namespace App\Model;

class Number
{
    public array $notations = [
//        3 => 'HUNDRED',
        4 => 'THOUSAND',
        5 => 'THOUSAND', //TEN
        6 => 'THOUSAND', // HUNDRED
        7 => 'MILLION',
        8 => 'MILLION', //TENS MILLION. This is the limit, if you put number bigger than this the script will fail
    ];

    public array $ones = [
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

    public array $tens = [
        20 => 'TWENTY',
        30 => 'THIRTY',
        40 => 'FORTY',
        50 => 'FIFTY',
        60 => 'SIXTY',
        70 => 'SEVENTY',
        80 => 'EIGHTY',
        90 => 'NINETY',
    ];

    public array $teens = [
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

    public array $hundreds = [
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

    public function scientificNotationName(int $number)
    {
        $key = strlen($number);

        if ($key < 3) {
            return;
        }

        return $this->notations[$key];
    }

    public function numberNames(int $number): string
    {
        switch (strlen($number)) {
            case 2:
                if (str_split($number)[0] == 1) {
                    return $this->teens(key: $number);
                }

                if (str_split($number)[0] > 1) {
                    return $this->tensToWords(number: $number);
                }
                break;
            case 3:
                if (str_split($number)[0] > 0) {
                    return $this->hundredsToWords(number: $number);
                }
                break;
        }

        return $this->ones[$number];
    }

    public function teens(int $key): string
    {
        return $this->teens[$key];
    }

    public function tensToWords(int $number): string
    {
        $digits = str_split($number);

        if ($digits[1] > 0) {
            $key = $digits[0] * 10;
            return $this->tens[$key] . ' ' . $this->numberNames(number: $digits[1]);
        }

        return $this->tens[$number];
    }

    public function hundredsToWords(int $number): string
    {
        $digits = str_split($number);

        if ($digits[1] == 0 && $digits[2] > 0) {
            $key = $digits[0] * 100;
            return $this->hundreds[$key] . ' ' . $this->numberNames(number: $digits[2]);
        }

        if ($digits[1] > 0 && $digits[2] > 0) {
            $key = $digits[0] * 100;
            return $this->hundreds[$key] . ' ' . $this->numberNames(number: $digits[1] . $digits[2]);
        }

        return $this->hundreds[$number];
    }

}