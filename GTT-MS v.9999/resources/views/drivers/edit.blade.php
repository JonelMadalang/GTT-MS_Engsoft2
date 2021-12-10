@extends('masterlayout.master')
@section('title') Edit Driver @endsection
@section('content')


<div class="container-fluid ">
<form action="{{route('drivers.update',$driver->id)}}" method="POST" >
    @csrf 
    @method('PUT')

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="fullname">Fullname:</label>
  <input type="text" value = "{{$driver->fullname}}" class="form-control" name="fullname">
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="plate_number">Plate Number:</label>
  <input type="text" value = "{{$driver->plate_number}}" class="form-control" name="plate_number">
  </div>

  <div class="form-group col-md-6">
  <label for="mobile_number">Mobile Number:</label>
  <input type="number" value = "{{$driver->mobile_number}}" class="form-control" name="mobile_number">
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="taxi_model">Taxi Model:</label>
  <input type="text" value = "{{$driver->taxi_model}}" class="form-control" name="taxi_model">
  </div>

  <button type="submit" class="btn btn-primary">Update Driver</button>

</form>

@endsection