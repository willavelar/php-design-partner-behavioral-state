## State

State is a behavioral design pattern that lets an object alter its behavior when its internal state changes. It appears as if the object changed its class.

-----

We need to create a calculator that applies discounts depending on the state of the budget.

### The problem

We will need to pass the state by hand, changing it at each step outside the class, and our function will grow forever with each new state

```php
<?php
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
```


### The solution

Now, using the State pattern, e created an abstract class to help change the status, and within the budget we just call the function that each status determines what its discount is.

#### Attention

The state pattern can generate a problem of changing behavior when calling children of the same parent class, in this case we are violating the Liskov principle

```php
<?php
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
```
```php
<?php
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
```
```php
<?php
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
```
```php
<?php
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
```
```php
<?php
class Finished extends BudgetState
{
    public function calcExtraDiscount(Budget $budget): float
    {
        throw new \DomainException('Finished budget cannot receive a discount');
    }
}
```
```php
<?php
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
```

-----

### Installation for test

![PHP Version Support](https://img.shields.io/badge/php-7.4%2B-brightgreen.svg?style=flat-square) ![Composer Version Support](https://img.shields.io/badge/composer-2.2.9%2B-brightgreen.svg?style=flat-square)

```bash
composer install
```

```bash
php wrong/test.php
php right/test.php
```