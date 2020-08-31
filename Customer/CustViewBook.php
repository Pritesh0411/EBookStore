<?php
	$Fname="Account";
  $LName="";
  include("../config.php");
  session_start();
  if(!isset($_SESSION['Cust'])){
    header("location:CustomerLogin.php");
    die();
  }
  if(($_SERVER["REQUEST_METHOD"] == "POST")){
    $curr_ISBN=$_POST['ISBN'];
    $sql1="SELECT * FROM BOOKS WHERE ISBN='$curr_ISBN'";
    $res1=mysqli_query($conn,$sql1);
    $ISBNRow=mysqli_fetch_array($res1,MYSQLI_ASSOC);
    $curr_bname=$ISBNRow['BName'];
    $Price=$ISBNRow['Price'];
    $Discount=$ISBNRow['Discount'];
    $GID=$ISBNRow['GenreID'];
    $Publisher=$ISBNRow['Publisher'];
    $Author=$ISBNRow['Author'];
    $Lang=$ISBNRow['Lang'];
    $Yr=$ISBNRow['Yr'];
    $ss="SELECT NAME FROM GENRES WHERE GenreID=$GID";
    $rrs=mysqli_query($conn,$ss);
    $GG=mysqli_fetch_array($rrs,MYSQLI_ASSOC);
    $Genre=$GG['NAME'];
  }
  else{
    header("location:CustomerHome.php");
  }
  $user=$_SESSION['Cust'];
  $ses="SELECT FirstName,LastName FROM CUSTOMER WHERE EmailId='$user'";
  $session=mysqli_query($conn,$ses);
  $userrow=mysqli_fetch_array($session,MYSQLI_ASSOC);
  $Fname=$userrow['FirstName'];
  $LName=$userrow['LastName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book</title>
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
  <?php
  	$sqlwishck="SELECT WishId FROM WISHLIST WHERE ISBN='$curr_ISBN' AND EmailId='$user'";
    $sqlckres1=mysqli_query($conn,$sqlwishck);
    $ckrow=mysqli_num_rows($sqlckres1);
    $sqlcartck="SELECT CartId FROM CART WHERE ISBN='$curr_ISBN' AND EmailId='$user'";
    $sqlckres2=mysqli_query($conn,$sqlcartck);
    $crtrow=mysqli_num_rows($sqlckres2);
  ?>
  <div class="container-fluid">
  	<div class="row">
  		<div class="col-sm-3">
        <center>
  			<div class="card" style="width: 18rem;">
				  <img class="card-img-top" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTkWfK3gEYrKGZp0fGDNyhSY_ZjGWYyDZQsHw&usqp=CAU" alt="Card image cap">
				  <div class="card-body">
            <div class="float-left">
				    <?php
              if($crtrow==1){
            ?>
              <button type="button" class="btn btn-primary removefromcart" data-isbn="<?php echo $curr_ISBN; ?>" id="<?php echo 'c1'.$curr_ISBN; ?>">Remove from Cart</button>
              <button type="button" class="btn btn-primary addtocart" data-isbn="<?php echo $curr_ISBN; ?>" style="display: none;" id="<?php echo 'c2'.$curr_ISBN; ?>">Add to Cart</button>
            <?php
              }
              else{
            ?>
              <button type="button" class="btn btn-primary removefromcart" data-isbn="<?php echo $curr_ISBN; ?>" style="display: none;" id="<?php echo 'c1'.$curr_ISBN; ?>">Remove from Cart</button>
              <button type="button" class="btn btn-primary addtocart" data-isbn="<?php echo $curr_ISBN; ?>" id="<?php echo 'c2'.$curr_ISBN; ?>">Add to Cart</button>
            <?php
              }
            ?>
            </div>               
            <div class="float-right">
              <?php 
                if($ckrow==1){
              ?>
                <a href="javascript:;" id="<?php echo "r".$curr_ISBN; ?>" class="removefromwishlist" data-isbn="<?php echo $curr_ISBN; ?>" >
                  <i class="fa fa-heart btn" style="color: red; font-size: 25px;"></i>
                </a>
                <a href="javascript:;" style="display: none;" id="<?php echo "a".$curr_ISBN; ?>" class="addtowishlist" data-isbn="<?php echo $curr_ISBN; ?>">
                  <i class="far fa-heart btn" style="color: black; font-size: 25px;"></i>
                </a>
              <?php  
                }
                else{
              ?>
                  <a href="javascript:;" style="display: none;" id="<?php echo "r".$curr_ISBN; ?>" class="removefromwishlist" data-isbn="<?php echo $curr_ISBN; ?>" >
                    <i class="fa fa-heart btn" style="color: red; font-size: 25px;"></i>
                  </a>
                  <a href="javascript:;" id="<?php echo "a".$curr_ISBN; ?>" class="addtowishlist" data-isbn="<?php echo $curr_ISBN; ?>">
                    <i class="far fa-heart btn" style="color: black; font-size: 25px;"></i>
                  </a>
              <?php
                }
              ?>
              
              <!--<button class="addtowishlist btn btn-primary" data-isbn="">Add</button>-->
            </div>
				  </div>
				</div>
        </center>
        <br>
        <center>
          <form method="POST" action="CustBuy.php">
            <input type="hidden" name="ISBN" value="<?php echo $curr_ISBN;?>">
            <input class="btn btn-primary" type="submit" name="submit" value="Buy Now">
          </form>
        </center>
  		</div>
  		<div class="col-sm-9">
  			<ul class="list-group list-group-flush">
          <hr>
          <center>
          <li class="list-group-item">Book Name</li>
          <li class="list-group-item"><?php echo $curr_bname; ?></li>  
          </center>       
          <hr>
          <div class="row">
            <div class="col-sm-6">
              <li class="list-group-item">Original Price</li>
              <li class="list-group-item"><?php echo $Price; ?></li>
              <hr>
              <li class="list-group-item">Discount</li>
              <li class="list-group-item"><?php echo $Discount; ?></li>
              <hr>
              <li class="list-group-item">Effective Price</li>
              <li class="list-group-item"><?php echo ($Price*(100-$Discount))/100; ?></li>
              <hr>
              <li class="list-group-item">Genre</li>
              <li class="list-group-item"><?php echo $Genre; ?></li>
              <hr>
            </div>
            <div class="col-sm-6">
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
            </div>
          </div>
          
          
        </ul>
  		</div>
  	</div>
  </div>
 	<script type="text/javascript">
 		$(document).ready(function(){
	 		$(".addtowishlist").click(function(){
        var ISBN=$(this).data('isbn');
        var ColChange="a".concat(ISBN);
        var ColChange2="r".concat(ISBN);
        $("#"+ColChange).css("display","none");
        $("#"+ColChange2).css("display","inline");
        $.ajax({
          type: "POST",
          url: "AddToWishlist.php",
          data: {ISBN: ISBN}
        });
      });
      $(".removefromwishlist").click(function(){
        var ISBN=$(this).data('isbn');
        var ColChange="r".concat(ISBN);
        var ColChange2="a".concat(ISBN);
        $("#"+ColChange).css("display","none");
        $("#"+ColChange2).css("display","inline");
        $.ajax({
          type: "POST",
          url: "RemoveFromWishlist.php",
          data: {ISBN: ISBN}
        });
      });
      $(".addtocart").click(function(){
        var ISBN=$(this).data('isbn');
        var ColChange="c2".concat(ISBN);
        var ColChange2="c1".concat(ISBN);
        $("#"+ColChange).css("display","none");
        $("#"+ColChange2).css("display","inline");
        $.ajax({
          type: "POST",
          url: "AddToCart.php",
          data: {ISBN: ISBN}
        });
      });
      $(".removefromcart").click(function(){
        var ISBN=$(this).data('isbn');
        var ColChange="c1".concat(ISBN);
        var ColChange2="c2".concat(ISBN);
        $("#"+ColChange).css("display","none");
        $("#"+ColChange2).css("display","inline");
        $.ajax({
          type: "POST",
          url: "RemoveFromCart.php",
          data: {ISBN: ISBN}
        });
      });
    });
 	</script>
</body>
</html>