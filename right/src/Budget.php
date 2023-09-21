<?php

namespace DesignPattern\Right;

use DesignPattern\Right\BudgetState\BudgetState;
use DesignPattern\Right\BudgetState\OnApproval;

class Budget
{
    public float $value;
    public BudgetState $state;

    public function __construct()
    {
        $this->state = new OnApproval();
    }

    public function applyExtraDiscount()
    {
        $this->value -= $this->state->calcExtraDiscount($this);
    }

    public function approve()
    {
        $this->state->approve($this);
    }

    public function disapprove()
    {
        $this->state->disapprove($this);
    }

    public function finish()
    {
        $this->state->finish($this);
    }
}