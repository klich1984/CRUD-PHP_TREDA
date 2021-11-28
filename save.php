<?php
/* Incluir la conexio de la base de datos guardada en la variable conn*/
include("database/db.php");
// echo $_POST['title'];


if (isset($_POST['save_shop'])) {
	$title = $_POST['title'];
	$date = date($_POST['date']);

	/* Convertir dato en formato dd-mm-YYYY */
	$date_time = date_create($date);
	$new_format_date = date_format($date_time, 'd-m-Y');

	$regExpres = "/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/";

	if (preg_match($regExpres , $new_format_date)) {

		/* Consulta que se realizara a la bd, Inserccion de datos */
		$query = "INSERT INTO Tienda(nombre, fecha_apertura) VALUES ('$title', '$date');";
		$result = mysqli_query($conn, $query);

		if (!$result) {
			die("Consulta no realizada");
		}
		// echo 'Guardado';
		/* Guardar en la sesion un mensaje y un color */
		$_SESSION['message'] = 'La tienda ha sido guardada correctamente';
		$_SESSION['message_type'] = 'success';

		/* Redireccionar */
		header("location: index.php");
	} else {
		$_SESSION['message'] = 'La fecha esta en el formato incorrecto';
		$_SESSION['message_type'] = 'danger';
		echo 'La fecha esta en el formato incorrecto';
		/* Redireccionar */
		header("location: index.php");
	}


};
