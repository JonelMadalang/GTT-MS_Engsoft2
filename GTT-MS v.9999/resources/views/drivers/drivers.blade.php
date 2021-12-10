@extends('layouts.admin_app')
    @section('title') Driver Page @endsection
    @section('content')

    <!--Added-->
    @if($message = Session::get('Success'))
    <div class="alert alert-dark" role="alert">
  {{$message}}
    </div>
    @endif

    <!--Updated-->
    @if($message = Session::get('Update'))
    <div class="alert alert-dark" role="alert">
  {{$message}}
    </div>
    @endif

    <!--Delete-->
    @if($message = Session::get('Delete'))
    <div class="alert alert-dark" role="alert">
  {{$message}}
    </div>
    @endif


  


    <br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">

    </div><br>

  <table id="drivers_tbl" class="table table-dark">
    <thead>
    <tr>
      <!-- <th scope="col">ID:</th> -->
      <th scope="col">Name:</th>
      <th scope="col">Email:</th>
      <th scope="col">Mobile Number:</th>
      <th scope="col">Address:</th>
      <th scope="col">Birthday:</th>
      <th scope="col">Taxi:</th>
      <th scope="col">Action:</th>
    </tr>
    </thead>

    <tbody>
    @foreach ($users as $user)
    <tr>
      <!-- <td>{{$user->id}}</td> -->
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->mobile_number}}</td>
      <td>{{$user->address}}</td>
      <td>{{$user->birthday}}</td>
      <td>{{$user->plate_number}}</td>
      <td><button id ="unassignBtn" data_id="{{$user->id}}" class="btn btn-outline-danger" type="button">Unassign Taxi</button></td>
    </tr>
    @endforeach

    </tbody>
  </table>

<!-- Modal -->
<!-- <div class="modal fade" id="assignTaxiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="assignTaxiForm">
      <input type="hidden" class="form-control" name="id" id="id">
      <input type="hidden" class="form-control" name="status" id="status" value="1">
      <input type="text" class="form-control" id="name" readonly><br>
      <h5>Taxi:</h5>
      <select class="form-select" aria-label="Default select example" name="taxi_id" id="taxi_id">
        @foreach($taxis as $taxi)
        <option value="{{$taxi->id}}">Model: {{$taxi->model}}| Plate Number: {{$taxi->plate_number}}</option>

        @endforeach
      </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="assignBtn" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div> -->


    



@include('drivers/drivers_script');
@endsection