<?php

namespace App\Http\Controllers;
use App\Budget;
use App\Cbudget;
use App\Category;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // Budget::create($request->all());
        Budget::create([
            'proj_id' => $request['proj_id'],
            'budg_version'=> $request['budg_version'],
           
            
        ]);
        Cbudget::create([
        
          'cate_id'=> $request['cate_id'],
          'Amount'=> $request['Amount'],
          
      ]);

        return redirect()->route('budget')
        ->with('success','Budget created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $dets=DB::table('proj_budgets')
        ->join('cate_budget','proj_budgets.budg_id','=','cate_budget.budg_id')
        ->select('proj_budgets.budg_id','proj_budgets.proj_id','proj_budgets.budg_version','cate_budget.cate_id','cate_budget.Amount')
        ->get();
        return view('front.view_budget',compact('dets'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
       
        return view('front.edit_budget',compact('budget'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,int $id,int $id1)
    {
        $request->validate([
            // 'proj_id'=>'required',
            // 'cate_id'=>'required',
            'budg_version'=>'required',
          
            'Amount'=>'required',
        ]);

        $budget = Budget::where('budg_id',$id)->get();
        $cbudget = Cbudget::where('c_id',$id1)->get();
        Budget::where('budg_id', $id)->create([
              'proj_id' => $request['proj_id'],
              'budg_version'=> $request['budg_version'],
             
              
          ]);
          Cbudget::where('c_id', $id1)->create([
            'budg_id'=> $request['budg_id'],
            'cate_id'=> $request['cate_id'],
            'Amount'=> $request['Amount'],
            
        ]);
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
