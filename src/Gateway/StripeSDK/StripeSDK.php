<?php

namespace App\Gateway\StripeSDK;

class StripeSDK
{
    public function create()
    {
        sleep(2);

        var_dump('Slow HTTP request');
    }
}
