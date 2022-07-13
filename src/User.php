<?php
namespace Src;
class User
{
    public $first_name;

    public $surname;

    public $email;

    public function getFullName()
    {
        return  trim("$this->first_name $this->surname");
    }

    public function notify(Mailer $mock_mailer,$message)
    {
        return $mock_mailer->sendMessage($this->email,$message);
    }
}