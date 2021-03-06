<?php
/* Incluir la conexio de la base de datos guardada en la variable conn*/
include("database/db.php");
$tienda_id = $_GET['id'];
/* query para capturar el nombre de la tienda */
$query1 = "SELECT nombre FROM Tienda WHERE tienda_id = $tienda_id";

$result = mysqli_query($conn, $query1);
		// Comprobar cuantas lineas tiene mis resultados
		if (mysqli_num_rows($result) == 1 ) {
			$row = mysqli_fetch_array($result);
			$name = $row['nombre'];
		}

?>

<?php require('includes/header.php') ?>

<div class="container">
		<h1 class="text-center text-info">Nombre Tienda: <?php echo $name ?></h1>
		<div class="col-md-6 m-auto">
					<!-- Alertas -->
			<?php if(isset($_SESSION['message'])) { ?>
				<div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
					<?= $_SESSION['message'] ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<!-- Limpiar los datos que tenemos en $_SESSION para ocultar la alerta cuando la cierren -->
			<?php session_unset(); }; ?>
			</div>
</div>
<div class="container-fluid p-4">
	<a href="index.php" class="btn btn-primary mb-2">Ir a tiendas</a>
	<div class="row">
		<div class="col-md-3">
			<!-- Form Insertar Productos -->
			<div class="card">
				<div class="card-header">
					Inserte Producto
				</div>
				<div class="card card-body">
					<!-- Formulario - para permitir el envio de archivos por POST enctype="multipart/form-data-->
					<form action="save_product.php" enctype="multipart/form-data" method="POST">
						<!-- Nombre -->
						<div class="form-group">
							<input
								required
								type="text"
								name="nombre"
								class="form-control"
								placeholder="Nombre del producto"
								autofocus>
						</div>
						<!-- Descripcion -->
						<div class="form-group">
							<input
								required
								type="text"
								name="description"
								class="form-control"
								placeholder="Descripcion del producto">
						</div>
						<!-- Precio - Valor -->
						<div class="form-group">
							<input
								required
								type="number"
								name="price"
								class="form-control"
								placeholder="Valor del producto">
						</div>
						<!-- Imagen -->
						<div class="form-group">
							<input
								type="file"
								id="txtImage"
								name="txtImage"
								class="form-control"
								placeholder="Imagen">
						</div>
						<!-- Campo para el id -->
						<input type="hidden" name="id" value="<?php echo $tienda_id; ?>">
						<!-- Input para procesar el formulario -->
						<input
							type="submit"
							class="btn btn-success btn-block"
							name="save_product"
							value="Guardar Producto">
					</form>
				</div>
			</div>
		</div>
				<!-- Columna para productos -->
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					Productos
				</div>
				<div class="card card-body p-1">
					<!-- Tabla que lista productos de la tienda -->
					<table class="table table-bordered">
							<thead>
								<tr class="text-center">
									<th>SKU</th>
									<th>Producto</th>
									<th>Descripci??n</th>
									<th>Precio</th>
									<th>Imagen</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$query = "SELECT * FROM Producto P JOIN Tienda T ON P.tienda_id = T.tienda_id WHERE P.tienda_id = $tienda_id";
									$all_productos = mysqli_query($conn, $query);

									/* Recorro cada una de los productos e insertar dinamicamente cada registro */
									while ($row = mysqli_fetch_array($all_productos)) { ?>
										<tr>
											<td><?php echo $row['SKU'] ?> </td>
											<td><?php echo $row['nombre_producto'] ?></td>
											<td><?php echo $row['descripcion'] ?></td>
											<td>$ <?php echo $row['valor'] ?></td>
											<td>
												<div class="text-center">
													<img
														src="./images/	<?php echo $row['imagen'] ?>"
														alt="<?php echo $row['descripcion']?>"
														width="50">
												</div>
											</td>
											<td class="text-center">
												<a href="edit_product.php?sku=<?php echo $row['SKU']?>" class="btn btn-info">
													<i class="far fa-edit"></i>
												</a>
												<a href="delete_product.php?sku=<?php echo $row['SKU'] ?>" class="btn btn-danger">
													<i class="fas fa-trash-alt"></i>
												</a>
											</td>
										</tr>
								<?php	} ?>
							</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require('includes/footer.php') ?>
