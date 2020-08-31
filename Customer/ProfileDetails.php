<?php
	$Fname="Account";
  $LName="";
  include("../config.php");
  session_start();
  if(!isset($_SESSION['Cust'])){
    header("location:CustomerLogin.php");
    die();
  }
  $user=$_SESSION['Cust'];
  $ses="SELECT * FROM CUSTOMER WHERE EmailId='$user'";
  $session=mysqli_query($conn,$ses);
  $userrow=mysqli_fetch_array($session,MYSQLI_ASSOC);
  $Fname=$userrow['FirstName'];
  $LName=$userrow['LastName'];
  $EmailId=$user;
  $MNo=$userrow['MobNo'];
  $Adds=$userrow['Address'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Profile</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid" >
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="CustomerHome.php">E-Book Store</a>
      <form class="form-inline my-2 my-lg-0 mx-auto">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="color: white; border-color: white;">Search</button>
      </form>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">    
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
           <a class="nav-link btn btn-primary mr-1" href="CustomerCart.php" style="font-weight: medium; color: white; ">Cart</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: medium; color: white; ">
              <?php echo $Fname." ".$LName; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="ProfileDetails.php">Profile Details</a>
              <a class="dropdown-item" href="CustomerOrders.php">My Orders</a>
              <a class="dropdown-item" href="CustomerWishlist.php">My Wishlist</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="CustomerLogout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
  </div>
  <hr>
  <div class="container bg-light mb-1" style="text-align: center;"><h4>Profile Details</h4></div>
  <hr>
  <div class="container">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <ul class="list-group list-group-flush">
          <hr>
          <li class="list-group-item">First Name</li>
          <li class="list-group-item"><?php echo $Fname; ?></li>
          <hr>
          <li class="list-group-item">Last Name</li>
          <li class="list-group-item"><?php echo $LName; ?></li>          
          <hr>
          <li class="list-group-item">Email ID</li>
          <li class="list-group-item"><?php echo $EmailId; ?></li>
          <hr>
          <li class="list-group-item">Mobile Number</li>
          <li class="list-group-item"><?php echo $MNo; ?></li>
          <hr>
          <li class="list-group-item">Address</li>
          <li class="list-group-item"><?php echo $Adds; ?></li>
          <hr>
        </ul>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>
</body>
</html>