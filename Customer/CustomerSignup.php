<?php
  $error="";
  $Successmsg="";
  include("../config.php");
  session_start();
  if(($_SERVER["REQUEST_METHOD"] == "POST")){
    $Email=$_POST['EmailId'];
    $FName=$_POST['FName'];
    $LName=$_POST['LName'];
    $Mob=$_POST['Mobile'];
    $Address=$_POST['Address'];
    $Pass=$_POST['Password'];
    $sql1="SELECT EmailId FROM CUSTOMER WHERE EmailId= Binary '$Email'";
    $res=mysqli_query($conn,$sql1);
    $cnt=mysqli_num_rows($res);
    if($cnt==1){
      $error="<p>* Email already exists.<br></p>";
    }
    else{
      $sql="INSERT INTO CUSTOMER VALUES ('$Email','$FName','$LName','$Address',$Mob,'$Pass')";
      if(mysqli_query($conn,$sql)){
        $_SESSION['Cust']=$Email;
        header("location:CustomerHome.php");
      }
      else{
        $Successmsg="<p>* Sign up was unsuccessful.<br></p>";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<div class="container-fluid" >
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark ">
      <a class="navbar-brand mx-auto" href="CustomerSignup.php" style="font-size: 30px" >E-Book Store</a>
    </nav>
	</div>
	<hr>
	<div class="container-fluid bg-light mb-1" style="text-align: center;"><h4>Sign Up</h4></div>
  <br>
	<div class="container-fluid pb-5" >
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
            <label for="First Name">First Name</label>
            <input type="text" class="form-control" id="FName" name="FName" required>
          </div>
          <div class="form-group">
            <label for="Last Name">Last Name</label>
            <input type="text" class="form-control" id="LName" name="LName">
          </div>
          <div class="form-group">
            <label for="Password">Password</label>
            <input type="password" class="form-control" id="Password" name="Password" required>
          </div>
          <div class="form-group">
            <label for="Mobile">Mobile No.</label>
            <input type="number" min="1000000000" max="9999999999" class="form-control" id="Mobile" name="Mobile" required>
          </div>
          <div class="form-group">
            <label for="Add">Address</label>
            <input type="text" class="form-control" id="Address" name="Address">
          </div>
          <!--<div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>-->
          <div style="color: red; font-size: 15px;">
            <?php echo $error; echo $Successmsg; ?>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="col-sm-4"></div>
    </div>
</body>
</html>