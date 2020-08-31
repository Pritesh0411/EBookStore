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
    $curr_genre=$_POST['GenreID'];
    $sql1="SELECT Name FROM GENRES WHERE GenreID='$curr_genre'";
    $res1=mysqli_query($conn,$sql1);
    $GenreRow=mysqli_fetch_array($res1,MYSQLI_ASSOC);
    $curr_gname=$GenreRow['Name'];
  }
  $user=$_SESSION['Cust'];
  $ses="SELECT FirstName,LastName FROM CUSTOMER WHERE EmailId='$user'";
  $session=mysqli_query($conn,$ses);
  $userrow=mysqli_fetch_array($session,MYSQLI_ASSOC);
  $Fname=$userrow['FirstName'];
  $LName=$userrow['LastName'];
  $sql="SELECT * FROM GENRES";
  $result=mysqli_query($conn,$sql);
  $cnt=mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>EBookStore</title>
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
  
  <div class="container-fluid" style="margin-top: 0px">
    <div class="row">
      <div class="col-sm-2">
        <div class="list-group list-group-flush" style="text-align: center;">
          <a href="CustomerHome.php" class="list-group-item list-group-item-action bg-secondary text-white">Home</a>
        </div>
        <hr>
        <div class="form-group">
        <?php
          for($i=0;$i<$cnt;$i++){
          $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
          if($row['GenreID']==$curr_genre){
        ?>
          <form method="POST" action="CustomerBooks.php">
            <input type="hidden" name="GenreID" id="GenreID" value="<?php echo $row['GenreID'];?>" >
            <input type="submit" class="btn btn-dark btn-lg btn-block" value="<?php echo $row['Name'];?>" name="Name" id="GenreName" style="margin-bottom: 7px;">
          </form>
        <?php
          }
          else{
        ?>
          <form method="POST" action="CustomerBooks.php">
            <input type="hidden" name="GenreID" id="GenreID" value="<?php echo $row['GenreID'];?>" >
            <input type="submit" class="btn btn-light btn-lg btn-block" value="<?php echo $row['Name'];?>" name="Name" id="GenreName" style="margin-bottom: 7px;">
          </form>
        <?php
          }
          }
        ?>
        </div>
      </div>
      
      <div class="col-sm-10">
        <div class="container-fluid bg-light mb-1" style="text-align: center; padding-top: 5px; padding-bottom: 5px;"><h4><?php echo $curr_gname ;?></h4></div>
        <hr>
        <?php
          $sql="SELECT A.* 
                FROM BOOKS as A 
                LEFT JOIN ORDERS as B ON A.ISBN = B.ISBN
                WHERE A.GenreID=$curr_genre 
                GROUP BY A.ISBN ORDER BY SUM(B.Quantity) DESC";
          $res=mysqli_query($conn,$sql);
          $cnt1=mysqli_num_rows($res);
        ?>
          
        <div class="row row-cols-1 row-cols-md-3">
          <?php
            for($j=0;$j<$cnt1;$j++){
              $rowB=mysqli_fetch_array($res,MYSQLI_ASSOC);
              $ISBN=$rowB['ISBN'];
              $sql1="SELECT * FROM BOOKS WHERE ISBN='$ISBN'";
              $res1=mysqli_query($conn,$sql1);
              $brow=mysqli_fetch_array($res1,MYSQLI_ASSOC);
              $currISBN=$brow['ISBN'];
              $avl=$brow['Availability'];
              $sqlwishck="SELECT WishId FROM WISHLIST WHERE ISBN='$currISBN' AND EmailId='$user'";
              $sqlckres1=mysqli_query($conn,$sqlwishck);
              $ckrow=mysqli_num_rows($sqlckres1);
              $sqlcartck="SELECT CartId FROM CART WHERE ISBN='$currISBN' AND EmailId='$user'";
              $sqlckres2=mysqli_query($conn,$sqlcartck);
              $crtrow=mysqli_num_rows($sqlckres2);
          ?>
            <div class="col mb-4">
              <form action="CustViewBook.php" method="POST" id="<?php echo 'f'.$ISBN; ?>" name="<?php echo 'f'.$ISBN; ?>" target="_blank">
                <input type="hidden" name="ISBN" value="<?php echo $ISBN; ?>">
                <input type="submit" style="display: none;" name="">
              </form>
              <form method="POST" action="CustBuy.php" id="<?php echo 'b'.$ISBN; ?>">
                <input type="hidden" name="ISBN" value="<?php echo $ISBN;?>">
                <input style="display: none;" type="submit" name="">
              </form>
              <a href="javascript:;" class="bookcard" data-isbn="<?php echo $ISBN;?>" style="text-decoration: none; color: black;">
                <div class="card mb-3 bg-light h-100">
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTkWfK3gEYrKGZp0fGDNyhSY_ZjGWYyDZQsHw&usqp=CAU" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $brow['BName']; ?></h5>
                    <p class="card-text"><?php echo 'Rs.'.$brow['Price']; ?></p>
                    <?php
                      if($avl==0){
                    ?>
                      <a style="color: red;">OUT OF STOCK</a>
                    <?php
                      }
                      else{
                    ?>
                      <a href="javascript:;" class="buynow btn btn-primary" data-isbn="<?php echo $ISBN;?>">Buy Now</a>
                    <?php
                      }
                    ?> &nbsp &nbsp
                    <?php
                      if($crtrow==1){
                    ?>
                      <button class="btn btn-primary removefromcart" data-isbn="<?php echo $ISBN; ?>" id="<?php echo 'c1'.$rowB['ISBN']; ?>">Remove from Cart</button>
                      <button class="btn btn-primary addtocart" data-isbn="<?php echo $ISBN; ?>" style="display: none;" id="<?php echo 'c2'.$rowB['ISBN']; ?>">Add to Cart</button>
                    <?php
                      }
                      else{
                    ?>
                      <button class="btn btn-primary removefromcart" data-isbn="<?php echo $ISBN; ?>" style="display: none;" id="<?php echo 'c1'.$rowB['ISBN']; ?>">Remove from Cart</button>
                      <button class="btn btn-primary addtocart" data-isbn="<?php echo $ISBN; ?>" id="<?php echo 'c2'.$rowB['ISBN']; ?>">Add to Cart</button>
                    <?php
                      }
                    ?>                  
                    <div class="float-right">
                      <?php 
                        if($ckrow==1){
                      ?>
                        <a href="javascript:;" id="<?php echo "r".$brow['ISBN']; ?>" class="removefromwishlist" data-isbn="<?php echo $brow['ISBN']; ?>" >
                          <i class="fa fa-heart btn" style="color: red; font-size: 25px;"></i>
                        </a>
                        <a href="javascript:;" style="display: none;" id="<?php echo "a".$brow['ISBN']; ?>" class="addtowishlist" data-isbn="<?php echo $brow['ISBN']; ?>">
                          <i class="far fa-heart btn" style="color: black; font-size: 25px;"></i>
                        </a>
                      <?php  
                        }
                        else{
                      ?>
                          <a href="javascript:;" style="display: none;" id="<?php echo "r".$brow['ISBN']; ?>" class="removefromwishlist" data-isbn="<?php echo $brow['ISBN']; ?>" >
                            <i class="fa fa-heart btn" style="color: red; font-size: 25px;"></i>
                          </a>
                          <a href="javascript:;" id="<?php echo "a".$brow['ISBN']; ?>" class="addtowishlist" data-isbn="<?php echo $brow['ISBN']; ?>">
                            <i class="far fa-heart btn" style="color: black; font-size: 25px;"></i>
                          </a>
                      <?php
                        }
                      ?>
                      
                      <!--<button class="addtowishlist btn btn-primary" data-isbn="">Add</button>-->
                    </div>
                  </div>
                </div>
              </a>
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
      $(".bookcard").click(function(){
        var ISBN=$(this).data('isbn');
        var FSub="f".concat(ISBN);
        $("#"+FSub).submit();
      });
      $(".buynow").click(function(){
        var ISBN=$(this).data('isbn');
        var FSub="b".concat(ISBN);
        $("#"+FSub).submit();
      });
    });
  </script>
  
  
</body>
</html>