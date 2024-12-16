<?php require_once "../clases/Tasks.php";
if( isset($_GET['id']) ){
	$task = new Tasks;
	$new_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
	$data = $task->get_row($new_id);
	echo json_encode($data);
} else {
	echo "Not found";
	die();
}