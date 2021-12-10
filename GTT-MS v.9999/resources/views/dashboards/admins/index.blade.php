@extends('layouts.admin_app')

@section('content')
<div class="h-100 p-5 bg-light border rounded-3">
          <h2>{{Auth::user()->name }}</h2><br>
          
@foreach($users as $user)
<div class="row row-cols-1 row-cols-md-2 g-4">
  <div class="col">
    <div class="card border-dark mb-3 h-100" >
    <div class="card-header">Contact</div>
      <div class="card-body">
        <p class="card-text">Email: {{$user->email}}</p>
        <p class="card-text">Number: {{$user->mobile_number}}</p>
      </div>
        <div class="card-header">Address</div>
        <div class="card-body">
        <p class="card-text">{{$user->address}}</p>
      </div>
    </div>
  </div>
</div>

<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary" id="editProfileBtn" data_id="{{Auth::user()->id}}" type="button">Edit Profile</button>

  <a href="{{route('admin.changepass')}}" class="btn btn-primary">Change Password</a>
</div>

@endforeach
</div>

@include('dashboards/profile_script')  
@endsection
