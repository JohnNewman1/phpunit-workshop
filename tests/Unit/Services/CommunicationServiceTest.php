<?php

namespace Tests\Unit;

use Mockery;
use App\Customer;
use Tests\TestCase;
use App\Services\EmailService;
use App\Services\CommunicationService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommunicationServiceTest extends TestCase
{
    public function testCommunicationServiceCanSendEmails()
    {
        $emailService = Mockery::mock(EmailService::class);

        $message = 'Dear Santa, i\'ve been super good this year! Get me some noise cancelling headphones.. pleaaaase!';

        $emailService
            ->expects()
            ->send([
                'to' => 'santa@clause.com',
                'message' => $message,
            ]);

        $customer = Mockery::mock(Customer::class);

        $customer->expects()
            ->getEmail()
            ->andReturns('santa@clause.com');

        $service = new CommunicationService($emailService);

        $result = $service->email($customer, $message);
    }

    // NOTE: BONUS POINTS IF YOU CAN USE
    // public function testCommunicationServiceCanSendSms()
    // {
    // }
}
