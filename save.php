<?php
/* Incluir la conexio de la base de datos guardada en la variable conn*/
include("database/db.php");
// echo $_POST['title'];


if (isset($_POST['save_shop'])) {
	$title = $_POST['title'];
	$date = date($_POST['date']);

	// echo $title;
	// echo $date;
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
};
