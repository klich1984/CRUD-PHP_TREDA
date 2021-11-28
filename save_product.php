<?php
/* Incluir la conexio de la base de datos guardada en la variable conn*/
include("database/db.php");


/* Si fue procesado el formulario con el boton llamdo save-producto */
if (isset($_POST['save_product'])) {
	$name_product = $_POST['nombre'];
	$description_product = $_POST['description'];
	$price_product = $_POST['price'];
	$image_product = (isset($_FILES['txtImage']['name'])) ? $_FILES['txtImage']['name'] : '';
	$tienda_id = $_POST['id'];
	/* Verifcar si el el campo de price (valor ) es un numero */
	if (is_numeric($price_product)) {
		/* Almacenar imagen */
		$dateNow = new DateTime();
		$nameFileImage = ($image_product != '') ? $dateNow->getTimestamp().'_'.$_FILES['txtImage']['name'] : 'imagen.jpg';

		$tmpImage = $_FILES['txtImage']['tmp_name'];

		if ($tmpImage != '') {
			/* Mover la imagen a la carpeta indicado */
			move_uploaded_file($tmpImage, './images/'.$nameFileImage);
		}

		/* Consulta que se realizara a la bd, Inserccion de datos */
		$query = "INSERT INTO Producto(tienda_id, nombre_producto, descripcion, valor, imagen) VALUES ($tienda_id, '$name_product', '$description_product', $price_product, '$nameFileImage' );";
		$result = mysqli_query($conn, $query);
		/* Si hay algun problema con la consulta se elimina la conección */
		if (!$result) {
			die("Consulta no realizada");
		}
		/* Guardar en la sesion un mensaje y un color */
		$_SESSION['message'] = 'El producto ha sido guardado correctamente';
		$_SESSION['message_type'] = 'success';

		/* Redireccionar */
		header("location: productos.php?id=$tienda_id");
	} else {
		$_SESSION['message'] = 'El campo Valor ingresado debe ser un número';
		$_SESSION['message_type'] = 'danger';

		/* Redireccionar */
		header("location: productos.php?id=$tienda_id");
	}
};
?>
