<?php
// src/Service/LoginCheck.php
namespace App\Service;

class LoginCheck
{
    public function getCredentials()
    {
        $credentials = [
            'username' => 'michi',
            'password' => '123'
        ];

        return $credentials;
    }

    public function checkCredentials($formInput)
    {
        $credentials = $this->getCredentials();

        return ($formInput == $credentials);
    }
}
