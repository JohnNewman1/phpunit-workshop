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
}
