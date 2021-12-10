@extends('layouts.user_app')

@section('content')
<form action="{{route('userTransactions.update',$userTransaction->id)}}" method="POST" >
    @csrf
    @method('PUT')
 
  <input type="hidden" class="form-control" name="user_id" value="{{Auth::user()->id}}">
 
  <br>
  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="fullname">Date:</label>
  <input type="date" class="form-control" name="date" value="{{$userTransaction->date}}" required>
  </div>


  <div class="form-group col-md-6">
  <label for="mobile_number">Boundary:</label>
  <input type="number" class="form-control" value="{{$userTransaction->boundary}}" name="boundary" required>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="taxi_model">Bond:</label>
  <input type="number" class="form-control"  value="{{$userTransaction->bond}}" name="bond" value="0">
  </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label for="taxi_model">Expenses:</label>
  <input type="number" class="form-control"  value="{{$userTransaction->expenses}}" name="expenses" value="0">
  </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label >Expenses Details(if any):</label>
  <textarea name="expenses_details" id="expenses_details" placeholder="Enter the expenses details and the receipt number if there is" class="form-control" rows="2"></textarea>
  </div>
  </div>


  <input type="hidden" class="form-control" name="status" value="Resubmitted">
 
<br>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>
@endsection