<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        return view('front.project')->with('project',$project);
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
        $request->validate([
            'proj_name'=>'required',
            'start_date'=>'required',
            'total_cost'=>'required',
            'proj_owner'=>'required',
            'proj_engineer'=>'required',
            'description'=>'required',
        ]);

        Project::create($request->all());

        return redirect()->route('project')
        ->with('success','Project created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
<<<<<<< HEAD
       // return view('project.show',compact('project'));
=======
        //
>>>>>>> bb9a308132425b2872710488982f86ec50ecbe12
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update(Request $request)
    {
<<<<<<< HEAD
        $request->validate([
            'proj_name'=>'required',
            'start_date'=>'required',
            'total_cost'=>'required',
            'proj_owner'=>'required',
            'proj_engineer'=>'required',
            'description'=>'required',
        ]);

        $project->update($request->all());
        //$employee = Employee::where('id',$employee)->first();
        return redirect()->route('project')
        ->with('success','Updated successfully');
=======
        //
>>>>>>> bb9a308132425b2872710488982f86ec50ecbe12
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
