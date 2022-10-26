<?php

namespace Tests;

use App\Gateway\BraintreeGateway;
use App\Gateway\GatewayInterface;
use App\Gateway\StripeGateway;
use App\Mailer;
use App\Subcribe;
use App\User;
use PHPUnit\Framework\TestCase;

class SubcriptionTest extends TestCase
{
    public function test_it_create_a_stripe_subcription()
    {
        $this->markTestSkipped();
    }

    public function test_it_create_stripe_subcription_mark_the_user_as_subecribed()
    {
        $gateway = $this->createMock(GatewayInterface::class);
//        $gateway->method('create')->willReturn('receipt-stub');
        $subcribe = new Subcribe($gateway, $this->createMock(Mailer::class));
        $user = new User('Jon', 'dev');

        $this->assertFalse($user->isSubcribed);
        $subcribe->create($user);
        $this->assertTrue($user->isSubcribed);
    }

    public function test_it_deliver_receipt()
    {
        $gateway = $this->createMock(GatewayInterface::class);
        $mailer = $this->createMock(Mailer::class);
        $gateway->method('create')->willReturn('receipt-stub');
        $subcribe = new Subcribe($gateway, $mailer);
        $user = new User('Jon', 'dev');

        $mailer->expects($this->once())->method('delivery')->with("You receive the receipt receipt-stub");
        $subcribe->create($user);

    }


    
}
