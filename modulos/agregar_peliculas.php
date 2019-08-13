<?php
    check_admin();
//revisar que se presione el bton de enviar
    if(isset($enviar))
    {
        $name = clear($name);
        $price = clear($price);

        $imagen = "";
//if que sube imagen de pelicula
        if(is_uploaded_file($_FILES['imagen']['tmp_name']))
        {
            $imagen = $name.rand(0,1000).".png"; 
            move_uploaded_file($_FILES['imagen']['tmp_name'], "peliculas/".$imagen);
        }
//codigo para subir el nombre, precio y imagen de las peliculas nuevas
        $mysqli->query("INSERT INTO peliculas (name,price,imagen) VALUES ('$name','$price','$imagen')");
	    alert("Película agregada");
	    redir("?p=agregar_peliculas");
    }

?>
//codigo para que se vea diferente la pagina
<form method = "POST" action = "" enctype = "multipart/form-data">
    <div class="form-group">
        <input type = "text" class = "form-control" name = "name" placeholder = "Nombre de le película">
    </div>

    <div class="form-group">
        <input type = "text" class = "form-control" name = "price" placeholder = "Precio de la película">
    </div>

    <label>Imagen de la película (solo formato png)</label>

    <div class="form-group">
        <input type = "file" class = "form-control" name = "imagen" title = "Imagen de la película" placeholder = "Imagen de la película">
    </div>

    <div class="form-group">
        <button type = "submit" class = "btn btn-success" name = "enviar"><i class = "fa fa-check"></i> Agregar Película</button>
    </div>

</form>