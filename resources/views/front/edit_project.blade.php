@extends('layouts.master')
@section('content')
    
<!-- Modal -->

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
    background-color: #C5C5C5;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 0.25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

      </style>


          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="color:white;background-color: #B2022F;">
            <div style="flex-direction:column;">
              <h4 class="text-center modal-title" style="color:white">Edit Employee</h4>
             
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
              <form action="{{route('project.update',$project->proj_id)}}" method="post" >
            @csrf
            @method('PUT')
                
                <div class="m-b-10">
                  <input class="form-control" type="text" name="proj_name" placeholder="Project Name" value="{{$project->proj_name}}">
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="date" name="start_date" placeholder="Start Date" value="{{$project->start_date}}">
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="total_cost" placeholder="Total Cost" value="{{$project->total_cost}}">
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="proj_owner" placeholder="Owner" value="{{$project->proj_owner}}">
                </div>

                <div class="m-b-10">
                  <input class="form-control" type="text" name="proj_engineer" placeholder="Engineer" value="{{$project->proj_engineer}}">
                  
                </div>

                
                <div class="m-b-10">
                  <input class="form-control" type="text" name="description" placeholder="Description" value="{{$project->description}}">
                  
                </div>
                

                  
              
            </div>
            <div class="modal-footer">
              <button style="border-radius: 0px;" type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
              <input type="submit" name="submit" style="border-radius: 0px;" class="btn btn-dark" value="Update">
            </div>
            </form>
          </div>

        
      @endsection