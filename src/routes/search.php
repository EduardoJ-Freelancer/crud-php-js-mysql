<?php require_once "../clases/Tasks.php";
if( isset($_POST['keywords']) ){
	$keywords = $_POST['keywords'];
	$new_keywords = filter_var($_POST['keywords'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
	$task = new Tasks;
	echo $task->search( "%".$new_keywords."%" );
} else {
	echo "Not found";
	die();
}