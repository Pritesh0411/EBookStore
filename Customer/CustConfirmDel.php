<?php 
	include("../config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$OId=$_POST['OId'];
		$sql="UPDATE ORDERS 
			  SET Stats=1
			  WHERE OrderId=$OId";
		mysqli_query($conn,$sql);
	}
?>