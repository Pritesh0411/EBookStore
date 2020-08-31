<?php
  $errISBN="";
  $user="Account";
  include("../config.php");
  session_start();
  if(($_SERVER["REQUEST_METHOD"] == "POST")){
    $ISBN=$_POST['ISBN'];
    $sql1="SELECT ISBN FROM BOOKS WHERE ISBN='$ISBN'";
    $result=mysqli_query($conn,$sql1);
    $cnt=mysqli_num_rows($result);
    if($cnt==0){
      $errISBN="<p>* Entered ISBN doesn't exist in database.<br></p>";
    }
    else{
      $_SESSION['curr_ISBN']=$ISBN;
      header("location:AdminStockDisplay.php");
    }
  }

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
	<title>View Stock</title>
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
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <br>
        <div class="container-fluid bg-light mb-1" style="text-align: center;"><h4>View Product Details</h4></div>
        <br>
        <br>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label for="ISBN">ISBN</label>
            <input type="text" class="form-control" id="ISBN" name="ISBN">
            <!--<small id="ISBN" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
          </div>
          <br>
          <!--<div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>-->
          <button type="submit" class="btn btn-primary">Submit</button>
          <br>
          <br>
          <br>
        </form>
      </div>
      <div class="col-sm-3"></div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>