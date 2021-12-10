
@extends('layouts.user_app')


@section('content')

<!--Added-->
@if($message = Session::get('Success'))
<div class="alert alert-success" role="alert">

{{$message}}
</div>
@elseif($message = Session::get('Updated'))
<div class="alert alert-success" role="alert">
{{$message}}
</div>
@endif

<br>
@foreach($bonds as $bond)
<h4>Your Total Bond: {{$bond->bond}}</h4>
@endforeach
<div class=container-fluid>
  <br>


  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
  <a href="{{route('userTransactions.create')}}" class="btn btn-primary">Add Transaction</a>
  </div><br>

  <table id="user_transac_tbl" data-order='[[ 1, "desc" ]]' class="table table-hover table-bordered border-warning">
  <thead>
    <tr class="table-info">
      <th scope="col">Date:</th>
      <th scope="col">Boundary:</th>
      <th scope="col">Bond:</th>
      <th scope="col">Expenses:</th>
      <th scope="col">Expenses Details:</th>
      <th scope="col">Status:</th>
      <th scope="col">Remarks:</th>
      <th scope="col">Verified by:</th>
      <th scope="col">Action:</th>
    </tr>
  </thead>

  <tbody>
    @foreach($transactions as $transaction)
    <tr>
      <td>{{$transaction->date}}</td>
      <td>{{$transaction->boundary}}</td>
      <td>{{$transaction->bond}}</td>
      <td>{{$transaction->expenses}}</td>
      <td>{{$transaction->expenses_details}}</td>
      <td>
        @if($transaction->status == "For Verification")
        <span class="badge bg-danger">{{ $transaction->status}}</span>
        @elseif($transaction->status == "Verified")
        <span class="badge bg-success">{{ $transaction->status}}</span>
        @elseif($transaction->status == "For Updating")
        <span class="badge bg-warning">{{ $transaction->status}}</span>
        @elseif($transaction->status == "Resubmitted")
        <span class="badge bg-info">{{ $transaction->status}}</span>
        @endif
      </td>
      <td>{{$transaction->remarks}}</td>
      <td>{{$transaction->verified_by}}</td>
      <td>
        @if($transaction->status != "Verified")
        <a role="button" id="editData" href="{{route('userTransactions.edit',$transaction->id)}}" class="btn btn-primary">Edit</a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
  </table>


  @include('transactions/transaction_script')

    
</div>
@endsection
