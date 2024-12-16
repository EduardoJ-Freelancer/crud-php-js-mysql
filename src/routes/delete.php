<?php require_once "../clases/Tasks.php";
// 
if( empty($_POST['id']) ){
	echo "Not found";
	die();
} else {
	$task = new Tasks;
	$new_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
	$row = $task->get_row($new_id);
	if( $row ) {
		echo $task->delete( $new_id );	
	} else {
		echo 'Registro no encontrado';
	}
	
}