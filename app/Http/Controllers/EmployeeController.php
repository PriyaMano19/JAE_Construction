<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employee = Employee::all();
        return view('front.employee')->with('employee',$employee);
    }

    public function home()
    {

        $projStatus = DB::table('proj_budgets')
        ->join('category_budget','proj_budgets.budg_id','=','category_budget.budget_id')
        ->join('projects','proj_budgets.proj_id','=','projects.proj_id')
        ->select('proj_budgets.proj_id','projects.proj_name', DB::raw('sum(Amount) as total'))
        ->where('proj_budgets.complete',1)
        ->groupBy('proj_budgets.proj_id','projects.proj_name')->get();
        return view('home')->with('projStatus',$projStatus);
    }

    static function utilized_amount($proj_id)
    {
        $total = 0;
        $projects = DB::table('daily_site_report')
        ->where('daily_site_report.proj_id',$proj_id)
        ->get();

        foreach($projects as $row)
        {
            $projectID = $row->id;

            $sub_categories = DB::table('site_item')
            ->select(DB::raw('sum(qty*unit_price) as total'))
            ->where('site_item.dsreport_id',$projectID)
            ->groupBy('site_item.dsreport_id')->get();

            foreach($sub_categories as $row)
            {
                $total = $total+$row->total;
            }
        }
        return $total;
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
            'emp_name'=>'required',
            'contact_no'=>'required',
            'NIC'=>'required',
            'Skills'=>'required',
            'Amount'=>'required',
        ]);

        Employee::create($request->all());

        return redirect()->route('employee')
        ->with('success','employee created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employee.show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int  $id)

    {
        //$id=1;
       $employee=Employee::where('emp_id',$id)->first();
       
        return view('front.edit_employee',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'emp_name'=>'required',
            'contact_no'=>'required',
            'NIC'=>'required',
            'Skills'=>'required',
            'Amount'=>'required',
        ]);

        
        $employee = Employee::where('emp_id',$id)->get();
      //  $employee->update($request->all());
        Employee::where('emp_id', $id)->update([
            'emp_name' => $request['emp_name'],
            'contact_no'=> $request['contact_no'],
            'NIC'=> $request['NIC'],
            'Skills'=> $request['Skills'],
            'Amount'=> $request['Amount'],
        ]);
        return redirect()->route('employee')
        ->with('success','Updated successfully');
    }
    public function changestatus(Request $request){

        $employee = Employee::find($request->emp_id);
        $employee->status = $request->status;
        $employee->save();
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   /* public function destroy(Employee $employee)
    {
        $employee->delete();

        return redirect()->route('employee')
        ->with('success','deleted successfully');
    }*/
}
