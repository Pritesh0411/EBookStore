<?php
	include("../config.php");
  session_start();
	if(!$_SERVER['REQUEST_METHOD']=="POST"){
		header("location:CustomerCart.php");
	}
	$user=$_SESSION['Cust'];
	$sql="SELECT * FROM CART WHERE EmailId='$user'";
	$res=mysqli_query($conn,$sql);
	$cnt=mysqli_num_rows($res);
	for($i=0;$i<$cnt;$i++){
		$row=mysqli_fetch_array($res);
		$ISBN=$row['ISBN'];
		$sql2="SELECT Price FROM BOOKS WHERE ISBN='$ISBN'";
		$res2=mysqli_query($conn,$sql2);
		$rw=mysqli_fetch_array($res2);
		$Price=$rw['Price'];
		$sql1="INSERT INTO ORDERS (ISBN,EmailId,Dt,Quantity,Price,Stats) VALUES ('$ISBN','$user',CURDATE(),1,$Price,0)";
		$res1=mysqli_query($conn,$sql1);
	}
	$sql="DELETE FROM CART WHERE EmailId='$user'";
	if(mysqli_query($conn,$sql)){
	?>	
		<script type="text/javascript">
			alert("Order Placed.");
			window.location.href="CustomerHome.php";
		</script>"
	<?php
	}
?>