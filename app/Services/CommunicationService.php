<?php

namespace App\Services;

use App\Customer;
use App\Services\EmailService;

class CommunicationService
{
    private $emailer;

    public function __construct(EmailService $emailer)
    {
        $this->emailer = $emailer;
    }

    public function email(Customer $customer, string $message)
    {
        $email = $customer->getEmail();

        $this->emailer->send([
            'to' => $email,
            'message' => $message
        ]);
    }
}
