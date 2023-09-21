<?php

use DesignPattern\Wrong\Budget;

require "vendor/autoload.php";

$budget =  new Budget();

$budget->value = 100;


echo "Value : ".$budget->value . PHP_EOL;

$budget->state = 'ON_APPROVAL';
$budget->applyExtraDiscount();

echo "extra discount on approval: ".$budget->value . PHP_EOL;

$budget->state = 'APPROVED';
$budget->applyExtraDiscount();

echo "extra discount approved: ".$budget->value . PHP_EOL;