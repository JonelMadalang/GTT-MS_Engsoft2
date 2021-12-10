@extends('layouts.admin_app')

@section('content')


<br>
<form action="{{route('generateReport')}}" method="POST">
    @csrf
<div class="row">
  <div class="col">
  <label class="form-label">Start date</label>
    <input type="date" class="form-control" name="start_date" value="{{$values->start_date}}">
  </div>
  <div class="col">
  <label class="form-label">End date</label>
    <input type="date" class="form-control" name="end_date" value="{{$values->end_date}}">
  </div>
  <div class="col">
  <label class="form-label">Driver</label>
    <select class="form-select" aria-label="Default select example" name="driver">
            <option></option>
            @foreach($drivers as $driver)
            @if($values->driver==$driver->id)
            <option value="{{$driver->id}}" selected>{{$driver->name}}</option>
            @else
            <option value="{{$driver->id}}">{{$driver->name}}</option>
            @endif
            @endforeach
    </select>
  </div>
  <div class="col">
  <label class="form-label">Boundary</label>
    <select class="form-select" aria-label="Default select example" name="boundary" >
            <option></option>
            @foreach($boundary as $bound)
            @if($values->boundary==$bound->boundary)
            <option value="{{$bound->boundary}}" selected>{{$bound->boundary}}</option>
            @else
            <option value="{{$bound->boundary}}">{{$bound->boundary}}</option>
            @endif
            @endforeach
    </select>
  </div>
  <div class="col">
  <label class="form-label">Expenses</label>
    <select class="form-select" aria-label="Default select example" name="expenses" >
            <option></option>
            @foreach($expenses as $expense)
            @if($values->expenses==$expense->expenses)
            <option value="{{$expense->expenses}}" selected>{{$expense->expenses}}</option>
            @else
            <option value="{{$expense->expenses}}">{{$expense->expenses}}</option>
            @endif
            @endforeach
    </select>
  </div>
  <div class="col">
  <label class="form-label">Bonds</label>
    <select class="form-select" aria-label="Default select example" name="bonds">
            <option></option>
            @foreach($bonds as $bond)
            @if($values->bonds==$bond->bond)
            <option value="{{$bond->bond}}" selected>{{$bond->bond}}</option>
            @else
            <option value="{{$bond->bond}}">{{$bond->bond}}</option>
            @endif
            @endforeach
    </select>
  </div>
</div>
<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="submit" name="action" value="search" class="btn btn-primary">search</button>
    <button type="submit" name="action" value="export" class="btn btn-primary">export to pdf</button>
</div>
</form>

@if($tbl != 0)
<br>
<table id="taxi_tbl" class="table table-dark table-hover">
  <thead>
    <tr>
    <th scope="col">Date:</th>
      <th scope="col">Driver:</th>
      <th scope="col">Boundary:</th>
      <th scope="col">Bond:</th>
      <th scope="col">Expenses:</th>

    </tr>
  </thead>
  <tbody>
  @foreach($generate as $report)
    <tr> 
      <td>{{$report->date}}</td>
      <td>{{$report->name}}</td>
      <td>{{$report->boundary}}</td>
      <td>{{$report->bond}}</td>
      <td>{{$report->expenses}}</td>
    </tr>
    @endforeach
  </tbody>
  </table>
@endif
@endsection
