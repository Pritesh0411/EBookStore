<?php
	$login_session ="Account";
	include("../config.php");
	session_start();
	$user=$_SESSION['curr_user'];
	$ses_sql = mysqli_query($conn,"select Admin_Name from Admin where Admin_ID = '$user' ");
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $login_session = $row['Admin_Name'];
	if(!isset($_SESSION['curr_user'])){
    header("location:AdminLogin.php");
    die();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Admin Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  	<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
	<div class="container-fluid" >
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
      <a class="navbar-brand mr-auto" href="AdminHome.php" style="font-size: 30px" >E-Book Store</a>
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
            echo $login_session;
          ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Profile Details</a>
          <a class="dropdown-item" href="#">History</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="AdminLogout.php">Logout</a>
        </div>
      </div>
    </nav>
  </div>
  <hr>
  <div class="container bg-light mb-1" style="text-align: center;"><h4>Admin Home</h4></div>
  <hr>
  <hr>
  <div class="container bg-light mb-1" style="text-align: center;"><h4>Stock View and Updation</h4></div>
  <hr>
  <br>
  <div class="container">
  	<div class="row">
  		<div class="col-sm-4"></div>
  		<div class="col-sm-4">
  			<div class="list-group" style="text-align: center;">
  				<br>
				  <a href="AdminAddStock.php" class="list-group-item list-group-item-action list-group-item-dark">Add New Product</a>
				  <br>
				  <a href="AdminUpdateStock.php" class="list-group-item list-group-item-action list-group-item-dark">Update Existing Stock</a>
          <br>
          <a href="AdminAddGenre.php" class="list-group-item list-group-item-action list-group-item-dark">Add New Genre</a>
				  <br>
				  <a href="AdminViewStock.php" class="list-group-item list-group-item-action list-group-item-dark">View Stock</a>
          <br>
				</div>
  		</div>
  		<div class="col-sm-4"></div>
  	</div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>