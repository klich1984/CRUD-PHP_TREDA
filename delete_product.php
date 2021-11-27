<?php

	include('database/db.php');

	$id = $_GET['sku'];
	if (isset($_GET['sku'])) {
		$SKU = $_GET['sku'];

		/* Query para traerme la imagen y borrarla del servidor */

		$query1 = "SELECT imagen FROM Producto WHERE SKU = $SKU";

		$result = mysqli_query($conn, $query1);
		// Comprobar cuantas lineas tiene mis resultados
		if (mysqli_num_rows($result) == 1 ) {
			// echo 'Puedemos editar';
			$row = mysqli_fetch_array($result);
			$image = $row['imagen'];
			// echo $image;
		}

		if (isset($image) && ($image != 'imagen.jpg')) {
			if(file_exists('./images/'.$image)) {
				/* Borrar el archivo  */
				unlink('./images/'.$image);
			}
		}

		// echo $SKU;
		// echo $id;
		$querySelect = "SELECT tienda_id FROM Producto WHERE SKU = $SKU";

		$result = mysqli_query($conn, $querySelect);
		// Comprobar cuantas lineas tiene mis resultados
		if (mysqli_num_rows($result) == 1 ) {
			// echo 'Puedemos editar';
			$row = mysqli_fetch_array($result);
			$tienda_id = $row['tienda_id'];
			// echo $tienda_id;
		}
		$queryDelete = "DELETE FROM Producto WHERE SKU = $SKU";

		$result = mysqli_query($conn, $queryDelete);
		// Si no hay un resultado terminanmos la conexion
		if (!$result) {
			die('La consulta fallo =(');
		}
		$_SESSION['message'] = 'Producto eliminado satisfactoriamente';
		$_SESSION['message_type'] = 'danger';
		// Redireccionamos
		header("Location: productos.php?id=$tienda_id");
	}

?>