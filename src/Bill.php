<?php namespace Src;

class Bill
{
    /**
     * Quantity
     * @var int
     */
    public $quantity;

    /**
     * Unit Price
     * @var float
     */
    public $unit_price;

    /**
     * Unit Price
     * @var float
     */
    public $amount;


    public function __construct(int $quantity, float $unit_price)
    {
        $this->quantity = $quantity;
        $this->unit_price = $unit_price;

        $this->amount = $quantity * $unit_price;
    }

    public function process($gateway)
    {
        return $gateway->charge($this->amount);
    }
}