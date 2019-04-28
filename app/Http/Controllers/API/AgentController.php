<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use App\Supplier;
use App\Agent;
use App\Model\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskUpdateMailToAdmin;
use App\Mail\TaskCreateMailToAdmin;

class AgentController extends Controller
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

            $users = User::all();
            $agent_task = Task::with('user')->get();


        return response()->json([
            'agent_task' => $agent_task,
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

        $this->validate($request,[
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'address' => 'required',

            'date' => 'required',
            'address' => 'required|string|max:191'
        ]);

        $task = Task::create([
            'title' => $request['title'],
            'user_id' => $request['user_id'],
            'address' => $request['address'],
            'customer_phone' => $request['customer_phone'],
            'description' => $request['description'],
            'date' => $request['date'],
            'status' => $request['status'],

        ]);
        $data = $task;
        Mail::to('balajirealtywebsite@gmail.com')->send(new TaskCreateMailToAdmin($data));
        return ['message' => 'Created the task info'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);

        return response()->json([
            'task' => $task,


        ], 200);
    }

    public function task()
    {

      $users = Auth::user();
      $user_id =$users->id;
        $agent = Task::with('user')->get();
        $agent_task = Task::with('user')->select('*')-> where('user_id',$user_id)->get();
        return response()->json([
            'agent_task' => $agent_task,
            'users' => $users,

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

        $user = auth('api')->user();

        $agent = Task::findOrFail($id);
        $this->validate($request,[
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'required',

            'customer_phone' => 'required',
            'date' => 'required',
            'address' => 'required|string|max:191'
        ]);
        $agent->update($request->all());
        $data = $agent;
        Mail::to('balajirealtywebsite@gmail.com')->send(new TaskUpdateMailToAdmin($data));

        return ['message' => 'Updated the task info'];
    }

    public function taskStatus(Request $request, $id)
    {

        $user = auth('api')->user();

        $agent = Task::findOrFail($id);

        $agent->update($request->all());
        $data = $agent;
        Mail::to('balajirealtywebsite@gmail.com')->send(new TaskUpdateMailToAdmin($data));

        return ['message' => 'Updated the task info'];
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $agent = Task::findOrFail($id);
        //delete the userer
        $agent->delete();

        return ['message' => 'Task deleted'];
    }

    public function search(){
        $users = User::all();

        if($search = \Request::get('q')){
            $agent_task = Task::with('user')->where(function($query) use($search){
                $query->where('id','LIKE',"%$search%")
                        ->orWhere('title','LIKE',"%$search%");



            })->get();
        }

        return response()->json([
            'agent_task' => $agent_task,
            'users' => $users,

        ], 200);
    }

    public function search1(){
        $users = Auth::user();
        $user_id =$users->id;

        if($search = \Request::get('q')){
            $agent_task = Task::with('user')->select('*')-> where('user_id',$user_id)->
                        where(function($query) use($search){
                        $query->where('id','LIKE',"%$search%")
                        ->orWhere('title','LIKE',"%$search%");
             })->get();
        }
        return response()->json([
            'agent_task' => $agent_task,
            'users' => $users,

        ], 200);

    }
}
