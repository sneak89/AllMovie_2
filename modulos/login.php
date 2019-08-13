<?php
//si se encuentra una sesion activa
    if(isset($_SESSION['id_cliente']))
    {
        redir("./");
    }

    if(isset($registrar))
    {
        redir("?p=registro");
    }

    if(isset($enviar))
    {
        $username = clear($username);
        $password = clear($password);
    //revisar si los datos son correctos en la tabla de clientes y si no enviar un error
        $q = $mysqli->query("SELECT * FROM clientes WHERE username = '$username' AND password = '$password'");
    
        if(mysqli_num_rows($q)>0){
            $r = mysqli_fetch_array($q);
            $_SESSION['id_cliente'] = $r['id'];
            if(isset($return))
            {
                redir("?p=".$return);
            }
            else
            {                
                redir("./");
            }
        }
        else
        {
            alert("Datos invalidos");
            redir("?p=login");
        }
    } 
        ?>
    <center>
        <form action="" method = "POST">
            <div class="centrar-login">
                <label><h2><i class = "fa fa-key"></i> Iniciar Sesion </h2></label>
                <div class="form-group">
                    <input type = "text" class = "form-control" placeholder = "Usuario" name = "username"/>
                </div>
    
                <div class="form-group">
                    <input type = "password" class = "form-control" placeholder = "Contraseña" name = "password"/>
                </div>
    
                <div class="form-group">
                    <button class = "btn btn-success" name = "enviar" type = "submit"><i class = "fa fa-sign-in"></i> Ingresar </button>
                    <button class = "btn btn-success" name = "registrar" type = "submit"><i class = "fa fa-sign-in"></i> Registro </button>
                </div>
            </div>
        </form>
    </center>
        <?php
    
    
    ?>