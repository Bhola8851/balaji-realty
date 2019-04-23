<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use App\Model\Supplier;
use Illuminate\Support\Facades\Auth;
use App\Model\Material;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class SupplierController extends Controller
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
    public function index()
    {
        $current_user = Auth::user();
        $users = User::all();
        $materials = Material::with('user')->get();
        $supplies = Supplier::with('user')->get();
        return response()->json([
            'supplies' => $supplies,
            'users' => $users,
            'materials' => $materials,
            'current_user' => $current_user,
        ], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $users = Auth::user();
        $assigned_by =$users->name;
        $this->validate($request,[

            'brand' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|string|max:191'
        ]);
        return Supplier::create([
            'user_id' => $request['user_id'],
            'assigned_by' => $assigned_by,
            'material' => $request['material'],
            'brand' => $request['brand'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'address' => $request['address'],
            'description' => $request['description'],
            'date' => $request['date'],
            'status' => $request['status'],


        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supply = Supplier::findOrFail($id);

        return response()->json([
            'supply' => $supply,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        $users = Auth::user();
        $assigned_by =$users->name;
        $this->validate($request,[

            'brand' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string',
            'address' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|string|max:191'
        ]);
        $supplier->update($request->all());
        return ['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agent = Supplier::findOrFail($id);
        //delete the user
        $agent->delete();
        return ['message' => 'user deleted'];
    }

    public function search(){
        $current_user = Auth::user();
        $users = User::all();
        $materials = Material::with('user')->get();


        if($search = \Request::get('q')){
            $supplies = Supplier::with('user')->where(function($query) use($search){
                    $query->where('id','LIKE',"%$search%")
                        ->orWhere('brand','LIKE',"%$search%")
                        ->orWhere('material','LIKE',"%$search%");

            })->get();
        }
        return response()->json([
            'supplies' => $supplies,
            'users' => $users,
            'materials' => $materials,
            'current_user' => $current_user,
        ], 200);
    }
    public function search1(){
        $current_user = Auth::user();
        $users = User::all();
        $materials = Material::with('user')->get();
        $supplies = Supplier::with('user')->get();
        if($search = \Request::get('q')){
            $supplies = Supplier::with('user')->where(function($query) use($search){
                    $query->where('id','LIKE',"%$search%")
                        ->orWhere('brand','LIKE',"%$search%")
                        ->orWhere('material','LIKE',"%$search%");

            })->get();
        }
        return response()->json([
            'supplies' => $supplies,
            'users' => $users,
            'materials' => $materials,
            'current_user' => $current_user,
        ], 200);
    }
}

