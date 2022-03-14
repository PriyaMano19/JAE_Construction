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
      </style>


<button class="btn-plus" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus fa-2xl"></i></button>

      <!-- Modal -->
      <div style="margin-top: 60px;" id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="color:white;background-color: #B2022F;">
            <div style="flex-direction:column;">
              <h4 class="text-center modal-title" style="color:white">ADD Employee</h4>
             
            </div>
            </div>

            <div class="modal-body">
              <div id="error">
                
              </div>
              <form name="book_form" action="layout/insert-booking.php" method="post" onsubmit="return validateForm()">
                
                <div class="m-b-10">
                  <input class="form-control" type="text" name="owner_name" placeholder="Your Name">
                </div>
                <div class="m-b-10">
                  <input class="form-control" type="text" name="vehicle_no" placeholder="Vehicle Number">
                </div>

                <div class="m-b-10">
                  <input class="form-control" type="text" name="contact_no" placeholder="Mobile Number">
                  <span id="mobile_error"></span>
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
              <div class="bg-danger shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Employee details</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Employee_ID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-15 ps-2">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Contact_N0</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">NIC</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Skills</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-15">Amount</th>
                      <th class="text-secondary opacity-7">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                       
                      </td>
                      <td>
                       
                      </td>
                      <td class="align-middle text-center text-sm">
                       
                      </td>
                      <td class="align-middle text-center">
                       
                      </td>
                      <td class="align-middle">
                        
                          
                      </td>
                      <td class="align-middle">
                        
                          
                      </td>
                      <td class="align-middle">
                        <a href="" class="btn btn-success "><i class="fa fa-pencil"></i></a>
                          <a href="" class="btn btn-warning "><i class="fa fa-eye "></i></a>
                          
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection