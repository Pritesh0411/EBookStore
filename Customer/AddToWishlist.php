<?php 
	include("../config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$user=$_SESSION['Cust'];
		$ISBN=$_POST['ISBN'];
		$sql="INSERT INTO WISHLIST (ISBN,EmailId) VALUES ('$ISBN','$user')";
		mysqli_query($conn,$sql);
	}
?>