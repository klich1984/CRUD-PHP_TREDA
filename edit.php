<?php

	include('database/db.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$query = "SELECT * FROM Tienda WHERE tienda_id = $id";

		$result = mysqli_query($conn, $query);
		// Comprobar cuantas lineas tiene mis resultados
		if (mysqli_num_rows($result) == 1 ) {
			$row = mysqli_fetch_array($result);
			$nombre = $row['nombre'];
			$date = $row['fecha_apertura'];
		// 	echo $nombre;
		// echo $date;
		}
	}

	if (isset($_POST['update'])) {
		// echo 'Actualizando...';
		$id = $_GET['id'];
		$nombre = $_POST['nombre'];
		$date = $_POST['date'];
		// echo $nombre;
		// echo $date;
		// echo $id;
		$query = "UPDATE Tienda SET nombre = '$nombre', fecha_apertura = '$date' WHERE tienda_id = $id";

		$result = mysqli_query($conn, $query);
		// Si no hay un resultado terminanmos la conexion
		if (!$result) {
			die('La consulta fallo =(');
		}

		$_SESSION['message'] = 'Tienda actualizada Correctamente';
		$_SESSION['message_type'] = 'primary';
		/* Redireccionar */
		header("Location: index.php");
	}

?>

<?php include('includes/header.php') ?>

	<div class="container p-4">
		<div class="row">
			<div class="col-md-4 mx-auto">
				<div class="card card-body">
					<!-- Formulario -->
					<form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST">
						<div class="form-group">
							<input
								type="text"
								name="nombre"
								value="<?php echo $nombre; ?>"
								class="form-control"
								placeholder="Actualiza el titulo">
						</div>
						<div class="form-group">
							<input
								type="date"
								name="date"
								value="<?php echo $date; ?>"
								class="form-control"
								placeholder="Fecha de Apertura YYYY-mm-dd">
						</div>
						<!-- Boton que ejecutara el formulario -->
						<button type="submit" class="btn btn-success" name="update">
							Actualizar
						</button>
						<a href="index.php" class="btn btn-outline-danger">Cancelar</a>
					</form>
				</div>
			</div>
		</div>
	</div>

<?php include('includes/footer.php') ?>