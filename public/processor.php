<?php

require_once "../vendor/autoload.php";

$input = $_POST['number'];
echo (new \App\Controller\NumberController())->numberToWords(number: $input);
