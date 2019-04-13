<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;

class ProjectController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project_data = Project::orderBy('created_at','desc')->paginate(6);
        return view('project.index')->with('project_data',$project_data);
    }

    public function bungalow()
    {
        $posts = Project::orderBy('created_at','desc')->paginate(6);
        $project_data = Project::select('*')-> where('deal_type','Bungalow')->paginate(6);
        return view('projectpage.bungalow')->with('project_data',$project_data);
        
    }
    public function house()
    {
        $posts = Project::orderBy('created_at','desc')->paginate(6);
        $project_data= Project::select('*')-> where('deal_type','House')->paginate(6);
        return view('projectpage.house')->with('project_data',$project_data);
        
    }
    public function land()
    {
        
        $posts = Project::orderBy('created_at','desc')->paginate(6);
        $project_data = Project::select('*')-> where('deal_type','Land')->paginate(6);
        return view('projectpage.land')->with('project_data',$project_data);
        
    }
    public function flat()
    {
        $posts = Project::orderBy('created_at','desc')->paginate(6);
        $project_data = Project::select('*')-> where('deal_type','Flat')->paginate(6);
        return view('projectpage.building')->with('project_data',$project_data);
        
    }
    public function projectShow($id)
    {
        $project_data = Project::find($id);
        
        return view('projectpage.projectshow')->with('project_data',$project_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project_data = Project::find($id);
        return view('project.show')->with('project_data',$project_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project_data = Project::find($id);

        $project -> delete();
        return redirect('/project')->with('success','Post Deleted');
    }
}
