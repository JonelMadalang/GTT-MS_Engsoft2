@extends('layouts.admin_app')

@section('content')


<br>
<form action="{{route('generateReport')}}" method="POST">
    @csrf
<div class="row">
  <div class="col">
  <label class="form-label">Start date</label>
    <input type="date" class="form-control" name="start_date" >
  </div>
  <div class="col">
  <label class="form-label">End date</label>
    <input type="date" class="form-control" name="end_date">
  </div>
  <div class="col">
  <label class="form-label">Driver</label>
    <select class="form-select" aria-label="Default select example" name="driver">
            <option></option>
            @foreach($drivers as $driver)
            <option value="{{$driver->id}}">{{$driver->name}}</option>
            @endforeach
    </select>
  </div>
  <div class="col">
  <label class="form-label">Boundary</label>
    <select class="form-select" aria-label="Default select example" name="boundary">
            <option></option>
            @foreach($boundary as $bound)
            <option value="{{$bound->boundary}}">{{$bound->boundary}}</option>
            @endforeach
    </select>
  </div>
  <div class="col">
  <label class="form-label">Expenses</label>
    <select class="form-select" aria-label="Default select example" name="expenses">
            <option></option>
            @foreach($expenses as $expense)
            <option value="{{$expense->expenses}}">{{$expense->expenses}}</option>
            @endforeach
    </select>
  </div>
  <div class="col">
  <label class="form-label">Bonds</label>
    <select class="form-select" aria-label="Default select example" name="bonds">
            <option></option>
            @foreach($bonds as $bond)
            <option value="{{$bond->bond}}">{{$bond->bond}}</option>
            @endforeach
    </select>
  </div>
</div>
<br>
<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <!-- <button type="submit" class="btn btn-primary">search</button> -->
    <button type="submit" name="action" value="search" class="btn btn-primary">search</button>
    <!-- <button type="submit" name="action" value="export" class="btn btn-primary">export to pdf</button> -->
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
