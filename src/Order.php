<?php namespace Src;

class Order
{
    public $amount = 0;

    protected $gateway;

    public function __construct($gateway)
    {
        $this->gateway = $gateway;
    }

    public function process()
    {
        return $this->gateway->charge($this->amount);
    }
}