<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register page</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="my-login-page">
	<section class="h-100">
	<div class="d-grid gap-2 d-md-flex justify-content-md-end">
	<a href="{{route('drivers.index')}}" class="btn btn-dark">X</a>
	</div>
	
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
				
					<div class="cardx fat mt-12">
						<div class="card-body">
							<h4 class="card-title">Register</h4>
							<form method="POST" class="my-login-validation" autocomplete="off" action="{{ route('register') }}">

								@if ( Session::get('success'))
									 <div class="alert alert-success">
										 {{ Session::get('success') }}
									 </div>
								@endif
								@if ( Session::get('error'))
									 <div class="alert alert-danger">
										 {{ Session::get('error') }}
									 </div>
								@endif
                                @csrf
								<div class="form-group">
									<label for="name">Name</label>
									<input id="name" type="text" class="form-control" name="name"  autofocus placeholder="Enter Full Name" value="{{ old('name') }}">
									<span class="text-danger">@error('name'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<label for="email">E-Mail Address</label>
									<input id="email" type="email" class="form-control" name="email"  placeholder="Enter email" value="{{ old('email') }}">
									<span class="text-danger">@error('email'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<label for="mobile_number">Mobile Number</label>
									<input id="mobile_number" type="number" class="form-control" name="mobile_number"  placeholder="Ex. 09123456789" value="{{ old('mobile_number') }}">
									<span class="text-danger">@error('mobile_number'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<label for="address">Address</label>
									<input id="address" type="text" class="form-control" name="address"  placeholder="house #, Street, Barangay, City" value="{{ old('address') }}">
									<span class="text-danger">@error('address'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<label for="birthday">Birthday</label>
									<input id="birthday" type="date" class="form-control" name="birthday"  value="{{ old('birthday') }}">
									<span class="text-danger">@error('birthday'){{ $message }}@enderror</span>
								</div>

								<div class="form-group">
									<label for="password">Password</label>
									<input id="password" type="password" class="form-control" name="password"  data-eye placeholder="Enter password">
									<span class="text-danger">@error('password'){{ $message }}@enderror</span>
								</div>
                                <div class="form-group">
									<label for="password-confirm">Confirm Password</label>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required data-eye placeholder="Enter confirm password">
									<span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                                    
								</div>
								<div class="form-group m-0">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" name="checkbox">
										<label class="form-check-label" for="flexCheckDefault">
										  Accept Terms and Conditons
										</label>
									  </div>
								</div>
								<div class="form-group m-0">
									<button type="submit" class="btn btn-dark btn-block">
										Register
									</button>
								</div>
								
								<div class="mt-4 text-center">
									Already have an account? <a href="{{route('login')}}">Login</a>
								</div>
							</form>
						</div>
					</div>
			
				</div>
			</div>
		</div>
	</section>


<script src="jquery-3.6.0.min.js"></script>
	<script src="bootstrap/js/popper.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="js/my-login.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>
</html>