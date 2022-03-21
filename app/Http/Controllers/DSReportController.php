<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Category;
use App\Item;
use App\Site_item;
use App\Daily_site_report;
use App\Employee;
use App\Budget;

class DSReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        $date = date('Y-m-d');
        return view('front.dailyside_report_view')->with('date',$date)->with('project',$project);
    }

    public function dsrcat(Request $request)
    {
        $date = $request->selDate;
        $proj = $request->selProj;
        
        if($proj > 0)
        {
            $ds_report = Daily_site_report::join('site_item', 'daily_site_report.id', '=', 'site_item.dsreport_id')
            ->join('projects', 'daily_site_report.proj_id', '=', 'projects.proj_id')
            ->join('categories', 'daily_site_report.cate_id', '=', 'categories.id')
            ->join('items', 'site_item.item_id', '=', 'items.id')
            ->select('projects.proj_name','categories.cat_name','items.item_name','daily_site_report.date', 'site_item.qty', 'site_item.unit_price','site_item.transfer_proj_id','site_item.received_proj_id')
            ->where('daily_site_report.date',$date)
            ->where('daily_site_report.proj_id',$proj)
            ->orderBy('daily_site_report.proj_id', 'ASC')
            ->orderBy('daily_site_report.cate_id', 'ASC')
            ->orderBy('site_item.transfer_proj_id', 'ASC')
            ->get();
        }
        else
        {
            $ds_report = Daily_site_report::join('site_item', 'daily_site_report.id', '=', 'site_item.dsreport_id')
            ->join('projects', 'daily_site_report.proj_id', '=', 'projects.proj_id')
            ->join('categories', 'daily_site_report.cate_id', '=', 'categories.id')
            ->join('items', 'site_item.item_id', '=', 'items.id')
            ->select('projects.proj_name','categories.cat_name','items.item_name','daily_site_report.date', 'site_item.qty', 'site_item.unit_price','site_item.transfer_proj_id','site_item.received_proj_id')
            ->where('daily_site_report.date',$date)
            ->orderBy('daily_site_report.proj_id', 'ASC')
            ->orderBy('daily_site_report.cate_id', 'ASC')
            
            ->get();
        }

        return response()->json([
            'ds_report'=>$ds_report,
        ]);
        //return view('front.dailyside_report_view',compact(ds_report));
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
    public function add()
    {
        $project = Project::all();
        $employee = Employee::all();
        return view('front.dailyside_report')->with('employee',$employee)->with('project',$project);
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
        $request['transfer_proj_id'] = 0;
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

        $project = Project::all();
        //$category = Category::all();
        //$item = Item::all();
        $employee = Employee::all();

        return view('front.dailyside_report')
        ->with('success','Site Details created successfully')
        ->with('project',$project)->with('employee',$employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trans(Request $request)
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

                //Trans
        $ds_id_trans = Daily_site_report::where('proj_id', $request['transfer_proj_id'])->where('cate_id', $request['cate_id'])->where('date', $request['date'])->max('id');
        if($ds_id_trans > 0)
        {
        }
        else
        {
            Daily_site_report::insert([
                'proj_id' => $request['transfer_proj_id'],
                'cate_id' => $request['cate_id'],
                'date' => $request['date']
            ]);
        }
        $ds_id = Daily_site_report::where('proj_id', $request['transfer_proj_id'])->where('cate_id', $request['cate_id'])->where('date', $request['date'])->max('id');
        $trans_qty = $request['qty']*-1;
        Site_item::insert([
            'dsreport_id' => $ds_id,
            'item_id' => $request['item_id'],
            'qty' => $trans_qty,
            'unit_price' => $request['unit_price'],
            'received_proj_id' => $request['proj_id']
        ]);

        $project = Project::all();
        $employee = Employee::all();

        return view('front.dailyside_report')
        ->with('success','Site Details created successfully')
        ->with('project',$project)->with('employee',$employee);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function projcat(Request $request)
    {
        $proj_id = $request->proj_id;
        $category = Budget::where('proj_id', $proj_id)->get();
        return response()->json([
            'category'=>$category,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function catitem(Request $request)
    {
        $cate_id = $request->cate_id;
        $items = Item::where('cat_id', $cate_id)->get();
        return response()->json([
            'items'=>$items,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trans_catitem(Request $request)
    {
        $cate_id = $request->cate_id;
        $items = Site_item::groupBy('site_item.item_id')
        ->join('daily_site_report', 'site_item.dsreport_id', '=', 'daily_site_report.id')
        ->selectRaw('sum(qty) as sum, site_item.item_id')
        ->where('daily_site_report.cate_id',$cate_id)
        ->having('sum', '>', 0)->get();
        return response()->json([
            'items'=>$items,
        ]);
    }
}
