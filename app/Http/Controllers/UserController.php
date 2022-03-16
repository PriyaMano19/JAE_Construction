<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.login');
        }

        public function check(Request $request)
    {  
        /*$user = $request->username;
        $pass  = $request->password;
 
        if (auth()->attempt(array('username' => $user, 'password' => $pass)))
        {
         return view('front.employee');
        }
        else
         {  
             session()->flash('error', 'Invalid Credentials');
             return redirect()->route('employee');
         }  */

        

        $users = User::where('username', $request['username'])->where('password', $request['password'])->get();
        $count = $users->count();

        if($count > 0) {
            return redirect()->route('employee');   
        }
        else{
            session()->flash('error', 'Invalid Credentials');
            return redirect()->route('front.login');
        }
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
        //
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
        //
    }
}
