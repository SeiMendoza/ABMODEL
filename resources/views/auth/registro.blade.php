<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
    
<head>
	<title>Registro Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
	<link rel="stylesheet" href="/assets/css/login.css"> 
</head>

<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="/img/Villacrisol.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
                    <form action="/registro" method="POST">
                        @csrf
                        @include('auth.mensajes')
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="{{ old('username') }}" 
							       placeholder="Nombre de usuario" style="width:255px">
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							</div>
							<input type="email" name="email" class="form-control input_pass" value="{{ old('email') }}" 
						           placeholder="Correo" style="width:255px">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-lock"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_user" value="{{ old('password') }}" 
							       placeholder="Contraseña" style="width:255px">
						</div>
                        <div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password_confirmation" class="form-control input_pass" value="{{ old('password_confirmation') }}" 
							    placeholder="Confirmar contraseña" style="width:255px">
						</div>

						<div class="form-group">
						</div>
							<div class="d-flex justify-content-center" >
				 	          <button type="submit"  class="btn login_btn">Registrarse</button>
				           </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						¿Si ya tiene una cuenta inicie sesión? 
					</div>
					<div class="d-flex justify-content-center links" >
						<a href="/login" ><strong >Iniciar Sesión</strong></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
