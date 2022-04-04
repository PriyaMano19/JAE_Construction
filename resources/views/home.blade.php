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
  margin: 30px auto;
  width: 200px;
  height: 200px;
  border-radius: 40px;
    box-shadow: 5px 5px 10px 4px rgba(0,0,0,0.25), -5px -5px 10px 4px rgba(0,0,0,0.22);
  cursor: pointer;
  transition: 0.4s;
}

.card:hover {
  transform: scale(0.9, 0.9);
  box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), 
    -5px -5px 30px 15px rgba(0,0,0,0.22);
}

.title-white {
  color: white;
}

.title-black {
  color: black;
  font-size:14px;
}

p { margin:0 }
hr { margin:4px; }
</style>

<div class="cards-list">
  @foreach($projStatus as $proj)
  <div class="card">
  <div class="container">
    <h6 class="text-center"><b>{{$proj->proj_name}}</b></h6> 
    <p style="font-size:12px;">Category</p> 
    <p class="title-black"><b>{{$proj->cat_name}}</b></p>
    <hr>
    <p style="font-size:12px;">Allowcated Amount</p> 
    <p class="title-black"><b>{{$proj->Amount}}.00</b></p>
    <hr>
    <p style="font-size:12px;">Utilized Amount</p> 
    <p class="title-black"><b>...........</b></p>
  </div>
</div>
  @endforeach
</div>
@endsection