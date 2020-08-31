<?php
	$error="";
	include("../config.php");
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$Email=$_POST['EmailId'];
		$Pass=$_POST['Password'];
		$sql="SELECT EmailId FROM CUSTOMER WHERE EmailId= Binary '$Email' and Pass= Binary '$Pass'";
		$res=mysqli_query($conn,$sql);
		$cnt=mysqli_num_rows($res);
		if($cnt==1){
			$_SESSION['Cust']=$Email;
			header("location:CustomerHome.php");
		}
		else{
			$error="<p>* Your Email-ID is not registered or your Password is invalid.<br></p>";
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign In</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid" >
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
      <a class="navbar-brand mx-auto" href="CustomerLogin.php" style="font-size: 30px" >E-Book Store</a>
    </nav>
	</div>
	<hr>
	<div class="container-fluid bg-light mb-1" style="text-align: center;"><h4>Sign In</h4></div>
  	<br>
	<div class="container-fluid" >
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label for="Email">Email ID</label>
            <input type="email" class="form-control" id="EmailID" name="EmailId" required>
          <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" required>
          </div>
          <br>
          <!--<div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>-->
          <div style="color: red; font-size: 15px;">
            <?php echo $error; ?>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="col-sm-4"></div>
    </div>
</body>
</html>