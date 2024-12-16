<?php require_once "../clases/Tasks.php";
if(empty($_POST['id'])) {
	echo "Not found";
	die();
} else {
	$task_name = $_POST['task_name'];
	if( !empty($task_name) ) {		
		if( ( ( strlen($task_name) < 4 ) || (strlen($task_name) > 50) ) ) {
			echo "Must be 4-50 characters only. Please try again.";         
		} else {
			$task = new Tasks;
			$new_id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$new_task = filter_var($_POST['task_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			echo $task->update($new_task, $new_id);
		}	
	} else {
		echo 'El campo es requerido, ingresa datos por favor';
	}
}
