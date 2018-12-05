<?php

namespace App\Services;

use GuzzleHttp\Client;
use App\Customer;

class CustomerService
{
    private $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    public function suspend(Customer $customer)
    {
        $response = $this->http->post('api/fake-builder/customers/' . $customer->id . '/suspend');

        return $response->getBody()->getContents();
    }
}
