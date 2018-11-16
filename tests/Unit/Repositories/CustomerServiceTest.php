<?php

namespace Tests\Unit;

use Tests\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use App\Repositories\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerServiceTest extends TestCase
{
    public function testCustomerServiceCanSuspendCustomerRemotely()
    {
        /**
        * For more info on testing with guzzle, visit:
        * https://guzzle.readthedocs.io/en/latest/testing.html
        */
        $body = [
            'message' => 'customer suspended successfully, haha sucker!'
        ];
        $headers = ['Content-Type' => 'application/json'];
        $status = 200;

        $mockResponse = new MockHandler([
            new Response($status, $headers, json_encode($body)),
        ]);
        $handler = HandlerStack::create($mockResponse);
        $client = new Client(['handler' => $handler]);

        $repo = new CustomerService($client);

        $customer = factory(\App\Customer::class)->create([
            'first_name' => 'Action',
            'last_name' => 'Man',
            'occupation' => 'Everything',
            'is_active' => false
        ]);

        $response = $repo->suspend($customer);

        $this->assertEquals($body['message'], json_decode($response, true)['message']);
    }

    // NOTE: BONUS POINTS IF YOU WRITE THIS TEST AND MAKE IT PASS!
    // public function testCustomerServiceCanActivateCustomerRemotely()
    // {
    // }
}
