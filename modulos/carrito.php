<?php
//si la variable fincompla
if(isset($finCompra))
{
    $monto = clear($monto_total);
    $id_cliente = clear($_SESSION['id_cliente']);
//insertar en la tabla compra los valores del id, la fecha, el monto y cuantas peliculas son
    $q = $mysqli -> query("INSERT INTO compra (id_cliente,fecha,monto,estado) VALUES ('$id_cliente', NOW(), '$monto', 0) ");
//seleccionar de la tabla compla para descontar
    $sc = $mysqli -> query("SELECT * FROM compra WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1 ");
    $rc = mysqli_fetch_array($sc);

    $ultima_compra = $rc['id'];
//se selecciona los productos que se colocaron anteriormente
    $q2 = $mysqli -> query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente'");
    while($r2=mysqli_fetch_array($q2))
    {
        $sp = $mysqli -> query("SELECT * FROM peliculas WHERE id = '".$r2['id_producto']."'");
        $rp = mysqli_fetch_array($sp);

        $monto = $rp['price'];
//inserta la compra de las peliculas
        $mysqli -> query("INSERT INTO peliculas_compra (id_compra, id_producto, cantidad, monto) VALUES ('$ultima_compra', '".$r2['id_producto']."','".$r2['cantidad']."', '$monto')");
    }
//elimina las peliculas del carrito
    $mysqli -> query("DELETE FROM carrito WHERE id_cliente = '$id_cliente'");
    alert("Ha finalizado su compra");
    redir("./");
}
?>


<h1><i class = "fa fa-shopping-cart"></i>Carrito de Compras</h1>

<br><br>
<table class = "table table-striped">
    <tr>
        <th><i class = "fa fa-image"></i></th>
        <th>Película</th>
        <th>Cantidad</th>
        <th>Precio por unidad</th>
        <th>Precio Total</th>
    </tr>



<?php
$id_cliente = clear($_SESSION['id_cliente']);
$q = $mysqli -> query("SELECT * FROM carrito WHERE id_cliente = '$id_cliente'");
$monto_total = 0;

while($r = mysqli_fetch_array($q))
{
    $q2 = $mysqli -> query("SELECT * FROM peliculas WHERE id = '".$r['id_producto']."'");
    $r2 = mysqli_fetch_array($q2);

    $imagen_producto = $r2['imagen'];
    $nombre_producto = $r2['name'];
    $cantidad = $r['cantidad'];
    $precio_unidad = $r2['price'];
    $precio_total = $cantidad * $precio_unidad; 

    $monto_total = $monto_total + $precio_total; 


    ?>
        <tr>
            <td> <img src="peliculas/<?=$imagen_producto?> " alt="" class="imagen-carrito"></td>
            <td><?=$nombre_producto?></td>
            <td><?=$cantidad?></td>
            <td><?=$precio_unidad?><?=$divisa?></td>
            <td><?=$precio_total?><?=$divisa?></td>
        </tr>
    <?php
}
?>
</table>
<br>
<h2> Total a pagar: <b class = "text-red"><?=$monto_total?> <?=$divisa?></b></h2>
<br><br>

<form method = "POST" action= "" >
<input type = "hidden" name = "monto_total" value = "<?=$monto_total?>"/>
<button class = "btn btn-primary" type = "submit" name = "finCompra"><i class = "fa fa-check"></i> Finalizar Compra</button>
</form>