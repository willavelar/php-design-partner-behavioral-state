<?php

use DesignPattern\Right\Budget;

require "vendor/autoload.php";

$budget =  new Budget();

$budget->value = 100;

echo "Value : ".$budget->value . PHP_EOL;

$budget->applyExtraDiscount();

echo "extra discount on approval: ".$budget->value . PHP_EOL;

$budget->approve();
$budget->applyExtraDiscount();

echo "extra discount approved: ".$budget->value . PHP_EOL;