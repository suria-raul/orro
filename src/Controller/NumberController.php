<?php

namespace App\Controller;

use App\Model\Number;

class NumberController
{
    protected Number $numberModel;

    public function __construct()
    {
        $this->numberModel = new Number();
    }

    protected function cent(int $number): string
    {
        return 'AND ' . $this->numberModel->numberNames(number: $number) . ' CENTS';
    }

    protected function groupNumbers(float|int $number): array
    {
        $mainNumbers = explode('.', $number);
        $reverseOrder = strrev($mainNumbers[0]);
        $toArray = str_split($reverseOrder);
        $toGroup = array_chunk($toArray, 3);
        // grouped in reverse order
        $revGroup = array_reverse($toGroup);

        return array_map(function (array $number): string {
            $string = implode('', $number);
            return strrev($string);
        }, $revGroup);
    }

    protected function omitPrefixZero(string $number): string
    {
        $toArray = str_split($number);
        if ($toArray[0] == 0) {
            return ltrim($number, '0');
        }

        return $number;
    }

    public function numberToWords(float|int $number): string
    {
        $number = number_format($number, 2, '.', '');
        $number = explode('.', $number);
        $words = [];
        $notations = [];

        $numberLength = strlen($number[0]);
        $numberArrLength = count($this->groupNumbers(number: $number[0]));
        $arrCopy = $this->groupNumbers(number: $number[0]);
        for ($i = 0; $i < $numberArrLength;) {
            $notations[] = $this->numberModel->notation(number: $this->omitPrefixZero(number: substr($number[0], $i, $numberLength)));
            $i += strlen($arrCopy[$i]);
        }

        foreach ($this->groupNumbers($number[0]) as $group) {
            $words[] = $this->omitPrefixZero(number: $this->numberModel->numberNames($group));
        }

        $numberToWords = array_map(function ($word, $notation) {
            return $word . ' ' . $notation;
        }, $words, $notations);

        if (count($number) < 2) {
            return implode(' ', $numberToWords) . PHP_EOL;
        }

        return implode(' ', $numberToWords) . $this->cent(number: $number[1]) . PHP_EOL;
    }

}