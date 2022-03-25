
@extends('layouts.master')
@section('content')
    
<style type="text/css">
        .m-b-5{
          margin-bottom: 5px;
        }
        .m-b-10{
          margin-bottom: 10px;
        }
        .btn-dangerr {
    color: #fff;
    background-color: #636161;
    border-color: #636161;
    font-size: 18px;
}
.btn-dangerr:hover {
    color: #fff;
    background-color: #636161;
    border-color: #636161;
    font-size: 18px;
}
.btn-successs {
    color: #fff;
    background-color: #252f76;
    border-color: #252f76;
    font-size: 18px;
}
.btn-successs:hover {
    color: #fff;
    background-color: #252f76;
    border-color: #252f76;
    font-size: 18px;
}
.form-control {
    display: block;
    width: 100%;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;

    line-height: 1.5;
    color: #212529;
    background-clip: padding-box;
    border: 1px solid #b2022f;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

      </style>
<!-- Modal -->
            <div class="row">
                <div class="col-md-7">
                    <!-- Modal content-->
                    <div class="modal-content">
                            <div class="modal-header" style="color:white;background-color: #B2022F;">
                                <div style="flex-direction:column;">
                                <h4 class="text-center modal-title" style="color:white">Add Project Budget</h4>
                                </div>
                            </div>

                        
                            <div class="modal-body">
                                @if($errors->any())
                                <div class="alert alert-danger">
                                <strong>Woops!</strong>There is a problem with your inputs.<br><br>
                                <ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                                </div>
                                @endif
                                @csrf
                                @method('PUT')
                                    <div class="m-b-10">
                                    <?php
                                        use App\Http\Controllers\BudgetController;
                                    ?>
                                        <select name="projects" id="projects" class="form-control">
                                            <option value="">Select Project</option>
                                            @foreach ($projects as $project)
                                            
                                            <?php
                                            $is_available = BudgetController::is_projectid($project->proj_id);
                                            if ($is_available == 1) {
                                                $disabled = "disabled";
                                            }
                                            else{
                                                $disabled = "";
                                            }
                                            ?>
                                                <option {{$disabled}} value="{{ $project->proj_id }}">{{ $project->proj_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    

                                    <div class="m-b-10">
                                        <select name="catogery" id="catogery" class="form-control">
                                            <option value="">Select catogery</option>
                                            @foreach ($category as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="m-b-10">
                                        <input type="text" id="amount" class="form-control">
                                    </div>
                            </div>
                            
                            <div class="modal-footer">
                                <a id="add_budget" class="btn btn-dark">Add Budget</a>
                            </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div id="project_budget">

                    </div>
                </div>
            </div>

            <!-- jQuery library -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script>
            $(document).ready(function(){
                $("#add_budget").click(function(){
                    var project_id = $("#projects").val();
                    var catogery_id = $("#catogery").val();
                    var amount = $("#amount").val();
                    $.ajax({
                        type:'get',
                        url:'{!!url('insert_budget')!!}',
                        data:{'project_id':project_id,'catogery_id':catogery_id,'amount':amount},
                        success:function(response){
                            //alert(response);
                            $("#project_budget").html(response);
                        }
                    });
                });

                $("#projects").change(function(){
                    var project_id = $(this).val();
                    $.ajax({
                        type:'get',
                        url:'{!!url('show_cat_budget')!!}',
                        data:{'project_id':project_id},
                        success:function(response){
                            $("#project_budget").html(response);
                        }
                    });
                });
            });
            </script>
      @endsection