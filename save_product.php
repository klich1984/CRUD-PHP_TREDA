<?php
/* Incluir la conexio de la base de datos guardada en la variable conn*/
include("database/db.php");
// echo $_POST['title'];
// var_dump($_POST);

if (isset($_POST['save_product'])) {
	$name_product = $_POST['nombre'];
	$description_product = $_POST['description'];
	$price_product = $_POST['price'];
	// $image_product = $_POST['image'] ? $_POST['image'] : 'imagen.jpg';
	$image_product = (isset($_FILES['txtImage']['name'])) ? $_FILES['txtImage']['name'] : '';
	$tienda_id = $_POST['id'];

	if (is_numeric($price_product)) {
		echo 'Es un numero';
		/* Almacenar imagen */
		$dateNow = new DateTime();
		$nameFileImage = ($image_product != '') ? $dateNow->getTimestamp().'_'.$_FILES['txtImage']['name'] : 'imagen.jpg';

		$tmpImage = $_FILES['txtImage']['tmp_name'];

		if ($tmpImage != '') {
			/* Mover la imagen al carpeta indicado */
			move_uploaded_file($tmpImage, './images/'.$nameFileImage);
		}

		// echo $name_product.'<br/>';
		// echo $description_product.'<br/>';
		// echo $price_product.'<br/>';
		// echo $image_product.'<br/>';
		// echo $nameFileImage.'<br/>';
		// echo $tienda_id.'<br/>';

		/* Consulta que se realizara a la bd, Inserccion de datos */
		$query = "INSERT INTO Producto(tienda_id, nombre_producto, descripcion, valor, imagen) VALUES ($tienda_id, '$name_product', '$description_product', $price_product, '$nameFileImage' );";
		// echo $query;
		$result = mysqli_query($conn, $query);

		if (!$result) {
			die("Consulta no realizada");
		}
		// echo 'Guardado';
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
