<?php

namespace Tests\Unit;

use Mockery;
use App\Customer;
use Tests\TestCase;
use App\Services\EmailService;
use App\Services\LetterService;
use App\Services\CommunicationService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommunicationServiceTest extends TestCase
{
    // NOTE: In the CRM we have begun using the alternative 'shouldReceive' syntax.
    // see here for details http://docs.mockery.io/en/latest/reference/alternative_should_receive_syntax.html

    // NOTE:  We use allows() when we create stubs for methods that return a predefined return value,
    // but for these method stubs we don’t care how many times, or if at all,
    // were they called.

    // NOTE: We use expects() when we want to verify that a particular method was called.

    // NOTE: Below we can see the difference between 'allows' and 'expects'.
    // Have a go at changing the 'allows' assertion to 'expects'.

    // public function setUp()
    // {
    //     parent::setUp();
    // }

    public function testCommunicationServiceCanSendEmails()
    {
        $emailService = Mockery::mock(EmailService::class);
        $letterService = Mockery::mock(LetterService::class);

        $message = 'Dear Santa, i\'ve been super good this year! Get me some noise cancelling headphones.. pleaaaase!';

        $customer = Mockery::mock(Customer::class);

        $customer
            ->allows()
            ->getEmail()
            ->andReturns('santa@clause.com');

        $emailService
            ->expects()
            ->send([
                'to' => 'santa@clause.com',
                'message' => $message,
            ]);

        $service = new CommunicationService($emailService, $letterService);

        $result = $service->sendEmail($customer, $message);
    }

    // NOTE: Below we use a spy, see that we don't have to write assertions
    // for two method calls made to letterService.

    // public function testCommunicationServiceCanSendLetter()
    // {
    //     $emailService = Mockery::mock(EmailService::class);
    //     $letterService = Mockery::spy(LetterService::class);
    //
    //     $message = 'Dear Santa, i\'ve been super good this year! Get me some noise cancelling headphones.. pleaaaase!';
    //
    //     $customer = Mockery::mock(Customer::class);
    //
    //     $customer
    //         ->allows()
    //         ->getAddress()
    //         ->andReturns('Santa, Magic Land, North Pole');
    //
    //     $service = new CommunicationService($emailService, $letterService);
    //
    //     $result = $service->sendLetter($customer, $message);
    //
    //     $letterService
    //         ->shouldHaveReceived()
    //         ->send();
    // }

    // NOTE: BONUS POINTS IF YOU COMPLETE THE TEST BELOW USING A SPY AND A MOCK.
    // public function testCommunicationServiceCanSendSms()
    // {
    // }
}
