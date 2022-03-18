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

<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-danger  border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Daily Site Report</h6>
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
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Catogory</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Item </th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Date</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Quantity</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Unit Price</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Total</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Transferred To</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Received From</th>
                    </tr>
                    
                  </thead>
                  <tbody>
                  @foreach($ds_report as $dsr)
                    <tr>
                      <td class="align-middle text-center text-sm"> {{$dsr->cat_name}} </td>
                      <td class="align-middle text-center text-sm"> {{$dsr->item_name}} </td>
                      <td class="align-middle text-center text-sm"> {{$dsr->date}} </td>
                      <td class="align-middle text-center text-sm"> {{$dsr->qty }} </td>
                      <td class="align-middle text-center text-sm"> {{$dsr->unit_price}} </td>
                      <td class="align-middle text-center text-sm"> {{$dsr->qty * $dsr->unit_price}} </td>
                      <td class="align-middle text-center text-sm">  </td>
                      <td class="align-middle text-center text-sm">  </td>
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