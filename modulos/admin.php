<?php

if(isset($enviar))
{
    $username = clear($username);
	$password = clear($password);

	$q = $mysqli->query("SELECT * FROM admins WHERE username = '$username' AND password = '$password'");

	if(mysqli_num_rows($q)>0){
		$r = mysqli_fetch_array($q);
		$_SESSION['id'] = $r['id'];
		redir("?p=admin");
	}else{
		alert("Datos invalidos");
		redir("?p=admin");
	}
}

if(isset($_SESSION['id']))
{
    ?>
    <a href = "?p=agregar_peliculas">
        <button class = "btn btn-primary"><i class = "fa fa-plus-circle"></i> Agregar Peliculas</button>
    </a>
    <?php
}
else
{
    ?>
<center>
    <form action="" method = "POST">
        <div class="centrar-login">
            <label><h2><i class = "fa fa-key"></i> Iniciar Sesion Administrador</h2></label>
            <div class="form-group">
                <input type = "text" class = "form-control" placeholder = "Usuario" name = "username"/>
            </div>

            <div class="form-group">
                <input type = "password" class = "form-control" placeholder = "Contraseña" name = "password"/>
            </div>

            <div class="form-group">
                <button class = "btn btn-success" name = "enviar" type = "submit"><i class = "fa fa-sign-in"></i> Ingresar </button>
            </div>
        </div>
    </form>
</center>
    <?php
}

?>