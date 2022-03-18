<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Category;
use App\Item;
use App\Site_item;
use App\Daily_site_report;

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
    public function show($id)
    {
        $ds_report = Daily_site_report::join('site_item', 'daily_site_report.id', '=', 'site_item.dsreport_id')
        ->join('categories', 'daily_site_report.cate_id', '=', 'categories.id')
        ->join('items', 'site_item.item_id', '=', 'items.id')
        ->select('categories.cat_name','items.item_name','daily_site_report.date', 'site_item.qty', 'site_item.unit_price')
        ->orderBy('date', 'desc')->get();
        return view('front.dailyside_report_view')->with('ds_report',$ds_report);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('proj_id',$id)->first();
        $category = Category::all();
        $item = Item::all();
        return view('front.dailyside_report')->with('project',$project)->with('category',$category)->with('item',$item);
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
        $ds_ids = Daily_site_report::where('proj_id', $request['proj_id'])->where('cate_id', $request['cate_id'])->where('date', $request['date'])->max('id');
        
        if($ds_ids > 0)
        {
        }
        else
        {
            Daily_site_report::create($request->all());
        }
        Site_item::create($request->all());
        $ds_id = Daily_site_report::where('proj_id', $request['proj_id'])->where('cate_id', $request['cate_id'])->where('date', $request['date'])->max('id');
        $ds_item = Site_item::where('item_id', $request['item_id'])->where('qty', $request['qty'])->where('unit_price', $request['unit_price'])->max('id');
        
        Site_item::where('id', $ds_item)
                ->update(['dsreport_id' => $ds_id]);

        $project = Project::where('proj_id',$request['proj_id'])->first();
        $category = Category::all();
        $item = Item::all();

        return view('front.dailyside_report')
        ->with('success','Site Details created successfully')
        ->with('project',$project)->with('category',$category)->with('item',$item);
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
