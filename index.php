<?php include('./database/db.php') ?>

<?php include('./includes/header.php') ?>

<div class="container p-4">
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

			<!-- Tienda -->
			<div class="card">
				<div class="card-header">
					Tienda
				</div>
				<div class="card card-body">
					<!-- Formulario, se enviara al archivo save.php por el action -->
					<form action="save.php" method="POST">
						<div class="form-group">
							<input
								type="text"
								name="title"
								class="form-control"
								placeholder="Nombre de la tienda" autofocus>
						</div>
						<div class="form-group">
							<label for="date">Fecha Apertura</label>
							<input
								type="date"
								name="date"
								class="form-control"
								placeholder="Fecha de Apertura"
								min=<?php $date_now=date("Y-m-d"); echo $date_now;?>>
						</div>
						<!-- Input para procesar el formulario -->
						<input
							type="submit"
							class="btn btn-success btn-block"
							name="save_shop"
							value="Guardar Tienda">
					</form>
				</div>
			</div>
		</div>
				<!-- Columna para tiendas -->
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Tiendas
				</div>
				<div class="card card-body p-1">
					<!-- Tabla que lista tiendas -->
					<table class="table table-bordered">
							<thead>
								<tr class="text-center">
									<th>Nombre Tienda</th>
									<th>Fecha Apertura</th>
									<th>Productos</th>
									<th>Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$query = "SELECT * FROM Tienda";
									$all_tiendas = mysqli_query($conn, $query);
									/* Recorro cada una de las tiendas para incrustar dinamicamente el contenido */
									while ($row = mysqli_fetch_array($all_tiendas)) { ?>
										<tr>
											<td><?php echo $row['nombre'] ?> </td>
											<td><?php
												$date_time = date_create($row['fecha_apertura']);
												$new_format_date = date_format($date_time, 'd-m-Y');
												echo  $new_format_date; ?></td>
											<td class="text-center">
												<a href="productos.php?id=<?php echo $row['tienda_id']?>" class="btn btn-warning">
													<i class="fas fa-tasks"> Ver productos</i>
												</a>
											</td>
											<td class="text-center">
												<a href="edit.php?id=<?php echo $row['tienda_id']?>" class="btn btn-info">
													<i class="far fa-edit"></i>
												</a>
												<a href="delete.php?id=<?php echo $row['tienda_id'] ?>" class="btn btn-danger">
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


<?php include('./includes/footer.php') ?>
