<?php
  $user="Account";
  $errGenre="";
  $errISBN="";
  $Successmsg="";
  $errB="";
  include("../config.php");
  session_start();

  if(($_SERVER["REQUEST_METHOD"] == "POST")){
    $ISBN=$_POST['ISBN'];
    $BName=$_POST['BookName'];
    $Publisher=$_POST['Publisher'];
    $Price=$_POST['Price'];
    $Quantity=$_POST['Quantity'];
    $Discount=$_POST['Discount'];
    $Genre=$_POST['Genre'];
    $Author=$_POST['Author'];
    $Language=$_POST['Language'];
    $Year=$_POST['Year'];
    $ck=0;
    $sql1="SELECT GenreID FROM GENRES WHERE Name='$Genre'";
    $result=mysqli_query($conn,$sql1);
    $cnt=mysqli_num_rows($result);
    $GenreID=1;
    if($cnt==0){
      $ck=1;
      $errGenre="<p>* Enter a valid Genre or add the Genre in the Database.<br></p>";
    }
    else{
      $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      $GenreID=$row['GenreID'];
    }
    $sql1="SELECT ISBN FROM BOOKS WHERE ISBN='$ISBN'";
    $result=mysqli_query($conn,$sql1);
    $cnt=mysqli_num_rows($result);
    if($cnt==1){
      $errISBN="<p>* Entered ISBN already exists in the Books Database.<br></p>";
      $ck=1;
    }
    $sql1="SELECT ISBN FROM BOOKS WHERE BName='$BName'";
    $result=mysqli_query($conn,$sql1);
    $cnt=mysqli_num_rows($result);
    if($cnt==1){
      $errB="<p>* Entered Book Name already exists in the Books Database.<br></p>";
      $ck=1;
    }
    if (!(preg_match('/^[0-9]+$/', $ISBN))){
      $errISBN="<p>* Enter a valid ISBN.<br></p>";
      $ck=1;
    }
    if($ck==0){
      $sql="INSERT INTO BOOKS VALUES ('$ISBN','$BName','$Publisher',$Price,$Quantity,$Discount,$GenreID,'$Author','$Language',$Year)";
      if(mysqli_query($conn,$sql)){
        $Successmsg="<p>Data Inserted Successfully.<br></p>";
      //  header("location:AdminAddStock.php");
      }
      else{
        $Successmsg="<p>Data couldn't be Inserted.<br></p>";
      }
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
	<title>Add Stock</title>
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
  <div class="container-fluid mb-5 pb-5">
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="container-fluid bg-light mb-1" style="text-align: center;"><h4>Add New Product</h4></div>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group">
            <label for="ISBN">ISBN</label>
            <input type="text" class="form-control" id="ISBN" name="ISBN" required>
          </div>
          <div style="color: red; font-size: 15px;">
            <?php echo $errISBN; ?>
          </div>
          <div class="form-group">
            <label for="Name">Book Name</label>
            <input type="text" class="form-control" id="Name" name="BookName" required>
          </div>
          <div style="color: red; font-size: 15px;">
            <?php echo $errB; ?>
          </div>
          <div class="form-group">
            <label for="Publisher">Publisher</label>
            <input type="text" class="form-control" id="Publisher" name="Publisher">
          </div>
          <div class="form-group">
            <label for="Price">Original Price</label>
            <input type="number" class="form-control" id="Price" name="Price" required>
          </div>
          <div class="form-group">
            <label for="Quantity">Available Quantity</label>
            <input type="number" class="form-control" id="Quantity" name="Quantity" required>
          </div>
          <div class="form-group">
            <label for="Discount">Discount</label>
            <input type="number" min="0" max="100" class="form-control" id="Discount" name="Discount">
          </div>
          <div class="form-group">
            <label for="Genre">Genre</label>
            <input type="text" class="form-control" id="Genre" name="Genre" required>
          </div>
          <div style="color: red; font-size: 15px;">
            <?php echo $errGenre; ?>
          </div>
          <div class="form-group">
            <label for="Author">Author Name</label>
            <input type="text" class="form-control" id="Author" name="Author">
          </div>
          <div class="form-group">
            <label for="Language">Language</label>
            <input type="text" class="form-control" id="Language" name="Language">
          </div>
          <div class="form-group">
            <label for="Year">Year Published</label>
            <input type="number" min="1000" max="9999" class="form-control" id="Year Published" name="Year">
          </div>
          <div style="color: blue; font-size: 15px;">
            <?php echo $Successmsg; ?>
          </div>
          <!--<div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
          </div>-->
          <br>
          <button type="submit" class="btn btn-primary">Submit</button>
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