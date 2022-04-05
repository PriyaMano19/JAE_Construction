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
  height: 100px;
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
  @foreach($projStatus as $proj)
  <div class="card">
  <div class="container">
    <br>
    <div class="row">
      <div class="col-sm-3">
      <p style="font-size:12px;">Project Name</p> 
      <p class="title-black"><b>{{$proj->proj_name}}</b></p>
      </div>
      <div class="col-sm-3">
      <p style="font-size:12px;">Allowcated Amount</p> 
      <p class="title-black"><b>{{$proj->total}}.00</b></p>
      </div>
      <div class="col-sm-3">
      <p style="font-size:12px;">Utilized Amount</p> 
      <p class="title-black"><b></b></p>
      </div>
      <div class="col-sm-3">
      <p style="font-size:12px;">Remaining Amount</p> 
      <p class="title-black"><b></b></p>
      </div>
    </div>
    
  </div>
</div>
  @endforeach
</div>
@endsection