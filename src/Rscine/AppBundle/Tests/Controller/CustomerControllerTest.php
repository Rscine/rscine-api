<?php

namespace Rscine\AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CustomerControllerTest extends WebTestCase
{
    public function testGetcustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getCustomer');
    }

    public function testGetcustomers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getCustomers');
    }

    public function testPostcustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/postCustomer');
    }

    public function testPutcustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/putCustomer');
    }

    public function testOptionscustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/optionsCustomer');
    }

    public function testOptionscustomers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/optionsCustomers');
    }

    public function testDeletecustomer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteCustomer');
    }

}
