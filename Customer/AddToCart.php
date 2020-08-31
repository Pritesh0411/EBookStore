<?php 
	include("../config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$user=$_SESSION['Cust'];
		$ISBN=$_POST['ISBN'];
		$sql1="SELECT Availability FROM BOOKS WHERE ISBN='$ISBN'";
		$res=mysqli_query($conn,$sql1);
		$arr=mysqli_fetch_array($res,MYSQLI_ASSOC);
		$avl=$arr['Availability'];
		if($avl!=0){
			$sql="INSERT INTO CART (ISBN,EmailId) VALUES ('$ISBN','$user')";
			mysqli_query($conn,$sql);
		}
	}
?>