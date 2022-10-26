<?php

namespace App\Gateway;

use App\Gateway\StripeSDK\StripeSDK;

class StripeGateway implements GatewayInterface
{
    public function __construct(protected StripeSDK $stripeSDK)
    {

    }

    public function create()
    {
        $this->stripeSDK->create();
    }
}
