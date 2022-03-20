<?php

namespace App\Http\Controllers;
use App\Budget;
use App\Category;
use App\Project;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $budget = Budget::all();
        $project = Project::all();
        $category = Category::all();
     
        return view('front.proj_budget')->with('budget',$budget)->with('project',$project)->with('category',$category);
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
          $request->validate([
            'proj_id'=>'required',
            'cate_id'=>'required',
            'budg_version'=>'required',
          
            'Amount'=>'required',
        ]);

        Budget::create($request->all());

        return redirect()->route('budget')
        ->with('success','Budget created successfully');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Budget $budget)
    {
        return view('budget.show',compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Budget $budget)
    {
        $request->validate([

        ]);

        $budget->update($request->all());
        //$employee = Employee::where('id',$employee)->first();
        return redirect()->route('budget')
        ->with('success','Updated successfully');
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
