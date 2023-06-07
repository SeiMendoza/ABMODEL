<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
    
<head>
	<title> Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="/assets/css/login.css"> 
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="reg_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="/img/Villacrisol.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				
				<div class="d-flex justify-content-center form_container">
                    <form action="/login" method="POST">
                        @csrf 
						<h5 style="text-align: center">Iniciar Sesión</h5> 

						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="email" name="email" class="form-control border-radius-sm input_user" value="{{ old('email') }}" 
							       placeholder="Correo" style="width:255px">
								@error('email')
								  <strong class="menerr" style="color:red">{{ $message }}</strong>
								@enderror
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control border-radius-sm input_pass" value="{{ old('password') }}" 
							       placeholder="Contraseña" style="width:255px">
								 @error('password')
								   <strong class="menerr" style="color:red">{{ $message }}</strong>
								@enderror
						</div>
						<div class="form-group">
						</div>
							<div class="d-flex justify-content-center" >
				 	          <button type="submit"  class="btn login_btn">Ingresar</button>
				           </div>
					</form>
				</div>
		
				<div class="mt-1">
					<hr> 
					<div class="d-flex justify-content-center links">
						¿Olvidó Su Contraseña? 
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#" >¡Reestablecer Contraseña!</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
