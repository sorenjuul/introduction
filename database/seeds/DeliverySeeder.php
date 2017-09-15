<?php

use App\Delivery;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(3),
            'count' => 5,
            'customer_id' => \App\Customer::whereName('Jørgen Hansen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(5),
            'count' => 2,
            'customer_id' => \App\Customer::whereName('Jørgen Hansen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(7),
            'count' => 9,
            'customer_id' => \App\Customer::whereName('Jørgen Hansen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(9),
            'count' => 7,
            'customer_id' => \App\Customer::whereName('Jørgen Hansen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(11),
            'count' => 3,
            'customer_id' => \App\Customer::whereName('Jørgen Hansen')->firstOrFail()->id,
        ]);

        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(2),
            'count' => 1,
            'customer_id' => \App\Customer::whereName('Peter Bendtsen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(6),
            'count' => 4,
            'customer_id' => \App\Customer::whereName('Peter Bendtsen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(7),
            'count' => 15,
            'customer_id' => \App\Customer::whereName('Peter Bendtsen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(10),
            'count' => 9,
            'customer_id' => \App\Customer::whereName('Peter Bendtsen')->firstOrFail()->id,
        ]);
        factory(Delivery::class)->create([
            'delivered_at' => Carbon::now()->subDays(15),
            'count' => 2,
            'customer_id' => \App\Customer::whereName('Peter Bendtsen')->firstOrFail()->id,
        ]);
    }
}
