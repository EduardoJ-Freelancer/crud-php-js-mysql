$(document).ready( function($) {

    // Refresh load
    $(document).on('click', '#btn-refresh', function(event) {
        window.location.href = "index.php";
    });

    // Reset form & clean msg
    $(document).on('click', '#btn-add-task', function(event) {
        $("#saveModal .text-danger").text(''); 
        $( '#form-task' ).trigger( 'reset' );
    });

    // Send form keypress enter
    $(document).on('keypress', '#saveModal #form-task', function(event) {
        if( event.keyCode === 13 ) {        
            event.preventDefault();
            $("#btn-save-task").trigger({ type: "click" });
        }
    });
	
    // List tasks
    $("#table-body-tasks").load("routes/load.php");

    // Create task
    $(document).on('click', '#btn-save-task', function(event) {
		event.preventDefault();
		$.ajax({
			type: "POST",
			url:"routes/post.php",
			data: $('#form-task').serialize(),
		})
		.done(function(response) {
            if (response === 'success') {
                $('#saveModal').modal('hide');
                $( '#form-task' ).trigger( 'reset' );
                $("[data-dismiss=modal]").trigger({ type: "click" });
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'El registro se ha guardado satisfactoriamente',
                    showConfirmButton: false,
                    timer: 2000,
                });
                $("#table-body-tasks").load("routes/load.php"); 
            } else {
                $("#saveModal .text-danger").text(response); 
            }
		})
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
	});

	// Search task
	$("#keywords").keyup(function() {
		$("#msg").hide();
	    let keywords = $("#keywords").val();
	    if( keywords !='' ) {
            $("#table-body-tasks").html('');
            $.ajax({
                type:"POST",
                url:"routes/search.php",
                data:{ keywords:keywords },
                success:function(response) {
                    $("#table-body-tasks").html(response);
                }
            });
        } else	{
            $("#table-body-tasks").load("routes/load.php");
        }
	});

    // Delete task
    $(document).on('click', '.delete-task', function(event) {
        event.preventDefault();
        let id = $(this).attr('id');
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir la operación!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Elimínalo!'
        }).then((result) => {
            if (result.value) {
                var dataString = {};
                dataString['id'] = id;
                $.ajax({
                    url : 'routes/delete.php',
                    type: 'POST',
                    data : dataString,
                })
                .done(function( response ) {
                    console.log("success");
                    console.log(response);
                    // csrf['csrf'] = response.hash;                
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'El registro ha sido eliminado',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#table-body-tasks").load("routes/load.php"); 
                })
                .fail(function() {
                    console.log("error");
                })
                .always(function() {
                    console.log("complete");
                });
            }
        });
    });

});	