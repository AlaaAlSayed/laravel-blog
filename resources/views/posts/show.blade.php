@extends('layouts.app')

@section('title')Show @endsection

@section('content')
@inject('Carbon', 'Carbon\Carbon')
<div class="card">
  <div class="card-header">Post Info</div>
  <div class="card-body">

    <div class="d-flex ">
  <h6> Title : &nbsp; </h6>
  
  <span> {{ isset($post->title) ? $post->title : 'Not Found'}}</span>
  </div>
    <h6> Description : </h6> <p>  {{ isset($post->description) ? $post->description : 'Not Found'}}</p>
  </div>
</div>

<br>
<br>

<div class="card">
  <div class="card-header">Post Createor Info </div>
  <div class="card-body ">

  <div class="d-flex ">
  <h6> Name : &nbsp; </h6>
  <span> {{ isset($post->user->name) ? $post->user->name : 'Not Found' }} </span>
  </div>

  <div class="d-flex ">
  <h6> Email :&nbsp;  </h6>
  <span> {{ isset($post->user->email) ? $post->user->email: 'Not Found'  }} </span>
  </div>

  <div class="d-flex ">
  <h6> Created At  : &nbsp; </h6>
  <span> {{ isset($post->created_at)?
          $Carbon::parse($post->created_at)->format('l jS \\of F Y h:i:s A'):'Not Found'  }} </span>
  </div>

  </div>
</div>


@endsection
    