<?php include 'templates/header.php' ?>

<body>   
	<!-- Page content-->
	<div class="container-fluid main" id="app">
		<h2 class="font-weight-bold mt-5 text-center col-12">
			Actualizar
		</h2> 
				
		<div class="card shadow mb-4 col-lg-4 offset-lg-4">
			<div class="card-body">         
				<form action="" id='editForm' method="post">
					<div class="form-group mb-5">
						<input type="text" id="task_name" name="task_name" placeholder="Tarea" class='form-control'>
					</div>
					<input type="submit" value="Actualizar" class='btn btn-primary'>
					<a href="index.php" class='btn btn-danger'>Cancel</a>
				</form>    
			</div><!-- /.card-body -->
		</div><!-- /.card -->
	</div><!-- /.container-fluid -->

<?php include 'templates/scripts.php' ?>
<script src="js/edit.js"></script>

</body>
</html>
