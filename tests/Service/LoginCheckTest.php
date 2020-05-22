<?php

namespace App\Tests\Service;

use App\Service\LoginCheck;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LoginCheckTest extends KernelTestCase
{
    public function testGetCredentials()
    {
        $credentials = [
            'username' => 'michi',
            'password' => '123'
        ];
        $loginCheck = new LoginCheck();
        $this->assertSame($credentials, $loginCheck->getCredentials());
    }

    public function testCheckCredentials()
    {
        $credentials = [
            'username' => 'michi',
            'password' => '123'
        ];
        $loginCheck = new LoginCheck();
        $this->assertTrue($loginCheck->checkCredentials($credentials));
    }
}
