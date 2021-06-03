<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Stripe\Order;
use Tests\TestCase;

class NovaPoshtaTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $np = new \NovaPoshta();
        $order = new Order();
        $np->process($order);
    }
}
