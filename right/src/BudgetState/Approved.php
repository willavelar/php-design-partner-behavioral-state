<?php

namespace DesignPattern\Right\BudgetState;

use DesignPattern\Right\Budget;

class Approved extends BudgetState
{
    public function calcExtraDiscount(Budget $budget): float
    {
        return $budget->value * 0.02;
    }

    public function finish(Budget $budget)
    {
        $budget->state = new Finished();
    }
}