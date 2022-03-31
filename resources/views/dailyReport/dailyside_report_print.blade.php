@extends('layouts.master')
@section('content')

<!-- Modal -->
<style type="text/css">
.m-b-5 {
    margin-bottom: 5px;
}

.m-b-10 {
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
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
}
</style>
<!-- Modal content-->
<div class="modal-content">
    <br>
    <div class="row">
        <div class="col-md-4 text-center font-weight-bolder">Date : {{$date}}</div>
        <div class="col-md-4 text-center font-weight-bolder">Category : {{$category_name}}</div>
        <div class="col-md-4 text-center font-weight-bolder">Site : {{$project_name}}</div>
    </div>

    <div class="modal-body">
        <table class="table align-items-center mb-0">
            <thead>
            <tr>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">No</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Description</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Qty</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Unit</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Rate</th>
                <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Amount</th>
                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Remark</th>
            </tr>
            </thead>
            <tbody>
            @php
            $i = 1;
            $rec_tot = 0;
            $trans_tot = 0;
            $emp_tot = 0;
            @endphp
                @foreach($rec_items as $rec)
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$i}}</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$rec->item_name}}</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$rec->qty}}</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$rec->unit_price}}</th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$rec->qty * $rec->unit_price}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                </tr>
                @php
                $i = $i + 1;
                $rec_tot = $rec_tot + $rec->qty * $rec->unit_price;
                @endphp
                @endforeach
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                    <th colspan="4" class="text-right text-secondary text-xs font-weight-bolder opacity-15">Sub Total for Received Items : </th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$rec_tot}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                </tr>
                @php
                $i = 1;
                @endphp
                @foreach($trans_items as $trans)
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$i}}</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$trans->item_name}}</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$trans->qty * -1}}</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$trans->unit_price}}</th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$trans->qty * $trans->unit_price * -1}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$trans->proj_name}}</th>
                </tr>
                @php
                $i = $i + 1;
                $trans_tot = $trans_tot + $trans->qty * $trans->unit_price * -1;
                @endphp
                @endforeach
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                    <th colspan="4" class="text-right text-secondary text-xs font-weight-bolder opacity-15">Sub Total for Transferred Items : </th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$trans_tot}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                </tr>
                <tr>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">No</th>
                    <th colspan="2" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Employee Name</th>
                    <th colspan="2" class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Skills</th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Amount</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-15">Remark</th>
                </tr>
                @php
                $i = 1;
                @endphp
                @foreach($employee as $emp)
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$i}}</th>
                    <th colspan="2" class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$emp->emp_name}}</th>
                    <th colspan="2" class="text-center text-secondary text-xs font-weight-bolder opacity-15">{{$emp->Skills}}</th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$emp->amount}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                </tr>
                @php
                $i = $i + 1;
                $emp_tot = $emp_tot + $emp->amount;
                @endphp
                @endforeach
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                    <th colspan="4" class="text-right text-secondary text-xs font-weight-bolder opacity-15">Sub Total for Employees' Salary : </th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$emp_tot}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                </tr>
                @php
                $grand_total = $rec_tot - $trans_tot + $emp_tot;
                @endphp
                <tr>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                    <th colspan="4" class="text-right text-secondary text-xs font-weight-bolder opacity-15">Grand Total : </th>
                    <th class="text-right text-uppercase text-secondary text-xs font-weight-bolder opacity-15">{{$grand_total}}.00</th>
                    <th class="text-center text-secondary text-xs font-weight-bolder opacity-15"></th>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
    window.print();
});
</script>