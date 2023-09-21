<?php

namespace DesignPattern\Wrong;

class Budget 
{
    public float $value;
    public string $state;

    public function applyExtraDiscount()
    {
        $this->value -= $this->calcExtraDiscount();
    }

    private function calcExtraDiscount() : float
    {
        if ($this->state == 'ON_APPROVAL') {
            return $this->value * 0.05;
        }

        if ($this->state == 'APPROVED') {
            return $this->value * 0.02;
        }

        throw new \DomainException('Disapproved or finalized quotes cannot receive discounts');
    }
}