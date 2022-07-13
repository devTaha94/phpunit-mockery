<?php

use Mockery\Adapter\Phpunit\MockeryTestCase;
use Src\Bill;

class BillTest extends MockeryTestCase
{
    public function testOrderIsProcessedUsingMock()
    {
        $order = new Bill(3,1.99);

        $this->assertEquals(5.97, $order->amount);

        $gateway = Mockery::mock('PaymentGateway');

        $gateway->shouldReceive('charge')
              ->once()
              ->with(5.97);

      $order->process($gateway);
    }

    public function testOrderIsProcessedUsingSpy()
    {
        $order = new Bill(3,1.99);

        $this->assertEquals(5.97, $order->amount);

        $gateway = Mockery::spy('PaymentGateway');

        $order->process($gateway);

        $gateway->shouldHaveReceived('charge')
              ->once()
              ->with(5.97);
    }
}
