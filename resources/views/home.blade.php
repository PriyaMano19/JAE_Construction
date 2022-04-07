@extends('layouts.master')
@section('content')
    
<style type="text/css">
.cards-list {
  z-index: 0;
  width: 100%;
  display: flex;
  flex-wrap: wrap;
}

.card {
  margin: 10px auto;
  width: 75%;
  padding: 15px 5px ;
  border-radius: 20px;
    box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.25), -2px -2px 5px 2px rgba(0,0,0,0.22);
  cursor: pointer;
  transition: 0.4s;
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 1px 1px 1px 1px rgba(0,0,0,0.25), -2px -2px 5px 2px rgba(0,0,0,0.22);
}

.title-white {
  color: white;
}

.title-black {
  color: black;
  font-size:14px;
}

p { margin: 2px; }
hr { margin:4px; }
</style>

<div class="cards-list">
  <?php
    use App\Http\Controllers\EmployeeController;
  ?>
  @foreach($projStatus as $proj)
  <div class="card">
  <div class="container">
    <div class="row">
    
      <div class="col-sm-3">
      <p style="font-size:12px;">Project Name</p> 
      <p class="title-black"><b>{{$proj->proj_name}}</b></p>
      </div>
      <div class="col-sm-3">
      <p class="text-right" style="font-size:12px;">Allowcated Amount</p> 
      <p class="title-black text-right"><b>{{$proj->total}}.00</b></p>
      </div>
      <div class="col-sm-3">
      <?php $utilized = EmployeeController::utilized_amount($proj->proj_id); ?>
      <p class="text-right" style="font-size:12px;">Utilized Amount</p> 
      <p class="title-black text-right"><b>{{$utilized}}.00</b></p>
      </div>
      <div class="col-sm-3">
      <p class="text-right" style="font-size:12px;">Remaining Amount</p> 
      <p class="title-black text-right"><b>{{$proj->total - $utilized}}.00</b></p>
      </div>
    </div>
    
  </div>
</div>
  @endforeach
</div>
@endsection