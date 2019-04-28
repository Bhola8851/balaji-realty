<?php

namespace App\Http\Controllers\snacks_api;

use App\snacks\CustomerMaterial;
use Illuminate\Http\Request;
use App\Http\Resources\MaterialResource;
use App\snacks\Customer;
use App\Http\Requests\MaterialRequest;
use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Customer $customer)
    {
        // return $customer->materials;
        return MaterialResource::collection($customer->customer_materials);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request, Customer $customer)
    {

        $material = new CustomerMaterial($request->all());
        $customer->customer_materials()->save($material);
        return response([
            'data' => new MaterialResource($material)
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer,CustomerMaterial $material)
    {
        return new MaterialResource($material);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Customer $customer,CustomerMaterial $material)
    {

        $material->update($request->all());
        return response([
            'data' => new MaterialResource($material)
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer,CustomerMaterial $material)
    {
        $material->delete();
        return response(null,204);
    }
}
