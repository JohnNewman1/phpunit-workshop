<?php

namespace Tests\Unit;

use Tests\TestCase;
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

    public function testCustomerControllerCanUpdateCustomer()
    {
        $customer = factory(\App\Customer::class)->create([
            'first_name' => 'Santa',
            'last_name' => 'Clause',
            'occupation' => 'Delivery Man',
        ]);

        $attributes = [
            'first_name' => 'Tooth',
            'last_name' => 'Fairy',
            'occupation' => 'Tooth Theif',
        ];

        $response = $this->json('patch', 'api/customers/' . $customer->id, $attributes);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'first_name' => 'Tooth',
                'last_name' => 'Fairy',
                'occupation' => 'Tooth Theif',
            ]);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
            'first_name' => 'Santa',
            'last_name' => 'Clause',
            'occupation' => 'Delivery Man',
        ]);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'first_name' => 'Tooth',
            'last_name' => 'Fairy',
            'occupation' => 'Tooth Theif',
        ]);
    }

    public function testCustomerControllerCanDeleteCustomer()
    {
        $customer = factory(\App\Customer::class)->create([
            'first_name' => 'Santa',
            'last_name' => 'Clause',
            'occupation' => 'Delivery Man',
        ]);

        $response = $this->json('delete', 'api/customers/' . $customer->id);

        $response
            ->assertStatus(200);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
            'first_name' => 'Santa',
            'last_name' => 'Clause',
            'occupation' => 'Delivery Man',
        ]);
    }
}
