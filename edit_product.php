<?php

	include('database/db.php');

	/* Si hay datos enviados por el metodo GET */
	if (isset($_GET['sku'])) {
		$SKU = $_GET['sku'];
		$query = "SELECT * FROM Producto WHERE SKU = $SKU";

		$result = mysqli_query($conn, $query);
		// Comprobar cuantas lineas tiene mis resultados
		if (mysqli_num_rows($result) == 1 ) {
			$row = mysqli_fetch_array($result);
			$tienda_id = $row['tienda_id'];
			$name_product = $row['nombre_producto'];
			$description_product = $row['descripcion'];
			$price_product = $row['valor'];
			$image_product = $row['imagen'];
		}
	}

	/* Si hay datos enviados por el metodo POST y es de nombre update */
	if (isset($_POST['update'])) {
		$tienda_id = $_POST['tienda_id'];
		$name_product = $_POST['name'];
		$description_product = $_POST['description'];
		$price_product = $_POST['price'];
		$image_product = (isset($_FILES['txtImage']['name'])) ? $_FILES['txtImage']['name'] : '';

		/* Verificar que el dato price(value) sea de tipo numerico */
		if (is_numeric($price_product)) {
			/* Actualizar imagen nueva*/
			$dateNow = new DateTime();
			$nameFileImage = ($image_product != '') ? $dateNow->getTimestamp().'_'.$_FILES['txtImage']['name'] : 'imagen.jpg';

			$tmpImage = $_FILES['txtImage']['tmp_name'];
			move_uploaded_file($tmpImage, './images/'.$nameFileImage);

			/* Borrar imagen antigua */
			$query1 = "SELECT imagen FROM Producto WHERE SKU = $SKU";

			$result = mysqli_query($conn, $query1);
			// Comprobar cuantas lineas tiene mis resultados
			if (mysqli_num_rows($result) == 1 ) {
				$row = mysqli_fetch_array($result);
				$image = $row['imagen'];
			}

			if (isset($image) && ($image != 'imagen.jpg')) {
				if(file_exists('./images/'.$image)) {
					/* Borrar el archivo  */
					unlink('./images/'.$image);
				}
			}

			/* Query Actualizar Producto */
			$query = "UPDATE Producto SET nombre_producto = '$name_product', descripcion = '$description_product',  valor = $price_product, imagen = '$nameFileImage'  WHERE SKU = $SKU";

			mysqli_query($conn, $query);

			$_SESSION['message'] = 'Producto actualizado Correctamente';
			$_SESSION['message_type'] = 'primary';
			/* Redireccionar */
			header("Location: productos.php?id=$tienda_id");

		} else {
			$_SESSION['message'] = 'El campo Valor ingresado debe ser un número';
			$_SESSION['message_type'] = 'danger';

			/* Redireccionar */
			header("Location: productos.php?id=$tienda_id");
		}
	}
?>

<?php include('includes/header.php') ?>

	<div class="container p-4">
		<div class="row">
			<div class="col-md-4 mx-auto">

			<!-- Form Insertar Productos -->
				<div class="card">
					<div class="card-header">
						Actualizar Producto
					</div>
					<div class="card card-body">
						<!-- Formulario -->
						<form action="edit_product.php?sku=<?php echo $_GET['sku']; ?>"  enctype="multipart/form-data" method="POST">
							<!-- Nombre -->
							<div class="form-group">
								<input
									required
									type="text"
									value="<?php echo $name_product ?>"
									name="name"
									class="form-control"
									placeholder="Nombre del producto"
									autofocus>
							</div>
							<!-- Descripcion -->
							<div class="form-group">
								<input
									required
									type="text"
									value="<?php echo $description_product ?>"
									name="description"
									class="form-control"
									placeholder="Descripcion del producto">
							</div>
							<!-- Precio - Valor -->
							<div class="form-group">
								<input
									required
									value="<?php echo $price_product ?>"
									type="number"
									name="price"
									class="form-control"
									placeholder="Valor del producto">
							</div>
							<!-- Imagen -->
							<div class="form-group">
								<label for="txtImagen">Imagen:</label>
								<?php echo $image_product ?>
								<div>
									<img
										src="./images/<?php echo $image_product ?>"
										alt="Nombre Producto"
										width="50"
										class="img-thumbnail rounded mb-2">
								</div>
								<input
									required
									value="<?php echo $image_product ?>"
									type="file"
									name="txtImage"
									class="form-control"
									placeholder="Imagen">
							</div>
							<!-- Campo para el id -->
							<input type="hidden" name="tienda_id" value="<?php echo $tienda_id; ?>">
							<!-- Boton que ejecutara el formulario -->
							<button type="submit" class="btn btn-success" name="update">
								Actualizar
							</button>
							<a href="productos.php?id=<?php echo $tienda_id ?>" class="btn btn-outline-danger">Cancelar</a>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php include('includes/footer.php') ?>
