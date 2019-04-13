<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserUpdateMailToAdmin;
use App\Mail\UserCreateMailToAdmin;
use App\Mail\UserUpdateProfileMailToAdmin;
use Illuminate\Support\Facades\Auth;
use App\Project;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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


        //$this->authorize('isAdmin');
        if(Gate::allows('isAdmin') || Gate::allows('isEmployee')){
            //User::latest()->paginate(5);

            $users = User::all()->map(function ($user){
                $user->isOnline = $user->isOnline();
                return $user;
            });


            return response()->json([

                'users' => $users,

            ], 200);
        }
    }

    public function dash(){
        return '123';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:5',
            'phone' => 'required|string|max:10',
            'dob' => 'required',
            'gender' => 'required|string',
            'address' => 'required|string|max:191',
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'dob' => $request['dob'],
            'gender' => $request['gender'],
            'type' => $request['type'],
            'bio' => $request['bio'],

            'password' => Hash::make($request['password']),
        ]);
        $data = $user;
        Mail::to('balajirealtywebsite@gmail.com')->send(new UserCreateMailToAdmin($data));
        return ['message' => 'Created the user info'];
    }


    public function profile(){
        $count = User::all()->count();
        $projects = Project::all()->count();
        $user = auth('api')->user();
        //return [auth('api')->user(),$count];
        return response()->json([
            'user' => $user,
            'count' => $count,
            'projects' => $projects,
        ], 200);
    }

    public function updateProfile(Request $request){
        $user1 =auth('api')->user();
        $user = auth('api')->user();
        $prev_data = $user1;
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:5',
            'phone' => 'required|string|max:10',
            'dob' => 'required',
            'address' => 'required|string|max:191'
        ]);

        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto){
            $name = time().'.'. explode('/',explode(':',substr($request->photo,0,strpos
                ($request->photo,';')))[1])[1];
            \Image::make($request->photo)->save(public_path('img/profile/'.$name));
            $request->merge(['photo' => $name]);

            $userPhoto = public_path('img/profile/').$currentPhoto;

            if(file_exists($userPhoto)){
                @unlink($userPhoto);
            }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }
        $user->update($request->all());

        $data =$user;
        Mail::to('balajirealtywebsite@gmail.com')->send(new UserUpdateProfileMailToAdmin($request,$data));
        return ['message'=>'Succesfully Updated Profile'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::findOrFail($id);
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
        $user = User::findOrFail($id);
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|min:5',
            'phone' => 'required|string|max:10',
            'dob' => 'required',
            'address' => 'required|string|max:191',

        ]);
        $user->update($request->all());
        $data = $user;
        Mail::to('balajirealtywebsite@gmail.com')->send(new UserUpdateMailToAdmin($data));

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
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        //delete the user
        $user->delete();
        return ['message' => 'user deleted'];
    }

    public function search(){
        if($search = \Request::get('q')){

            $users = User::where(function($query) use($search){
                $query->where('name','LIKE',"%$search%")
                ->orWhere('email','LIKE',"%$search%")
                ->orWhere('type','LIKE',"%$search%");

        })->get();
        }
        $users = User::all()->map(function ($user){
            $user->isOnline = $user->isOnline();
            return $user;
        });
        return response()->json([

            'users' => $users,

        ], 200);
    }
}
