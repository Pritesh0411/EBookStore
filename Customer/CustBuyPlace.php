<?php
	include("../config.php");
  session_start();
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$ISBN=$_POST['ISBN'];
	}
	else{
		header("location:CustomerHome.php");
	}
	$user=$_SESSION['Cust'];
	$sql1="SELECT Price FROM BOOKS WHERE ISBN='$ISBN'";
	$res1=mysqli_query($conn,$sql1);
	$arr=mysqli_fetch_array($res1,MYSQLI_ASSOC);
	$Price=$arr['Price'];
	$sql="INSERT INTO ORDERS (ISBN,EmailId,Dt,Quantity,Price,Stats) VALUES ('$ISBN','$user',CURDATE(),1,$Price,0)";
	$res=mysqli_query($conn,$sql);
	$sql="DELETE FROM CART WHERE EmailId='$user' and ISBN='$ISBN'";
	if(mysqli_query($conn,$sql)){
	?>	
		<script type="text/javascript">
			alert("Order Placed.");
			window.location.href="CustomerHome.php";
		</script>"
	<?php
	}
?>