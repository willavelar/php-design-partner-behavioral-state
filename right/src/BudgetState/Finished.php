<?php

namespace DesignPattern\Right\BudgetState;

use DesignPattern\Right\Budget;

class Finished extends BudgetState
{
    public function calcExtraDiscount(Budget $budget): float
    {
        throw new \DomainException('Finished budget cannot receive a discount');
    }
}