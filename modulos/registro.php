<?php
if(isset($_SESSION['id_cliente'])){
	redir("./");
}

if(isset($ingresar))
{
    redir("?p=login");
}
//linpiar los campos 
if(isset($enviar)){
	$username = clear($username);
	$password = clear($password);
	$cpassword = clear($cpassword);
	$nombre = clear($nombre);

    $q = $mysqli->query("SELECT * FROM clientes WHERE username = '$username'");
    //revisar que los campos tengan informacion
if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])) || empty(trim($_POST['cpassword'])) || empty(trim($_POST['nombre'])))
{
    alert("Rellena todos los campos");
    redir("?p=registro");
}
else
{
//revisar que el usuario ya exite
	if(mysqli_num_rows($q)>0){
        alert("El usuario ya está en uso");
        redir("?p=registro");
		die();
	}
//revisar que las contrasñeas sean iguales
	if($password != $cpassword){
        alert("Las contraseñas no coinciden");
        redir("?p=registro");
		die();
	}
}
//registrar usuario nuevo

	$mysqli->query("INSERT INTO clientes (username,password,name) VALUES ('$username','$password','$nombre')");
//iniciar sesion con el usuario recien ingresado

	$q2 = $mysqli->query("SELECT * FROM clientes WHERE username = '$username'");

	$r = mysqli_fetch_array($q2);

	$_SESSION['id_cliente'] = $r['id'];

    alert("Te has registrado satisfactoriamente");
    redir("./");
}
	?>


	<center>
		<form method="post" action="">
			<div class="centrar-login">
				<label><h2><i class="fa fa-key"></i> Registrate</h2></label>
				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Usuario" name="username"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Confirmar Contraseña" name="cpassword"/>
				</div>


				<div class="form-group">
					<input type="text" autocomplete="off" class="form-control" placeholder="Nombre" name="nombre"/>
				</div>

				<div class="form-group">
					<button class="btn btn-success" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Registrate</button>
                    <button class = "btn btn-success" name = "ingresar" type = "submit"><i class = "fa fa-sign-in"></i> Inicio de Sesión </button>
				</div>
			</div>
		</form>
	</center>