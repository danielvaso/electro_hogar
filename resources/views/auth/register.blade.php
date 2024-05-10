<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
    
<head>
	<title>Registro</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('asset/register.css')}}">

</head>
<!--Coded with love by Mutiullah Samim-->
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="data:image/png;base64,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" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="POST" action="{{ route('register') }}">
                        @csrf
                    
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end"><i class="fas fa-user"></i></label>
                    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Ingrese su nombre" required autocomplete="name" autofocus>
                    
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end"><i class="fas fa-user"></i></label>
                    
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Ingrese su email" required autocomplete="email">
                    
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end"><i class="fas fa-key"></i></label>
                    
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"placeholder="Ingrese la contraseña" required autocomplete="new-password">
                    
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end"><i class="fas fa-key"></i></label>
                    
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirma contraseña">
                            </div>
                        </div>
                    
                        <div class="d-flex justify-content-center mt-3 login_container">
                            <button type="sumit" name="button" class="btn login_btn">Registrar</button>
                     </div>
                    
                    
                    </form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Ya tienes cuenta? <a href="{{ route('login')}}" class="ml-2">inicia sesion</a>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</body>
</html>