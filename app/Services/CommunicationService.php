<?php

namespace App\Services;

use App\Customer;
use App\Services\EmailService;
use App\Services\LetterService;

class CommunicationService
{
    private $emailService;
    private $letterService;

    public function __construct(EmailService $emailService, LetterService $letterService)
    {
        $this->emailService = $emailService;
        $this->letterService = $letterService;
    }

    public function sendEmail(Customer $customer, string $message)
    {
        $email = $customer->getEmail();
        $email = $customer->getEmail();

        $this->emailService->send([
            'to' => $email,
            'message' => $message
        ]);
    }

    // public function sendLetter(Customer $customer, string $message)
    // {
    //     $address = $customer->getAddress();
    //
    //     $this->letterService->addAddress($address);
    //     $this->letterService->addMessage($message);
    //
    //     $this->letterService->send();
    // }
}
