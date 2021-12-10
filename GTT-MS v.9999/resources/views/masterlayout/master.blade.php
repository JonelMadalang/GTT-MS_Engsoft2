<!DOCTYPE html>
<html lang="eng">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" >
  <meta http-quiv="X-UA-Compitable" content="ie=edge">
  <meta name="csrf-token" content="{{csrf_token()}}"> <!--You need this to run your CRUD Operations-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
  <title>@yield('title','default')</title>
  </head>

<body>
    <!--NAV BAR-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">GMT-MS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
  <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">

  <li class="nav-item">
  <a class="nav-link" href="{{route('drivers.index')}}">Driver</a>
  </li>

  <li class="nav-item">
  <a class="nav-link" href="">Details</a>
  </li>

  <li class="nav-item">
  <a class="nav-link" href="{{route('transactions.index')}}">Transaction</a>
  </li>

</ul>
</div>
</nav>
<!--END-->


<!--Container-->
  <div class="container">
  @yield('content')
</div>

<!--END-->
</body>
</html>