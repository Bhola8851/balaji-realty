<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Supplier;
use App\Model\Material;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $users = Auth::user();
        $materials = Material::with('user')->get();
        return response()->json([
            'materials' => $materials,
            'users' => $users,
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
        $user_id =$users->id;
        $this->validate($request,[
            'material' => 'required|string|max:191',
            'brand' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string|max:10',
            'description' => 'required|string',

        ]);
        return Material::create([
            'user_id' => $user_id,
            'material' => $request['material'],
            'brand' => $request['brand'],
            'quantity' => $request['quantity'],
            'price' => $request['price'],
            'description' => $request['description'],
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
        //
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
        $material = Material::findOrFail($id);

        $this->validate($request,[
            'material' => 'required|string|max:191',
            'brand' => 'required|string',
            'quantity' => 'required|string',
            'price' => 'required|string|max:10',
            'description' => 'required|string',

        ]);
        $material->update($request->all());
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
        $material = Material::findOrFail($id);
        //delete the user
        $material->delete();
        return ['message' => 'user deleted'];
    }

    public function search(){
        $users = Auth::user();

        if($search = \Request::get('q')){
            $materials = Material::with('user')->where(function($query) use($search){
                    $query->where('id','LIKE',"%$search%")
                        ->orWhere('brand','LIKE',"%$search%")
                        ->orWhere('material','LIKE',"%$search%");

            })->get();
        }
        return response()->json([
            'materials' => $materials,
            'users' => $users,
        ], 200);
    }

}
