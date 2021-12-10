@extends('layouts.user_app')

@section('content')

<?php $access=""; ?>
@foreach($transactions as $transaction)
<?php $access = $transaction->taxi_id;?>
@endforeach

@if($access)



<form action="{{route('userTransactions.store')}}" method="POST" >
    @csrf
    
 
  <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{Auth::user()->id}}">
  <br>
  <div class="form-row">
  <div class="form-group col-md-6">
  <label >Date:</label>
  <input type="date" class="form-control" name="date" id="date" required>
  <span class="text-danger">@error('date'){{ $message }}@enderror</span>
  </div>


  <div class="form-group col-md-6">
  <label >Boundary:</label>
  @foreach($transactions as $transaction)
  <input type="number" class="form-control" name="boundary"  id="boundary"value="{{$transaction->boundary}}">
  @endforeach
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label >Bond:</label>
  <input type="number" class="form-control"  name="bond"  id="bond" value="0">
  </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
  <label >Expenses:</label>
  <input type="number" class="form-control"  name="expenses" id="expenses"value="0">
  </div>



  <div class="form-row">
  <div class="form-group col-md-6">
  <label >Expenses Details(if any):</label>
  <textarea name="expenses_details" id="expenses_details" placeholder="Enter expenses details and receipt number if any." class="form-control" rows="2"></textarea>
  </div>
  </div>

  <input type="hidden" class="form-control" name="status" id="status" value="For Verification">
 
<br>
  <button type="submit" class="btn btn-primary">Submit</button>

</form>
@else
<div class="alert alert-dismissible alert-warning">
  <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  <h4 class="alert-heading">Oh snap!</h4>
  <p class="mb-0">You're not allowed to create transactions if you have not assigned a taxi.</p>
</div>
@endif


@endsection