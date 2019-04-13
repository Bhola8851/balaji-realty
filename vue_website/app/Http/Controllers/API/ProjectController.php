<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserUpdateMailToAdmin;
use App\Mail\ProjectCreateMailToAdmin;

class ProjectController extends Controller
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
        
        return Project::latest()->paginate(5);

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
            'title' => 'required|string|max:100',
            'deal_type' => 'required|string',
            'price' => 'required|string|max:5',
            'location' => 'required|string|max:100',
            'address' => 'required|string',
            'description' => 'required|string|max:191',
            'cover_image' => 'required',
        ]);
        $user_id = auth()->user()->id;
        
        //Uploading an an Cover Image
        $name = time().'.'. explode('/',explode(':',substr($request->cover_image,0,strpos
            ($request->cover_image,';')))[1])[1];
        \Image::make($request->cover_image)->save(public_path('img/cover/'.$name));
        $request->merge(['cover_image' => $name]);
        
        $project = Project::create([
            'title' => $request['title'],
            'deal_type' => $request['deal_type'],
            'price' => $request['price'],
            'location' => $request['location'],
            'address' => $request['address'],
            'description' => $request['description'],
            'cover_image' => $request['cover_image'],
            'user_id' => $user_id,
        ]);
        $data =$project;
        Mail::to('bholasinghbunty@gmail.com')->send(new ProjectCreateMailToAdmin($request,$data));
        return ['message' => 'Created the new Project'];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $project = Project::find($id);
         return $project;
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
        $project = Project::findOrFail($id);

        $this->validate($request,[
            'title' => 'required|string|max:100',
            'deal_type' => 'required|string',
            'price' => 'required|string|max:5',
            'location' => 'required|string|max:100',
            'address' => 'required|string',
            'description' => 'required|string|max:191',
            'cover_image' => 'required',
        ]);
        //Uploading an an Cover Image
        $name = time().'.'. explode('/',explode(':',substr($request->cover_image,0,strpos
            ($request->cover_image,';')))[1])[1];
        \Image::make($request->cover_image)->save(public_path('img/cover/'.$name));
        $request->merge(['cover_image' => $name]);

        $project->update($request->all());
        return ['message' => 'Updated the project info'];
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
        $project = Project::findOrFail($id);
        //delete the user
        $project->delete();
        return ['message' => 'project deleted'];
    }

    public function search(){
        
        if($search = \Request::get('q')){
            $project = Project::where(function($query) use($search){
                    $query->where('id','LIKE',"%$search%")
                    ->orWhere('location','LIKE',"%$search%")
                    ->orWhere('deal_type','LIKE',"%$search%")
                    ->orWhere('title','LIKE',"%$search%"); 
            })->paginate(5);
        }
        
        return $project;
    }
}
