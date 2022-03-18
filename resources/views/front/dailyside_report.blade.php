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
              <h4 class="text-center modal-title" style="color:white">Project Site Details</h4>
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
            <div class="form-group">
              <div class="row">
                <div class="m-b-10 col-sm-4">
                <input class="form-control" type="hidden" name="proj_id" placeholder="Project Name" value="{{$project->proj_id}}">
                  <input class="form-control" type="text" name="name" placeholder="Project Name" value="{{$project->proj_name}}">
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <input class="form-control" type="date" name="date" placeholder="Date" value="{{date('Y-m-d')}}">
                </div>
              </div>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <select class="form-control" id="cate_id" name="cate_id" required focus>       
                    <option value=""></option>  
                    @foreach($category as $cat)
                    <option value="{{$cat->id}}">{{ $cat->cat_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <select class="form-control" id="item_id" name="item_id" required focus>  
                    <option value=""></option>     
                    @foreach($item as $it)
                    <option value="{{$it->id}}">{{ $it->item_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            <hr>
            <p><b> &nbsp;&nbsp;&nbsp; Item Received </b></p>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <input class="form-control" type="text" name="qty" placeholder="Quantity Received" value="">
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <input class="form-control" type="text" name="unit_price" placeholder="Unit Price" value="">
                </div>
                <div class="m-b-10 col-sm-2">
                <input type="submit" name="submit" style="border-radius: 0px;" class="btn btn-dark" value="ADD">
                </div>
              </div>

            <hr>
            <p><b> &nbsp;&nbsp;&nbsp; Item Transfer </b></p>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <input class="form-control" type="text" name="transquantity" placeholder="Quantity Transfer" value="">
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <input class="form-control" type="text" name="transcunitprice" placeholder="Unit Price" value="">
                </div>
                <div class="m-b-10 col-sm-2">
                  <button style="border-radius: 0px;" type="button" class="btn btn-dark" data-dismiss="modal">ADD</button>
                </div>
              </div>
            </div>

            <hr>
            <p><b> &nbsp;&nbsp;&nbsp; Employee </b></p>
            <div class="form-group">
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <input class="form-control" type="text" name="employee" placeholder="Employee" value="">
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4"></div>
                <div class="m-b-10 col-sm-2">
                <button style="border-radius: 0px;" type="button" class="btn btn-dark" data-dismiss="modal">ADD</button>
                </div>
              </div>
              </div>
            </div>

            <div class="modal-footer">
              <button style="border-radius: 0px;" type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
            </div>
            </form>
          </div>
      @endsection