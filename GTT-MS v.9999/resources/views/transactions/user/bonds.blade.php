
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
@foreach($total as $bond)
<h4>Your Total Bond: {{$bond->bond}}</h4>
@endforeach
<div class=container-fluid>
  <br>




  <table id="user_bonds" data-order='[[ 1, "desc" ]]' class="table table-hover table-bordered border-warning">
  <thead>
    <tr class="table-info">
      <th scope="col">Date:</th>
      <th scope="col">Bond:</th>
    </tr>
  </thead>

  <tbody>
    @foreach($bondTransactions as $bonds)
    <tr>
      <td>{{$bonds->date}}</td>
      <td>{{$bonds->bond}}</td>
     
    </tr>
  @endforeach
  </tbody>
  </table>


  @include('transactions/transaction_script')
    
</div>
@endsection
