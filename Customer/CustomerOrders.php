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
  $ses="SELECT FirstName,LastName FROM CUSTOMER WHERE EmailId='$user'";
  $session=mysqli_query($conn,$ses);
  $userrow=mysqli_fetch_array($session,MYSQLI_ASSOC);
  $Fname=$userrow['FirstName'];
  $LName=$userrow['LastName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Orders</title>
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
  <div class="container" style="margin-top: 0px">
  	<div class="container-fluid bg-light mb-1" style="text-align: center; padding-top: 5px; padding-bottom: 5px;"><h4>My Orders</h4></div>
  	<hr>
  	<?php
  		$sql="SELECT * FROM ORDERS WHERE EmailId='$user' ORDER BY Dt DESC";
  		$res=mysqli_query($conn,$sql);
  		$cnt=mysqli_num_rows($res);
  	?>
    <div class="row">
    	<div class="col-sm-12">
    		<div class="row row-cols-1 row-cols-md-2">
    			<?php
    				for($i=0;$i<$cnt;$i++){
    					$row=mysqli_fetch_array($res);
    					$OId=$row['OrderId'];
    					$ISBN=$row['ISBN'];
    					$Price=$row['Price'];
    					$Sts=$row['Stats'];
    					$sql1="SELECT BName FROM BOOKS WHERE ISBN='$ISBN'";
    					$res2=mysqli_query($conn,$sql1);
    					$row2=mysqli_fetch_array($res2);
    					$BName=$row2['BName'];
    			?>
	    			<div class="col mb-4">
	    				<div class="card mb-3" style="max-width: 540px;">
							  <div class="row no-gutters">
							    <div class="col-md-4">
							      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTkWfK3gEYrKGZp0fGDNyhSY_ZjGWYyDZQsHw&usqp=CAU" class="card-img" alt="...">
							    </div>
							    <div class="col-md-8">
							      <div class="card-body">
							        <h5 class="card-title"><?php echo $BName;?></h5>
							        <p class="card-text">ISBN: <?php echo $ISBN;?></p>
							        <p class="card-text">Price: <?php echo $Price;?></p>
							        <?php
							        	if($Sts==1){
							        ?>
							        <p class="card-text" style="margin-bottom: 54px;"><small class="text-muted">*Book Delivered</small></p>
							        <?php
							        	}
							        	else{
							        ?>
							        <p class="card-text" id="<?php echo 'c2'.$OId;?>" style="display: none; margin-bottom: 54px;"><small class="text-muted">*Book Delivered</small></p>
							        <p class="card-text" id="<?php echo 'c3'.$OId;?>"><small class="text-muted">*Book not yet Delivered</small></p>
							        <button class="btn-primary btn delc" data-oid="<?php echo $OId;?>" id="<?php echo 'c1'.$OId;?>">Confirm Delivery</button>
							        <?php
							        	}
							        ?>
							      </div>
							    </div>
							  </div>
							</div>
    				</div>
    			<?php
						}
					?>
    		</div>
    	</div>
    </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){
      $(".delc").click(function(){
        var OId=$(this).data('oid');
        var ColChange="c1".concat(OId);
        var ColChange2="c2".concat(OId);
        var ColChange3="c3".concat(OId);
        $("#"+ColChange).css("display","none");
        $("#"+ColChange2).css("display","block");
        $("#"+ColChange3).css("display","none");
        $.ajax({
          type: "POST",
          url: "CustConfirmDel.php",
          data: {OId: OId}
        });
      });
    });
  </script>
</body>
</html>