<?php

namespace App\Http\Controllers;

use App\item;
use App\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $Item = item::all();
        return view('front.items')->with('Item',$Item)->with('category',$category);
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
    public function show(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name'=>'required',
            'item_description'=>'required',
            'cat_code'=>'required',
            
        ]);

        Item::create($request->all());

        return redirect()->route('item')
        ->with('success','item created successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    
    {
        $category = Category::all();
        $item=Item::where('id',$id)->first();
        return view('front.edit_item',compact('item','category'));
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
            'item_name'=>'required',
            'item_description'=>'required',
            'cat_id'=>'required',
        ]);

        $item = Item::where('id',$id)->get();
      
        Item::where('id', $id)->update([
            'item_name' => $request['item_name'],
            'item_description'=> $request['item_description'],
            'cat_id'=> $request['cat_id'],
            
        ]);
        return redirect()->route('item')
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
