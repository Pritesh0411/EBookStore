<?php
  $user="Account";
  include("../config.php");
  session_start();
  $ISBN=$_SESSION['curr_ISBN'];
  $ses_sql = mysqli_query($conn,"SELECT * FROM BOOKS WHERE ISBN='$ISBN'");
  $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
  $BName=$row['BName'];
  $Publisher=$row['Publisher'];
  $Quantity=$row['Availability'];
  $Price=$row['Price'];
  $Discount=$row['Discount'];
  $GenreID=$row['GenreID'];
  $Author=$row['Author'];
  $Lang=$row['Lang'];
  $Yr=$row['Yr'];
  $sql1=mysqli_query($conn,"SELECT Name FROM Genres WHERE GenreID=$GenreID");
  $row1=mysqli_fetch_array($sql1,MYSQLI_ASSOC);
  $Genre=$row1['Name'];
  $user=$_SESSION['curr_user'];
  $ses_sql = mysqli_query($conn,"SELECT Admin_Name FROM Admin WHERE Admin_ID = '$user' ");
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
	<title>Stock Display</title>
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
  <div class="container-fluid">
    <div class="container bg-light mb-1" style="text-align: center;"><h4>View Product Details</h4></div>
    <hr>
    <div class="container bg-light mb-1" style="text-align: center;"><h4>ISBN: <?php echo $ISBN; ?></h4></div>
    <hr>
    <div class="row">
      <div class="col-sm-6" id="A">
        <ul class="list-group list-group-flush">
          <hr>
          <li class="list-group-item">Book Name</li>
          <li class="list-group-item"><?php echo $BName; ?></li>
          <hr>
          <li class="list-group-item">Quantity Available</li>
          <li class="list-group-item"><?php echo $Quantity; ?></li>          
          <hr>
          <li class="list-group-item">Original Price</li>
          <li class="list-group-item"><?php echo $Price; ?></li>
          <hr>
          <li class="list-group-item">Discount</li>
          <li class="list-group-item"><?php echo $Discount; ?></li>
          <hr>
          <li class="list-group-item">Effective Price</li>
          <li class="list-group-item"><?php echo ($Price*(100-$Discount))/100; ?></li>
          <hr>
        </ul>
      </div>
      <div class="col-sm-6">
        <ul class="list-group list-group-flush">
          <hr>
          <li class="list-group-item">Genre</li>
          <li class="list-group-item"><?php echo $Genre; ?></li>
          <hr>
          <li class="list-group-item">Publisher</li>
          <li class="list-group-item"><?php echo $Publisher; ?></li>
          <hr>
          <li class="list-group-item">Author</li>
          <li class="list-group-item"><?php echo $Author; ?></li>
          <hr>
          <li class="list-group-item">Language</li>
          <li class="list-group-item"><?php echo $Lang; ?></li>
          <hr>
          <li class="list-group-item">Year</li>
          <li class="list-group-item"><?php echo $Yr; ?></li>
          <hr>
        </ul>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>