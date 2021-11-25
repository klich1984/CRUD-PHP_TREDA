<?php
/* creamos sesion para guardar en este caso los mensajes */
session_start();

/* Conexion base de datos */
$conn = mysqli_connect(
	'localhost',
	'root',
	'',
	'treda-solutions'
);

// if (isset($conn)) {
// 	echo 'Database conectada';
// }

?>