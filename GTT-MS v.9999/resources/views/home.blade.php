@extends('layouts.app')

@section('content')


<body class=" text-center text-white bg-dark">
    
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
 

  <main class="px-3">
    <h1 class="text-white">Ganduyan Taxi Tours</h1>
    <img src="{{url('img/gtt.jpg')}}">
    <br><br><br>
    <p class="lead">
      <a href="{{route('login')}}" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Log-in</a>
    </p>
  </main>


</div>


    
  

</body>
@endsection
