<?php
  $error="";
  include("../config.php");
  session_start();
  if(($_SERVER["REQUEST_METHOD"] == "POST")){
    $myusername = $_POST['AdminName'];
    $mypassword = $_POST['AdminPassword'];
    $sql="SELECT Admin_Id from Admin where Admin_Id=Binary '$myusername'and Admin_Pass=Binary '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
    if($count == 1) {
        //session_register("myusername");
        $_SESSION['curr_user'] = $myusername; 
        header("location: AdminHome.php");
    }
    else {
      $error = "<p>* Your Login-ID or Password is invalid<br></p>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<!--<script src="https://kit.fontawesome.com/a076d05399.js"></script>-->
</head>
<body>
  <div class="container-fluid" >
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
      <a class="navbar-brand mx-auto" href="AdminLogin.php" style="font-size: 30px" >E-Book Store</a>
    </nav>
  </div>
  <hr>
  <div class="container-fluid bg-light mb-1" style="text-align: center;"><h4>Admin Login</h4></div>
  <div class="container-fluid pt-5" >
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-4">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label for="Admin-ID">Admin ID</label>
            <input type="text" class="form-control" id="Admin-ID" name="AdminName" >
          <!--  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="AdminPassword">
          </div>
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
  </div>
</body>
</html>