<?php

namespace App;

use App\Gateway\GatewayInterface;

class Subcribe
{
    public function __construct(protected GatewayInterface $gateway, protected Mailer $mailer)
    {

    }

    public function create(User $user)
    {
        $receiptId = $this->gateway->create();

        $this->mailer->delivery("You receive the receipt $receiptId");

        $user->isSubcribed = true;
    }
}
