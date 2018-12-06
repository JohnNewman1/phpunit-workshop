<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CustomerService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
{
    public function testCustomerControllerCanCreateCustomer()
    {
        $attributes = [
            'first_name' => 'Santa',
            'last_name' => 'Clause',
            'occupation' => 'Delivery Man',
        ];

        $response = $this->json('post', 'api/customers', $attributes);
        // dd($response->getContent());
        // if($e=($r=$response)->exception){dd($e);}else{dd($r->getContent());}

        $response
            ->assertStatus(201)
            ->assertJsonFragment([
                'first_name' => 'Santa',
                'last_name' => 'Clause',
                'occupation' => 'Delivery Man',
            ]);

        $this->assertDatabaseHas('customers', [
            'first_name' => 'Santa',
            'last_name' => 'Clause',
            'occupation' => 'Delivery Man',
        ]);
    }

    // public function testCustomerControllerCanUpdateCustomer()
    // {
    //     // NOTE: BUILD LOGIC TO MAKE PASS.
    //     $customer = factory(\App\Customer::class)->create([
    //         'first_name' => 'Santa',
    //         'last_name' => 'Clause',
    //         'occupation' => 'Delivery Man',
    //     ]);
    //
    //     $attributes = [
    //         'first_name' => 'Tooth',
    //         'last_name' => 'Fairy',
    //         'occupation' => 'Tooth Theif',
    //     ];
    //
    //     $response = $this->json('patch', 'api/customers/' . $customer->id, $attributes);
    //
    //     $response
    //         ->assertStatus(200)
    //         ->assertJsonFragment([
    //             'first_name' => 'Tooth',
    //             'last_name' => 'Fairy',
    //             'occupation' => 'Tooth Theif',
    //         ]);
    //
    //     $this->assertDatabaseMissing('customers', [
    //         'id' => $customer->id,
    //         'first_name' => 'Santa',
    //         'last_name' => 'Clause',
    //         'occupation' => 'Delivery Man',
    //     ]);
    //
    //     $this->assertDatabaseHas('customers', [
    //         'id' => $customer->id,
    //         'first_name' => 'Tooth',
    //         'last_name' => 'Fairy',
    //         'occupation' => 'Tooth Theif',
    //     ]);
    // }
    //
    // public function testCustomerControllerCanDeleteCustomer()
    // {
    //     // NOTE: FIX THIS TEST.
    //     $customer = factory(\App\Customer::class)->create([
    //         'first_name' => 'Santa',
    //         'last_name' => 'Clause',
    //         'occupation' => 'Delivery Man',
    //     ]);
    //
    //     $response = $this->json('delete', 'api/customers/' . $customer->id);
    //
    //     $response
    //         ->assertStatus(200);
    //
    //     $this->assertDatabaseMissing('customers', [
    //         'id' => $customer->id,
    //         'first_name' => 'Santa',
    //         'last_name' => 'Clause',
    //         'occupation' => 'Delivery Man',
    //     ]);
    // }
    //
    // public function testCustomerControllerCanSuspendACustomer()
    // {
    //     $customer = factory(\App\Customer::class)->create([
    //         'first_name' => 'Santa',
    //         'last_name' => 'Clause',
    //         'occupation' => 'Delivery Man',
    //         'is_active' => true
    //     ]);
    //     //BELOW WE ARE BINDING THE MOCK TO ANY INSTANCE OF THAT CLASS THAT THE APP RESOLVES.
    //     $customerRepo = \Mockery::mock(CustomerService::class);
    //     $this->app->instance(CustomerService::class, $customerRepo);
    //
    //     $customerRepo
    //         ->shouldReceive('suspend')
    //         ->once();
    //
    //     $response = $this->json('post', 'api/customers/' . $customer->id . '/suspend');
    //
    //     $response
    //         ->assertStatus(200);
    //
    //     $this->assertDatabaseHas('customers', [
    //         'first_name' => 'Santa',
    //         'last_name' => 'Clause',
    //         'occupation' => 'Delivery Man',
    //         'is_active' => false
    //     ]);
    // }

    // NOTE: BONUS POINTS IF YOU WRITE THIS TEST AND MAKE IT PASS!
    // public function testCustomerControllerCanActivateACustomer()
    // {
    // }


    // NOTE: IGNORE THE BELOW CODE, I WILL TALK TO YOU ABOUT IT AT THE END OF THE WORKSHOP IF WE HAVE TIME.
    /*
   //     |--------------------------------------------------------------------------
   //     | Mockery On
   //     |--------------------------------------------------------------------------
   //     |
   //     |When we need to do a more complex argument matching for an expected method call,
   //     |the \Mockery::on() matcher comes in really handy.
   //     |It accepts a closure as an argument and that closure in turn receives the argument passed in to the method,
   //     |when called. If the closure returns true, Mockery will consider that the argument has passed the expectation.
   //     |If the closure returns false, or a “falsey” value, the expectation will not pass.
   //     |
   //     */
   //
   //     $customerRepo
   //         ->expects()
   //         ->suspend(
   //             \Mockery::on(
   //                 function ($arg) use ($customer) {
   //                     return $arg->id == $customer->id;
   //                 }
   //             )
   //         )
   //         ->once();
}
