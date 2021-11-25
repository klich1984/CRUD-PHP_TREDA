<?php

	include('database/db.php');

	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		// echo $id;
		$query = "DELETE FROM Tienda WHERE id=$id";

		$result = mysqli_query($conn, $query);
		// Si no hay un resultado terminanmos la conexion
		if (!$result) {
			die('La consulta fallo =(');
		}
		$_SESSION['message'] = 'Tarea eliminada satisfactoriamente';
		$_SESSION['message_type'] = 'danger';
		// Redireccionamos
		header('Location: index.php');
	}

?>