<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCustomersPage()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Jørgen');
        $response->assertSeeText('Peter');
    }

    public function testInvoicesPage() {
        $this->get('/customer/invoice/1');
        $response = $this->get('/invoices');

        $response->assertStatus(200);
        $response->assertSeeText('Jørgen');
        $response->assertDontSeeText('Peter');
    }

    public function testCustomerPage() {
        $response = $this->get('/customer/1');

        $response->assertStatus(200);
        $response->assertSeeText('Jørgen');
        $response->assertSeeText('DKK 12 weekly');
        $response->assertSee('Invoice customer');
        $response->assertDontSeeText('Peter');
    }
    
}
