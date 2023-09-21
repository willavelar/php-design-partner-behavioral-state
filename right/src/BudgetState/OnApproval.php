<?php

namespace DesignPattern\Right\BudgetState;

use DesignPattern\Right\Budget;

class OnApproval extends BudgetState
{
    public function calcExtraDiscount(Budget $budget): float
    {
       return $budget->value * 0.05;
    }

    public function approve(Budget $budget)
    {
        $budget->state = new Approved();
    }

    public function disapprove(Budget $budget)
    {
        $budget->state = new Disapproved();
    }
}