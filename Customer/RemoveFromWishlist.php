<?php 
	include("../config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$user=$_SESSION['Cust'];
		$ISBN=$_POST['ISBN'];
		$sql="DELETE FROM WISHLIST WHERE ISBN='$ISBN' AND EmailId='$user'";
		mysqli_query($conn,$sql);
	}
?>