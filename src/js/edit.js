$(document).ready(function($) {

    // Search var id on url
	function get_id()
	{
		let url = new URLSearchParams(window.location.search);
		let id = url.get('id');
		return parseInt(id);
	}

    // Get row from Database
	function get_rows() {
		let id = get_id();
		$.get(
			"routes/get.php",
			{id : id},
			function(response) {
				response = JSON.parse(response);
				$("#task_name").val(response.task_name);
			}
		);
	}

	if ( get_id() ) {
		get_rows();
	}
		
    // Submit form edit
	$("#editForm").submit(function(e) {
		e.preventDefault();
		let id = get_id();
		$.ajax({
			type: "POST",
			url:"routes/update.php",
			data: { task_name : $('#task_name').val(), id : id },
		})
		.done(function(response) {
			if (response === 'success') {
				Swal.fire({
					position: 'center',
					type: 'success',
					title: 'Registro actualizado',
					showConfirmButton: false,
					timer: 2000,
				});
				setTimeout(function(){
					console.log("Datos actualizados, redirect a listado en 2 segundos");
					window.location.href = "index.php";
				}, 2000);
			} else {
				Swal.fire({
					position: 'center',
					type: 'error',
					title: response,
					showConfirmButton: false,
					timer: 2000,
				});
			}
			
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	});
    
});