<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;

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
