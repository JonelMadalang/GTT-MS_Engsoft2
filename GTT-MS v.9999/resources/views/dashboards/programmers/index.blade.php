@extends('layouts.dev_app')
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
    <table class="table table-dark">
        <thead>
        <tr>
        <!-- <th scope="col">ID:</th> -->
        <th scope="col">Name:</th>
        <th scope="col">Email:</th>
        <th scope="col">Mobile Number:</th>
        <th scope="col">Address:</th>
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
        <td><button type="button" id="makeAdmin" data_id="{{$user->id}}" class="btn btn-warning">Make admin</button></td>
        </tr>
        @endforeach

        </tbody>
    </table>

</div>

@include('dashboards/programmers/dev_script')

@endsection