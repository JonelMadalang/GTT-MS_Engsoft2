@extends('layouts.app')
@section('title') Add Driver @endsection
@section('content')


<div class="container-fluid ">
<form action="{{route('register')}}" method="POST" >
    @csrf
  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="fullname">Full Name:</label>
  <input type="text" class="form-control" name="fullname">
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="plate_number">Plate Number:</label>
  <input type="text" class="form-control" name="plate_number">
  </div>

  <div class="form-group col-md-6">
  <label for="mobile_number">Mobile Number:</label>
  <input type="number" class="form-control" name="mobile_number">
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="taxi_model">Taxi Model:</label>
  <input type="text" class="form-control" name="taxi_model">
  </div>
  </div>

  <button type="submit" class="btn btn-primary">Create Driver</button>

</form>
</body>
</div>

@endsection