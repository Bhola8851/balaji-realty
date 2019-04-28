<?php

namespace App\Http\Controllers\snacks_api;

use App\snacks\CustomerMaterial;
use App\snacks\Customer;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;


class CustomerController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api');

    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CustomerCollection::collection(Customer::latest()->paginate(20));
        // $customer_data = Customer::latest()->paginate(5);
        // $customer_material = CustomerMaterial::all();

        // return response()->json([
        //     'customer_data' => $customer_data,
        //     'custmer_material' => $customer_material
        // ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = new Customer;
        $customer->customer_name = $request->customer_name;
        $customer->customer_contact = $request->customer_contact;
        $customer->customer_email = $request->customer_email;
        $customer->customer_address = $request->customer_address;
        $customer->customer_description = $request->customer_description;
        $customer->save();
        return response([
            'data' => new CustomerResource($customer)
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\snacks\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer,Request $request)
    {

        return new CustomerResource($customer);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\snacks\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());
        return response([
            'data' => new CustomerResource($customer)
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\snacks\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return response(null,204);
    }
}
