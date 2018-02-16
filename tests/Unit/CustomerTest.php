<?php

namespace Tests\Unit;

use App\Agreement;
use App\Customer;
use App\Delivery;
use App\Invoice;
use Carbon\Carbon;
use Tests\TestCase;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CustomerTest extends TestCase
{
    /**
     * @var Customer
     */
    private $customer;

    public function setUp()
    {
        parent::setUp();

        $this->customer = factory(Customer::class)->create([
            'name' => 'Søren Petersen',
            'agreement_id' => factory(\App\Agreement::class)->create([
                'unit_price' => 12.00,
                'type' => Agreement::TYPE_WEEKLY,
            ])->id,
        ]);

        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(3),
            'count' => 5,
            'customer_id' => $this->customer->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(8),
            'count' => 2,
            'customer_id' => $this->customer->id,
        ]);
    }

    public function testCreateWeeklyInvoice()
    {
        $this->customer->agreement->type = Agreement::TYPE_WEEKLY;

        // Implement test for create weekly invoice
        $invoice = CustomerService::invoice($this->customer);

        $this->assertEquals(60, $invoice->amount);
    }

    public function testCreateMonthlyInvoice()
    {
        $this->customer->agreement->type = Agreement::TYPE_MONTHLY;
        
        // Implement test for create monthly invoice
        $invoice = CustomerService::invoice($this->customer);

        $this->assertEquals(84, $invoice->amount);
    }

    public function testDontSameTwiceInvoice()
    {
        $this->customer->agreement->type = Agreement::TYPE_MONTHLY;
        
        // Implement test for create monthly invoice
        CustomerService::invoice($this->customer);
        $invoice = CustomerService::invoice($this->customer);

        $this->assertEquals(null, $invoice);
    }
}
