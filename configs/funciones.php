<?php

//Conexion al servidor
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'allmovie_login');
define('DB_PASSWORD', 'allmovie_login_12');
define('DB_NAME', 'allmovie_login');

$mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(mysqli_connect_errno())
{
printf("Falló en la conexión de base de datos: %s\n", mysqli_connect_error());
exit(); 
}

function clear($var)
{
    htmlspecialchars($var); 

    return $var;
}

function check_admin()
{
    if(!isset($_SESSION['id']))
    {
        redir("./");
    }
}

function check_user($url)
{
    if(!isset($_SESSION['id_cliente']))
    {
        alert("Inicia Sesión para continuar");
        redir("?p=login&return=$url");
    }
}

function nombre_cliente($id_cliente)
{
    $mysqli = connect();

    $q = $mysqli -> query("SELECT * FROM clientes WHERE id = '$id_cliente'"); 
    $r = mysqli_fetch_array($q);
    return $r['name']; 
}

function nombre_admin($id_admin)
{
    $mysqli = connect();

    $q = $mysqli -> query("SELECT * FROM admins WHERE id = '$id_admin'"); 
    $r = mysqli_fetch_array($q);
    return $r['name']; 
}

function connect()
{

    $mysqli = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    return $mysqli;
}


function redir($var)
{
    ?>
    <script>
        window.location = "<?=$var?>"; 
    </script>
    <?php
    die(); 
}

function alert($var)
{
    ?>
    <script type = "text/javascript">
        alert("<?=$var?>");
    </script>
    <?php
}
?>