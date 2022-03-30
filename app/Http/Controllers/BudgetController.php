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
        $budget = DB::table('proj_budgets')
        ->join('projects','proj_budgets.proj_id','=','projects.proj_id')
        ->select('proj_budgets.budg_id','proj_budgets.proj_id','proj_budgets.budg_version','projects.proj_name')
        ->get();

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

    // Add Budget form
    public function addbudget()
    {
        $category = DB::table('categories')->get();
        $projects = DB::table('projects')->get();
        return view('budget.add_budget')
        ->with('category',$category)
        ->with('projects',$projects);
    }

    // show catogery budget for project
    public function show_cat_budget(Request $request)
    {
        $project_id = $request->project_id;

        $project = DB::table('projects')->where('proj_id',$project_id)->first();
        $project_name = $project->proj_name;
        $budgets = DB::table('proj_budgets')
        ->where('proj_id',$project_id)
        ->where('complete',0)
        ->get();

        if ($budgets->count()) {
            // get budget id
            $budget_id = $this->get_budget_id($project_id);
            // Return Table
            $this->catogery_budgets($budget_id);
        }
        else{
            ?>
            <h3 id="project_name" class="text-center"><?php echo $project_name; ?></h3>
            <hr>
            <div>
                <div class="alert alert-warning">
                    <strong>Warning!</strong>There are no Budgets.
                </div>
            </div>
            <?php
        }
    }

    public function insert_budget(Request $request)
    {
        $project_id = $request->project_id;
        $catogery_id = $request->catogery_id;
        $amount = $request->amount;

        $budgets = DB::table('proj_budgets')
        ->where('proj_id',$project_id)
        ->where('complete',0)
        ->get();

        if ($budgets->count()) {
             // get budget id
             $budget_id = $this->get_budget_id($project_id);
             if ($this->is_catogery($catogery_id,$budget_id)) {
                # code...
            }
            else{
                // Insert into category_budget
                DB::insert('insert into category_budget (budget_id, catogery_id, amount) values (?,?,?)', [$budget_id,$catogery_id,$amount]);
            }
            
             // Return Table
             $this->catogery_budgets($budget_id);
        }
        else{
            // Add in project Budget
            $budget = new Budget;
            $budget->proj_id = $request->project_id;
            $budget->budg_version = 1;
            $budget->save();

            // get budget id
            $budget_id = $this->get_budget_id($project_id);

            if ($this->is_catogery($catogery_id,$budget_id)) {
                # code...
            }
            else{
                // Insert into category_budget
                DB::insert('insert into category_budget (budget_id, catogery_id, amount) values (?,?,?)', [$budget_id,$catogery_id,$amount]);
            }
            // Return Table
            $this->catogery_budgets($budget_id);
        }
    }

    public function is_catogery($catogery_id,$budget_id)
    {
        $catogery = DB::table('category_budget')
        ->where('catogery_id',$catogery_id)
        ->where('budget_id',$budget_id)
        ->get();
        return $catogery->count();
    }

    static function is_projectid($proj_id)
    {
        $project_id = DB::table('proj_budgets')
        ->where('proj_id',$proj_id)
        ->where('complete',1)
        ->get();
        return $project_id->count();
    }

    public function get_budget_id($project_id)
    {
        $budget_id = DB::table('proj_budgets')
        ->where('proj_id',$project_id)
        ->where('complete',0)
        ->first();
        return $budget_id->budg_id;
    }

    public function catogery_budgets($budget_id)
    {
        $budget_cats = DB::table('category_budget')
        ->where('budget_id',$budget_id)
        ->get();
        
        ?>
        <input type="text" value="<?php echo $budget_id; ?>" id="budget_id" hidden>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Catogery</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                $total = 0;
                foreach ($budget_cats as $budget_cat) {
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center"><?php echo $this->catogery_name($budget_cat->catogery_id);  ?></td>
                        <td class="text-right"><?php echo $budget_cat->amount;  ?>.00</td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-danger">Delete</a>
                        </td> 
                    </tr>
                    <?php
                    $i++;
                    $total = $total+$budget_cat->amount;
                }
                ?>
                <tr class="font-weight-bolder">
                    <td></td>
                    <td class="text-center">Total</td>
                    <td class="text-right"><?php echo $total; ?>.00</td>
                    <td class="text-center">
                        <a onclick="confirm_complete()" href="#" class="btn btn-sm btn-dark">Complete</a>
                    </td>
                </tr>
            </tbody>
        </table>
        <script>
            function confirm_complete() {
                let text = "Once you click complete!\n.You can't modify this version";
                var budget_id =  $("#budget_id").val();
                if (confirm(text) == true) {
                    // Complete the project
                    window.location.href = "complete_budget/"+budget_id;
                } 
                else {
                    //text = "You canceled!";
                }
            }
        </script>
        <?php
    }

    public function complete_budget($budget_id)
    {
            $completed = DB::table('proj_budgets')
              ->where('budg_id', $budget_id)
              ->update(['complete' => 1]);
            return redirect('/budget')->with('complete', 'Project Budget Successfully Completed!!');
    }

    public function catogery_name($id)
    {
        $catogery = DB::table('categories')
        ->where('id',$id)
        ->first();
        return $catogery->cat_name;
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
