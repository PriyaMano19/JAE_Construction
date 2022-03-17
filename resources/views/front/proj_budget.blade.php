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


<button class="btn-plus" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2xl"></i></button>

      <!-- Modal -->
      <div style="margin-top: 60px;" id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="color:white;background-color: #B2022F;">
            <div style="flex-direction:column;">
              <h4 class="text-center modal-title" style="color:white">ADD Project</h4>
             
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
              <form action="{{route('budget.store')}}" method="post">
            @csrf
                <div class="m-b-10">
                  <input class="form-control" type="text" name="proj_id" >
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="cate_id"  >
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="budg_version" placeholder="budget version">
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="Amount" placeholder="Amount">
                </div>

               

                  
              
            </div>
            <div class="modal-footer">
              <button style="border-radius: 0px;" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              <input type="submit" name="submit" style="border-radius: 0px;" class="btn btn-dark" value="Save">
            </div>
            </form>
          </div>

        </div>
      </div>





      



     


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-danger  border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Project Budget details</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                @if($message = Session::get('success'))
                <div class="alert alert-success">
                  <p>{{$message}}</p>
                </div>
                @endif
                <table class="table align-items-center mb-0">
                  <thead>
                 
                    <tr>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Budget ID</th>
                      <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-15 ps-2">Project ID</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Category ID </th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Budget version</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Amount</th>
                   
                      <th class="text-secondary opacity-15">Actions</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  @foreach($budget as $budg)
                    <tr>
                      <td class="align-middle text-center text-sm">
                      {{$budg->proj_id}}
                      </td>
                      <td class="align-middle text-center text-sm">
                      {{$budg->proj_name}}
                      </td>
                      <td class="align-middle text-center text-sm">
                      {{$budg->start_date}}
                      </td>
                      <td class="align-middle text-center">
                      {{$budg->total_cost}}
                      </td>
                      <td class="align-middle">
                      
                      {{$budg->proj_owner }}
                      </td>
                     
                      <td class="align-middle">
                        <a href="{{ route('budget.edit',$budg->budg_id) }}" class="btn btn-success"  ><i class="fa fa-pencil"></i></a>
                          <a href="" class="btn btn-warning "><i class="fa fa-eye "></i></a>
                          
                      </td>
                    </tr>
                   @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection