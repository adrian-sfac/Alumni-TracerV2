<?php
include '../../includes/conn.php';
$id = $_POST['id'];
$msg = $_POST['msg'];
if($msg != ""){
	$sql = $conn->query("INSERT INTO tbl_forum (parent_comment, post)
			VALUES ('$id','$msg')");
	echo json_encode(array("statusCode"=>200));
}
else{
	echo json_encode(array("statusCode"=>201));
}
$conn = null;

?>