<?php

use PHPUnit\Framework\TestCase;
use Src\Mailer;

class MockTest extends TestCase
{
    public function testMock()
    {
        $mock   = $this->createMock(Mailer::class);
        $mock->method('sendMessage')
             ->willReturn(true);
        $result = $mock->sendMessage('joe@gmail.com','Hello');
       $this->assertTrue($result);
    }
}
