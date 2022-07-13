<?php

use PHPUnit\Framework\TestCase;
use Src\Mailer;
use Src\User;

class UserTest extends TestCase
{
    public function testReturnsFullName()
    {
        $user = new User();
        $user->first_name = 'Ahmed';
        $user->surname = 'Taha';
        $this->assertEquals('Ahmed Taha', $user->getFullName());
    }

    public function testFullNameIsEmptyByDefault()
    {
        $user = new User;
        $this->assertEquals("", $user->getFullName());
    }

    public function testTrueIsTrue()
    {
        $this->assertTrue(true);
    }

    public function testNotificationIsSent()
    {
        $user = new User;
        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())
                    ->method('sendMessage')
                    ->with($this->equalTo('medo@gmail.com'),$this->equalTo('Hello'))
                    ->willReturn(true);
        $user->email = 'medo@gmail.com';
        $this->assertTrue($user->notify($mock_mailer,'Hello'));
    }

    public function testCannotNotifyUserWithNoEmail()
    {
        $user = new User;
        $mock_mailer = $this->getMockBuilder(Mailer::class)
            ->setMethods(null)
            ->getMock();
        // if test will throw exception , use the original method
        /*
        $mock_mailer->expects($this->once())
            ->method('sendMessage')
            ->will($this->throwException(new Exception));
        */
        $this->expectException(Exception::class);
        $user->notify($mock_mailer,'Hello');
    }
}