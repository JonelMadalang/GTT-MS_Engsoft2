@extends('layouts.user_app')

@section('content')
<div class="h-100 p-5 bg-light border rounded-3">
          <h2>{{Auth::user()->name }}</h2><br>
          
@foreach($users as $user)
@if($user->drivers_license == null)
<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <p class="mb-0">Please add your drivers license in edit profile button</p>
</div>
@endif
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
      <div class="card-header">Birthday</div>
        <div class="card-body">
        <p class="card-text">{{$user->birthday}}</p>
      </div>
    </div>
  </div>
  <div class="col">
  <div class="card border-dark mb-3 h-100" >
      <div class="card-header">Taxi</div>
      <div class="card-body">
        <p class="card-text">Model: {{$user->model}}</p>
        <p class="card-text">Plate Number: {{$user->plate_number}}</p>
      </div>
      <div class="card-header">Drivers License</div>
      <div class="card-body">
        <p class="card-text">License: {{$user->drivers_license}}</p>
      </div>
    </div>
  </div>
</div>
@endforeach

<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <button class="btn btn-primary" id="editProfileBtn" data_id="{{Auth::user()->id}}" type="button">Edit Profile</button>

  <a href="{{route('user.changepass')}}" class="btn btn-primary">Change Password</a>
</div>

</div>
        
  <!-- Modal -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProfileForm">
          <input type="hidden" class="form-control" name="id" id="id">
            <div>
              <label class="form-label">Drivers License</label>
              <input type="text" class="form-control" name="drivers_license" id="drivers_license">
            </div><br>
            <div>
              <label class="form-label">Number</label>
              <input type="text" class="form-control" name="mobile_number" id="mobile_number">
            </div><br>
            <div>
              <label class="form-label">Address</label>
              <input type="text" class="form-control" name="address" id="address">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="UpdateProfileBtn" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>


@include('dashboards/profile_script')      
@endsection
