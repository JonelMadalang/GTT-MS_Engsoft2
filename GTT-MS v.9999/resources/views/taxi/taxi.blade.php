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


  

<div class=container-fluid>
  <br>
  <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <button type="button" class="btn btn-success" id="addTaxi">Add Taxi</button>
    </div><br>
  <table id="taxi_tbl" class="table table-dark table-hover">
  <thead>
    <tr>
      <th scope="col">Date added</th>
      <th scope="col">Plate #</th>
      <th scope="col">Model</th>
      <th scope="col">Boundary</th>

      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach($taxis as $taxi)
    <tr>
    <td>{{ \Carbon\Carbon::parse($taxi->created_at)->format('d/m/Y')}}</td>
      <td>{{$taxi->plate_number}}</td>
      <td>{{$taxi->model}}</td>
      <td>{{$taxi->boundary}}</td>

      <td><button id="editTaxiBtn" data_id="{{$taxi->id}}" type="button" class="btn btn-warning">Edit</button>
      <button id="deleteTaxiBtn" data_id="{{$taxi->id}}" type="button" class="btn btn-danger">Delete</button></td>
    </tr>
    @endforeach
  </tbody>
  </table>
 
  <!-- Modal -->
<div class="modal fade" id="addTaxiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalTitle">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addTaxiForm">
          <input type="hidden" class="form-control" name="id" id="id">
          <input type="hidden" class="form-control" name="status" id="status">
            <div>
              <label class="form-label">Taxi Model</label>
              <input type="text" class="form-control" name="model" id="model" required>
            </div><br>
            <div>
              <label class="form-label">Taxi Plate Number</label>
              <input type="text" class="form-control" name="plate_number" id="plate_number" required>
            </div><br>
            <div>
              <label class="form-label">Fixed Boundary</label>
              <input type="number" class="form-control" name="boundary" id="boundary" required>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="SaveButton" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

</div>

@include('taxi/taxi_script')
@endsection