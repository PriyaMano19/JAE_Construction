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
  <div class="m-b-10 col-sm-4">
    <input class="form-control" id="date" type="date" name="date" placeholder="Date" value="{{$date}}">
  </div>
  <div class="m-b-10 col-sm-4">
    <select class="form-control" id="proj_id" name="proj_id" required focus> 
    <option value="">Select Project</option> 
      @foreach($project as $proj)
      <option value="{{$proj->proj_id}}">{{ $proj->proj_name }}</option>
      @endforeach
    </select>
  </div>
</div>
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-danger  border-radius-lg pt-4 pb-3">
                <div class="row">
                  <div class="col-sm-6"><h6 class="text-white text-capitalize ps-3">Daily Site Report</h6></div>
                  <div class="col-sm-6 text-right">
                  <a href="{{ route('dsreport.add') }}" class="btn btn-outline-dark"><i class="fa fa-plus"></i></a>&nbsp;&nbsp;</div>
                </div>
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
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Project</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Category</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Item </th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Quantity</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Unit Price</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Total</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Transferred To</th>
                      <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Received From</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();
    selDate = year + "-" + month + "-" + day;
    selProj = 0;
    fetchdata(selDate, selProj);

    $(document).on('change','#date',function(){
      var selDate = $(this).val();
      var selProj = $("#proj_id").val();
      fetchdata(selDate, selProj);
    });

    $("#proj_id").change(function(){
      var selProj = $(this).val();
      var selDate = $("#date").val();
      fetchdata(selDate, selProj);
    });

    function fetchdata(selDate, selProj)
    {
      $.ajax({
        type:'get',
        url:'{!!url('dsrcat')!!}',
        data:{'selDate':selDate, 'selProj':selProj},
        success:function(response){
          //console.log(response);
          $('tbody').find('tr').remove().end();
          $.each(response.ds_report, function(key, item){
            $('tbody').append('<tr>\
                    <td class="text-center text-secondary text-xs">'+ item.proj_name+'</td>\
                    <td class="text-center text-secondary text-xs">'+ item.cat_name+'</td>\
                    <td class="text-center text-secondary text-xs">'+ item.item_name+'</td>\
                    <td class="text-center text-secondary text-xs">'+ item.qty+'</td>\
                    <td class="text-center text-secondary text-xs">'+ item.unit_price+'</td>\
                    <td class="text-center text-secondary text-xs">'+ ( item.unit_price * item.qty )+'</td>\
                    <td></td>\
                    <td></td>\
                  </tr>');
          });
        }
      });
    }
  })
</script>