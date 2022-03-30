<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Project;
use App\Category;
use App\Item;
use App\Site_item;
use App\Site_employee;
use App\Daily_site_report;
use App\Employee;
use App\Budget;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BudgetController;

class DSReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $project = Project::all();
        $date = date('Y-m-d');
        return view('front.dailyside_report_view')->with('date',$date)->with('project',$project);
    }

    public function loadData(Request $request)
    {
        $date = $request->selDate;
        $project_id = $request->selProj;

        if($project_id > 0)
        {
            $projects = DB::table('daily_site_report')
                ->join('projects', 'daily_site_report.proj_id', '=', 'projects.proj_id')
                ->join('categories', 'daily_site_report.cate_id', '=', 'categories.id')
                ->select('projects.proj_name','categories.cat_name','daily_site_report.proj_id','daily_site_report.cate_id','daily_site_report.date')
                ->where('daily_site_report.date', $date)
                ->where('daily_site_report.proj_id', $project_id)
                ->get();
        }
        else
        {
            $projects = DB::table('daily_site_report')
                ->join('projects', 'daily_site_report.proj_id', '=', 'projects.proj_id')
                ->join('categories', 'daily_site_report.cate_id', '=', 'categories.id')
                ->select('projects.proj_name','categories.cat_name','daily_site_report.proj_id','daily_site_report.cate_id','daily_site_report.date')
                ->where('daily_site_report.date', $date)
                ->get();
        }

        return response()->json([
            'ds_report'=>$projects,
        ]);
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
        $project = DB::table('projects')
            ->join('proj_budgets', 'projects.proj_id', '=', 'proj_budgets.proj_id')
            ->select('projects.*')
            ->get();
        $employee = Employee::all();
        $sel_project = 0;
        $sel_category = 0;
        return view('front.dailyside_report')
        ->with('employee',$employee)->with('project',$project)
        ->with('sel_project',$sel_project)->with('sel_category',$sel_category);
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
        $selectedDate = $request['date'];
        $project_id = $request['proj_id'];
        $catogery_id = $request['cate_id'];

        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);

        $completed = DB::table('daily_site_report')
              ->where('id', $report_id)
              ->update(['is_completed' => 1]);

            $project = Project::all();
            $date = date('Y-m-d');
            return redirect()->route('dsreport')
            ->with('date',$date)->with('project',$project);
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
        $sel_project = $request['proj_id'];
        $sel_category = $request['cate_id'];

        return view('front.dailyside_report')
        ->with('success','Site Details created successfully')
        ->with('project',$project)->with('employee',$employee)
        ->with('sel_project',$sel_project)->with('sel_category',$sel_category);
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
    public function get_budget_id($project_id)
    {
        $budget_id = DB::table('proj_budgets')
        ->where('proj_id',$project_id)
        ->where('complete',1)
        ->first();
        return $budget_id->budg_id;
    }
    public function projcat(Request $request)
    {
        $proj_id = $request->proj_id;
        $budget_id = $this->get_budget_id($proj_id);
        $category = DB::table('categories')
        ->join('category_budget', 'categories.id', '=', 'category_budget.catogery_id')
        ->select('categories.*')
        ->where('category_budget.budget_id',$budget_id)
        ->get();
        ?>
                <option value="">Select Catogery</option>
        <?php
        foreach ($category as $cat) {
            ?>
                <option value="<?php echo $cat->id; ?>"><?php echo $cat->cat_name; ?></option>
            <?php
        }
        // return response()->json([
        //     'category'=>$category,
        // ]);
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
        ?>
        <option value="">Select Item</option>
        <?php
        foreach ($items as $itms) {
            ?>
            <option value="<?php echo $itms->id; ?>"><?php echo $itms->item_name; ?></option>
            <?php
        }
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function empdetails(Request $request)
    {
        $emp_id = $request->emp_id;
        $employee = Employee::where('emp_id', $emp_id)->get();
        return response()->json([
            'emp'=>$employee,
        ]);
    }

    public function projects_for_trans(Request $request)
    {
        $proj_id = $request->project_id;
        $cate_id = $request->cate_id;

        //$budget_id = $this->get_budget_id($proj_id);
        $project = DB::table('daily_site_report')
        ->join('projects', 'projects.proj_id', '=', 'daily_site_report.proj_id')
        ->select('projects.*')
        ->where('daily_site_report.cate_id',$cate_id)
        ->where('daily_site_report.proj_id','!=',$proj_id)
        ->get();
        
        foreach ($project as $pro) {
            ?>
                <option value="<?php echo $pro->proj_id; ?>"><?php echo $pro->proj_name; ?></option>
            <?php
        }
    }

    public function insertDailyReports(Request $request)
    {
        $date = $request->date;

        $is_available = DB::table('daily_site_report')
                ->where('date',$date)
                ->get();
        if ($is_available->count()) {
            //return redirect('/dsreport');
            echo 0;
        }
        else{
            $projects = DB::table('proj_budgets')
                ->where('complete',1)
                ->get();
            foreach ($projects as $project) {
                $project_id = $project->proj_id; 
                $budget_id = $project->budg_id;

                $catogery = DB::table('category_budget')
                    ->where('budget_id',$budget_id)
                    ->get();
                foreach ($catogery as $cat) {
                    $catogery_id = $cat->catogery_id;
                    // echo "<br>";
                    // Insert into category_budget
                    DB::insert('insert into daily_site_report (proj_id, cate_id, date) values (?,?,?)', [$project_id,$catogery_id,$date]);
                }
            }
            return redirect('/dsreport');
        }
    }

    static function project_name($project_id)
    {
        $project = DB::table('projects')
                ->where('proj_id',$project_id)
                ->first();
        return $project->proj_name;
    }

    static function catogery_name($catogery_id)
    {
        $catogery = DB::table('categories')
                ->where('id',$catogery_id)
                ->first();
        return $catogery->cat_name;
    }

    public function budget_id($project_id)
    {
        $budget_id = DB::table('proj_budgets')
        ->where('proj_id',$project_id)
        ->where('complete',0)
        ->first();
        return $budget_id->budg_id;
    }

    static function catogery_amount($project_id,$catogery_id)
    {
        $budget = DB::table('proj_budgets')
        ->where('proj_id',$project_id)
        ->where('complete',1)
        ->first();

        $budget_id = $budget->budg_id;

        $catogery = DB::table('category_budget')
                ->where('catogery_id',$catogery_id)
                ->where('budget_id',$budget_id)
                ->first();
        return $catogery->amount;
    }

    // Update Daily Site Report 
    public function updateDailyReports($id)
    {
        //$reportData = $this->reportData($id);
        $array = explode('_',$id);
        $project_id = $array[0];
        $catogery_id = $array[1];
        $sel_date = $array[2];

        $project = DB::table('projects')
            ->join('proj_budgets', 'projects.proj_id', '=', 'proj_budgets.proj_id')
            ->select('projects.*')
            ->get();

        $category = DB::table('categories')
            ->join('daily_site_report', 'categories.id', '=', 'daily_site_report.cate_id')
            ->select('categories.*')
            ->where('daily_site_report.proj_id',$project_id)
            ->get();
        
        $items = DB::table('items')
            ->where('cat_id',$catogery_id)
            ->get();

        $employee = Employee::all();
        $sel_project = 0;
        $sel_category = 0;

        return view('dailyReport.dailyside_report')
        ->with('employee',$employee)
        ->with('project',$project)
        ->with('category',$category)
        ->with('items',$items)
        ->with('sel_project',$sel_project)
        ->with('sel_category',$sel_category)
        ->with('sel_date',$sel_date)
        ->with('project_id',$project_id)
        ->with('catogery_id',$catogery_id)
        ->with('report_id',$id);
    }

    //Get Report data by report id
    public function reportData($report_id)
    {
        $report = DB::table('daily_site_report')
                ->where('id',$report_id)
                ->first();
        return $report;
    }

    // Insert Received items
    public function insert_received(Request $request)
    {
        $item_id = $request->item_id;
        $received_qty = $request->received_qty;
        $received_price = $request->received_price;
        $selectedDate = $request->selectedDate;
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;

        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);

        // Insert Rec Items
        $save = DB::insert('insert into site_item (dsreport_id,item_id,qty,unit_price) 
        values (?,?,?,?)', 
        [$report_id,$item_id,$received_qty,$received_price]);

        if ($save) {
            $this->show_items($report_id);
        }

    }

    public function insert_transferred(Request $request)
    {
        $item_id = $request->transitem;
        $transferred_qty = $request->transferred_qty;
        $transferred_price = $request->transferred_price;
        $selectedDate = $request->selectedDate;
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;
        $trans_project_id = $request->transfer_proj_id;

        //Minus record
        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);
        $save = DB::insert('insert into site_item (dsreport_id,item_id,qty,unit_price,transfer_proj_id) 
        values (?,?,?,?,?)', 
        [$report_id,$item_id,$transferred_qty,$transferred_price,$trans_project_id]);

        if($save)
        {
            //Plus record
            $transreport_id = $this->getReport_id($trans_project_id,$catogery_id,$selectedDate);
            $trans_qty  = $transferred_qty * -1;

            $save_trans = DB::insert('insert into site_item (dsreport_id,item_id,qty,unit_price,received_proj_id) 
            values (?,?,?,?,?)', 
            [$transreport_id,$item_id,$trans_qty,$transferred_price,$project_id]);

            if ($save_trans) {
                $this->show_items_trans($report_id);
            }
        }
    }

    public function insert_emp_amount(Request $request)
    {
        $emp_id = $request->emp_id;
        $amount = $request->amount;
        $selectedDate = $request->selectedDate;
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;

        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);

        // Insert Employees' Salary
        $save = DB::insert('insert into site_employee (dsreport_id,emp_id,amount) 
        values (?,?,?)', 
        [$report_id,$emp_id,$amount]);

        if ($save) {
            $this->show_employees($report_id);
        }
    }

    public function loadEmp(Request $request)
    {
        $selectedDate = $request->selectedDate;
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;

        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);
        $this->show_employees($report_id);
    }
    public function loadRec(Request $request)
    {
        $selectedDate = $request->selectedDate;
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;

        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);
        $this->show_items($report_id);
    }
    public function loadTrans(Request $request)
    {
        $selectedDate = $request->selectedDate;
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;

        $report_id = $this->getReport_id($project_id,$catogery_id,$selectedDate);
        $this->show_items_trans($report_id);
    }

    // Get Report ID
    public function getReport_id($project_id,$catogery_id,$selectedDate)
    {
        $report = DB::table('daily_site_report')
                ->where('proj_id',$project_id)
                ->where('cate_id',$catogery_id)
                ->where('date',$selectedDate)
                ->first();
        return $report->id;
    }

    public function show_items($report_id)
    {
        // Get Items
        $received_items = DB::table('site_item')
        ->join('items', 'site_item.item_id', '=', 'items.id')
        ->select('site_item.*','items.item_name')
        ->where('dsreport_id',$report_id)
        ->where('transfer_proj_id',0)
        ->get();
        ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th class="text-center">Item</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Total</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                foreach ($received_items as $rec) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $rec->item_name; ?></td>
                        <td class="text-center"><?php echo $qty = $rec->qty; ?></td>
                        <td class="text-right"><?php echo $uprice= $rec->unit_price; ?>.00</td>
                        <td class="text-right"><?php echo $tot = $qty*$uprice; ?>.00</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                $total = $total + $tot;
                $i++;
                }
                if($i > 1)
                {
                ?>
                    <tr>
                        <td colspan="4" class="text-center"><b><?php echo "Sub Total for Received Items : "; ?></b></td>
                        <td class="text-right"><b><?php echo $total; ?>.00</b></td>
                        <td class="text-center"></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function show_items_trans($report_id)
    {
        // Get Items
        $received_items = DB::table('site_item')
        ->join('items', 'site_item.item_id', '=', 'items.id')
        ->select('site_item.*','items.item_name')
        ->where('dsreport_id',$report_id)
        ->where('transfer_proj_id', '>',0)
        ->get();
        ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th class="text-center">Item</th>
                <th class="text-center">Quantity</th>
                <th class="text-right">Unit Price</th>
                <th class="text-right">Total</th>
                <th class="text-right">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                foreach ($received_items as $rec) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $rec->item_name; ?></td>
                        <td class="text-center"><?php echo $qty = $rec->qty*-1; ?></td>
                        <td class="text-right"><?php echo $uprice= $rec->unit_price; ?>.00</td>
                        <td class="text-right"><?php echo $tot = $qty*$uprice; ?>.00</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                $total = $total + $tot;
                $i++;
                }
                if($i > 1)
                {
                ?>
                    <tr>
                        <td colspan="4" class="text-center"><b><?php echo "Sub Total for Transferred Items : "; ?></b></td>
                        <td class="text-right"><b><?php echo $total; ?>.00</b></td>
                        <td class="text-center"></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }

    public function show_employees($report_id)
    {
        // Get Items
        $received_items = DB::table('site_employee')
        ->join('employees', 'site_employee.emp_id', '=', 'employees.emp_id')
        ->where('site_employee.dsreport_id',$report_id)
        ->get();
        ?>
        <input type="text" value="<?php echo $report_id; ?>" id="report_id" hidden>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th class="text-center">Employee Name</th>
                <th class="text-center">Skills</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                foreach ($received_items as $rec) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $rec->emp_name; ?></td>
                        <td class="text-center"><?php echo $rec->Skills; ?></td>
                        <td class="text-center"><?php echo $qty = $rec->amount; ?></td>
                        <td class="text-center">
                            <a href="#" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                $total = $total + $rec->amount;
                $i++;
                }
                if($i > 1)
                {
                ?>
                    <tr>
                        <td colspan="3" class="text-center"><b><?php echo "Sub Total for the Employees : "; ?></b></td>
                        <td class="text-center"><b><?php echo $total; ?>.00</b></td>
                        <td class="text-center"></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
}
