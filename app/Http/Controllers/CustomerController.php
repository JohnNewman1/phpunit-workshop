<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    private $repo;

    public function __construct(CustomerService $repo)
    {
        $this->repo = $repo;
    }
    public function create(Request $request)
    {
        $customer = Customer::create($request->all());
        return $customer;
    }

    public function delete(Request $request, Customer $customer)
    {
        $customer->delete();
        return [
            'success' => true
        ];
    }

    public function suspend(Request $request, Customer $customer)
    {
        $customer->update([
            'is_active' => false
        ]);
        $this->repo->suspend($customer);
        return [
            'success' => true
        ];
    }
}
