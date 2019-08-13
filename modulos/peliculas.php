<?php

check_user("peliculas");

if(isset($agregar) && isset($cant))
{
    $idp = clear($agregar);
    $cant = clear($cant);
    $id_cliente = clear($_SESSION['id_cliente']);

    $v = $mysqli -> query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente' AND id_producto = '$idp' ");

    if(mysqli_num_rows($v)>0)
    {
        $q = $mysqli->query("UPDATE carrito SET cantidad = cantidad + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
    }
    else
    {
        $q = $mysqli->query("INSERT INTO carrito (id_cliente,id_producto,cantidad) VALUES ($id_cliente,$idp,$cant)");
    }

    alert("Se ha agregado su película al carrito");
    redir("?p=peliculas"); 
}

$q = $mysqli -> query("SELECT * FROM peliculas ORDER BY id DESC");
while($r = mysqli_fetch_array($q))
{
    ?>
        <div class="pelicula">
            <div class="name_pelicula"><?=$r['name']?></div>
            <div><img src="peliculas/<?=$r['imagen']?>" alt="" class="img_pelicula"></div>
            <span class="precio"><?=$r['price']?><?=$divisa?></span>
            <button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>')"><i class= "fa fa-shopping-cart"></i></button>
        </div>
    <?php
}
?>

<script type = "text/javascript">
    function agregar_carro(idp)
    {
        var cant = prompt("Agregando al carrito", 1);
        if(cant.length>0)
        {
            window.location = "?p=peliculas"+"&agregar="+idp+"&cant="+cant; 
        }

    }
</script>