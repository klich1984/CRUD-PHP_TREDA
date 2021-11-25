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
					<!-- Formulario, se enviara al archivo save_task.php por el action -->
					<form action="save.php" method="POST">
						<div class="form-group">
							<input type="text" name="title" class="form-control" placeholder="Nombre de la tienda" autofocus>
						</div>
						<div class="form-group">
							<input type="date" name="date" class="form-control" placeholder="Fecha de Apertura YYYY-mm-dd">
						</div>
						<!-- Input para procesar el formulario -->
						<input type="submit" class="btn btn-success btn-block" name="save_shop" value="Guardar Tienda">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<?php include('./includes/footer.php') ?>