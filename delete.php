<?php
require_once('database.php');

$tnumber = $_GET['task_number'];
$res = $database->delete($tnumber);
 if($res){
 	header('location: view.php');
 }else{
 	echo "Failed to Delete Record";
 }

?>