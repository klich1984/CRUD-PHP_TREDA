<?php
/* Incluir la conexio de la base de datos guardada en la variable conn*/
include("database/db.php");
// echo $_GET['id'];
$tienda_id = $_GET['id'];
/* SELECT nombre FROM `Tienda` WHERE tienda_id = 12; */
$query1 = "SELECT nombre FROM Tienda WHERE tienda_id = $tienda_id";

$result = mysqli_query($conn, $query1);
		// Comprobar cuantas lineas tiene mis resultados
		if (mysqli_num_rows($result) == 1 ) {
			// echo 'Puedemos editar';
			$row = mysqli_fetch_array($result);
			$name = $row['nombre'];
			// echo $name;
		}

// var_dump($name);

// $txtImage = 'image.png'

?>
<?php require('includes/header.php') ?>
<div class="container">
		<h1 class="text-center text-info">Nombre Tienda: <?php echo $name ?></h1>
</div>
<div class="container p-4">
	<a href="index.php" class="btn btn-primary mb-2">Ir a tiendas</a>
	<div class="row">
		<div class="col-md-4">
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

			<!-- Form Insertar Productos -->
			<div class="card">
				<div class="card-header">
					Inserte Producto
				</div>
				<div class="card card-body">
					<!-- Formulario -->
					<form action="save_product.php" method="POST">
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
							<label for="txtImagen">Imagen:</label>
							producto.jpg
							<img
								src="./images/image.jpg"
								alt="Nombre Producto"
								width="50"
								class="img-thumbnail rounded mb-2">
							<input
								type="file"
								name="image"
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
		<div class="col-md-8">
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
									<th>Descripción</th>
									<th>Precio</th>
									<th>Imagen</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
								/* SELECT * FROM `Producto` P JOIN `Tienda` T ON P.tienda_id = T.tienda_id WHERE P.tienda_id = 18; */
									$query = "SELECT * FROM Producto P JOIN Tienda T ON P.tienda_id = T.tienda_id WHERE P.tienda_id = $tienda_id";
									$all_productos = mysqli_query($conn, $query);
									// var_dump($all_productos);

									/* Recorro cada una de las tiendas  */
									while ($row = mysqli_fetch_array($all_productos)) { ?>
										<tr>
											<td><?php echo $row['SKU'] ?> </td>
											<td><?php echo $row['nombre_producto'] ?></td>
											<td><?php echo $row['descripcion'] ?></td>
											<td>$ <?php echo $row['valor'] ?></td>
											<td><?php echo $row['imagen'] ?></td>
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