<?php
// tests/Controller/LoginControllerTest.php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional test for the controller.
 */
class LoginControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }

    public function testFormSubmit(): void
    {
        $client = static::createClient();
        $crawler = $client->request('POST', '/');

        $results = $client->getResponse()->getContent();

        $this->assertResponseHeaderSame('Content-Type', 'text/html; charset=UTF-8');
    }
}
