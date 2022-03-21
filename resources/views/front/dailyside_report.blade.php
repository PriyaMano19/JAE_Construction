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
              <h4 class="text-center modal-title" style="color:white">Daily Site Details</h4>
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
              <form action="{{route('dsreport.update')}}" method="post" >
            @csrf
            @method('PUT')
            <div class="form-group">
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="name">Project name:</label>
                  <select class="form-control" id="proj_id" name="proj_id" required focus> 
                  <option value="">Select Project</option> 
                    @foreach($project as $proj)
                    <option value="{{$proj->proj_id}}">{{ $proj->proj_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <label for="date">Date:</label>
                  <input class="form-control" type="date" name="date" placeholder="Date" value="{{date('Y-m-d')}}">
                </div>
              </div>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="cate_id">Project Category:</label>
                  <select class="form-control" id="cate_id" name="cate_id" required focus></select>
                </div>
              </div>
            <hr>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="item_id">Received Item:</label>
                  <select class="form-control" id="item_id" name="item_id"></select>
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <label for="item_id">Received Quantity:</label>
                  <input class="form-control" id="qty" type="hidden" name="qty">
                  <input class="form-control" id="recqty" type="text" placeholder="Quantity" value="">
                </div>
              </div>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="unit_price">Unit Price:</label>
                  <input class="form-control" id="unit_price" type="hidden" name="unit_price">
                  <input class="form-control" id="recunit_price" type="text" placeholder="Unit Price" value="">
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                  <label for="total_amount">Total Amount:</label>
                  <input class="form-control" id="total_amount" type="text" name="total_amount" placeholder="Total Amount" readonly>
                </div>
                <div class="m-b-10 col-sm-2">
                <input type="submit" name="add_received" style="border-radius: 0px;" class="btn btn-dark" value="ADD" formaction="{{url('addreceived')}}">
                </div>
              </div>
            <hr>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="transitem">Item Transferred:</label>
                  <select class="form-control" id="transitem" name="transitem"></select></div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                <label for="transquantity">Transferred Quantity:</label>
                  <input class="form-control" type="text" id="transquantity" placeholder="Quantity Transfer" value="">
                </div>
              </div>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                <label for="transunitprice">Unit Price:</label>
                  <input class="form-control" type="text" id="transunitprice" placeholder="Unit Price" value="">
                </div>
                <div class="m-b-10 col-sm-2"></div>
                <div class="m-b-10 col-sm-4">
                <label for="transtotal">Total Amount:</label>
                  <input class="form-control" id="transtotal" type="text" name="transtotal" placeholder="Total Amount" readonly>
                </div>
              </div>
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="name">Transferred Project name:</label>
                  <select class="form-control" id="transfer_proj_id" name="transfer_proj_id" required focus> 
                  <option value="">Select Project</option> 
                    @foreach($project as $proj)
                    <option value="{{$proj->proj_id}}">{{ $proj->proj_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="m-b-10 col-sm-6"></div>
                <div class="m-b-10 col-sm-2">
                <input type="submit" name="add_trans" style="border-radius: 0px;" class="btn btn-dark" value="ADD" formaction="{{url('addtrans')}}">
                </div>
              </div>
            </div>

            <hr>
            <div class="form-group">
              <div class="row">
                <div class="m-b-10 col-sm-4">
                  <label for="emp_name">Employee Name:</label>
                  <select class="form-control" id="emp_name" name="emp_name">  
                    <option value=""></option>     
                    @foreach($employee as $emp)
                    <option value="{{$emp->emp_id}}">{{ $emp->emp_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="m-b-10 col-sm-4">
                  <label for="emp_skill">Employee Skills:</label>
                  <input class="form-control" type="text" name="emp_skill" placeholder="Employee Skills" value="">
                </div>
                <div class="m-b-10 col-sm-2">
                  <label for="emp_amount">Amount:</label>
                  <input class="form-control" type="text" name="emp_amount" placeholder="Amount" value="">
                </div>
                <div class="m-b-10 col-sm-2">
                  <br>
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
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $("#proj_id").change(function(){
      var proj_id = $(this).val();
      $.ajax({
        type:'get',
        url:'{!!url('projcat')!!}',
        data:{'proj_id':proj_id},
        success:function(response){
          $('#cate_id').find('option').remove().end();
          $('#cate_id').append('<option>Select Category</option>');
          $.each(response.category, function(key, item){
            $('#cate_id').append('<option value='+item.cate_id+'>'+item.cate_id+'</option>');
          });
        }
      });
    });

    $("#cate_id").change(function(){
      var cate_id = $(this).val();
      fetchcat(cate_id);
      fetchcat_trans(cate_id);
    });

    function fetchcat(cate_id)
    {
      $.ajax({
        type:'get',
        url:'{!!url('catitem')!!}',
        data:{'cate_id':cate_id},
        success:function(response){
          $('#item_id').find('option').remove().end();
          $.each(response.items, function(key, item){
            $('#item_id').append('<option value='+item.id+'>'+item.item_name+'</option>');
          });
        }
      });
    }

    function fetchcat_trans(cate_id)
    {
      $.ajax({
        type:'get',
        url:'{!!url('trans_catitem')!!}',
        data:{'cate_id':cate_id},
        success:function(response){
          $('#transitem').find('option').remove().end();
          $.each(response.items, function(key, item){
            $('#transitem').append('<option value='+item.item_id+'>'+item.item_id+'</option>');
          });
        }
      });
    }

    $("#transunitprice").change(function(){
      var unit_price = $(this).val();
      var qty = $("#transquantity").val();
      $("#transtotal").val(qty*unit_price*-1);
      $("#unit_price").val(unit_price);
    });

    $("#transquantity").change(function(){
      var qty = $(this).val();
      var unit_price = $("#transunitprice").val();
      $("#transtotal").val(qty*unit_price*-1);
      $("#qty").val(qty*-1);
    });

    $("#recqty").change(function(){
      var qty = $(this).val();
      var unit_price = $("#recunit_price").val();
      $("#total_amount").val(qty*unit_price);
      $("#qty").val(qty);
    });

    $("#recunit_price").change(function(){
      var unit_price = $(this).val();
      var qty = $("#recqty").val();
      $("#total_amount").val(qty*unit_price);
      $("#unit_price").val(unit_price);
    });

    
  });
</script>