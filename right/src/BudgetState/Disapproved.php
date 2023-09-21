<?php

namespace DesignPattern\Right\BudgetState;

use DesignPattern\Right\Budget;

class Disapproved extends BudgetState
{
    public function calcExtraDiscount(Budget $budget): float
    {
        throw new \DomainException('Disapproved budget cannot receive a discount');
    }

    public function finish(Budget $budget)
    {
        $budget->state = new Finished();
    }
}