<?php

namespace DesignPattern\Right\BudgetState;

use DesignPattern\Right\Budget;

abstract class BudgetState
{
    abstract public function calcExtraDiscount(Budget $budget) : float;

    public function approve(Budget $budget)
    {
        throw new \DomainException('This budget cannot be approved');
    }

    public function disapprove(Budget $budget)
    {
        throw new \DomainException('This budget cannot be disapproved');
    }

    public function finish(Budget $budget)
    {
        throw new \DomainException('This budget cannot be finalized');
    }
}