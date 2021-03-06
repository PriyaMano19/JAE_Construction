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
              <h4 class="text-center modal-title" style="color:white">Edit Budget</h4>
             
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
              <form action="{{route('budget.update',$budget->budg_id)}}" method="post" >
            @csrf
            @method('PUT')
                
            <div class="m-b-10">
            <div class="m-b-10">
                  <input class="form-control" type="text" name="proj_id" placeholder=""  value="{{$budget->proj_id}}" disabled>
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="cate_id" placeholder=""  value="{{$budget->cate_id}}" disabled>
                </div>
            
                <div class="m-b-10">
                  <input class="form-control" type="text" name="budg_version" placeholder="budget version"  value="{{$budget->budg_version}}">
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="Amount" placeholder="Amount"  value="{{$budget->Amount}}">
                </div>

                  
              
            </div>
            <div class="modal-footer">
              <button style="border-radius: 0px;" type="button" class="btn btn-danger" data-dismiss="modal">Back</button>
              <input type="submit" name="submit" style="border-radius: 0px;" class="btn btn-dark" value="Update">
            </div>
            </form>
          </div>

        
      @endsection