<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function create(Request $request)
    {
        $customer = Customer::create($request->all());
        return $customer;
    }
}
