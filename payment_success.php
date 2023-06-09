<?php
session_start();
include("functions/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>BOOKSTORE</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style/styles.css" media="all">
<body>
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
<div class="container-fluid">
    <a class="navbar-brand" href="index.php"><h1 class="display-4">BOOKSTORE</h1></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="all_books.php">All Books</a>
            </li>
             <li class="nav-item">
                <a class="nav-link">
                <?php
                    if(!isset($_SESSION['customer_email']))
                    {
                        echo "Welcome User";
                    }
                    else
                    {
                        $f=$_SESSION['customer_email'];
                        echo "Welcome:".$f;
                    }
                    
                    
                    
                    ?>
                 </a>
            </li>
            <li class="nav-item">
               <div class="dropdown">
  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Shopping Cart
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class='dropdown-item' href='cart.php'>Go to Cart</a>
         <?php
    if(!isset($_SESSION['customer_email']))
    {
        echo"<a href='checkout.php' class='dropdown-item'>Login</a>";
    }
      else
      {
          echo"<a href='logout.php' class='dropdown-item'>Logout</a>";
      }
    ?>
  </div>
            </li>
           
    
        </ul>
        <div class="dropdown">
  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Categories
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <?php
      get_catg();
      ?>
  </div>
</div>
        <form class="form-inline" method="get" enctype="multipart/form-data" action="result.php">
        <input class="form-control mr-sm-2" type="text" placeholder="search" aria-label="search" name="user_query">
            <input class="btn btn-dark my-sm-0" type="submit" name="Search" value="Search">
        </form>
    </div>
    
</div>
</nav>
<div id="slides" class="carousel slide" data-ride="carousel">
<ul class="carousel-indicators">
<li class="active" data-target="#slides" data-slide-to="0"></li>
<li  data-target="#slides" data-slide-to="1"></li>
<li  data-target="#slides" data-slide-to="2"></li>
</ul>  
    
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="pics/slide1.jpg" style="width:100%;">
            <div class="carousel-caption">
            <h1 class="display-3">Join Now</h1>
                <h3>Minimum 10% discount on every book</h3>
                <a href="customer_register.php"> <button class="btn btn-outline-light btn-lg" type="button">Sing Up</button></a>
                <a href="checkout.php"> <button class="btn btn-primary btn-lg" type="button">Log in</button></a>
            </div>
        </div>
        
       
        <div class="carousel-item">
            <img src="pics/yo.jpg" style="width:100%;">
        </div>
             
            
        <div class="carousel-item">
             <img src="pics/qwedv.jpg" style="width:100%;">
        </div>
    
    </div>

</div>
<!--jumbotron-->
<div class="container-fluid" >
<div class="row jumbotron">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" >
        <p class="lead" style="text-align:center;">
            <?php quotes(); ?>
        </p>
    </div> 
</div>
</div>
    
<!--product list-->

<div class='container-fluid bg-light'>
    <h1>Thank You for Shopping with us.</h1>
<?php
$id=getIp() ;
    $user= $_SESSION['customer_email'];
    $get_img = "select * from customer where customer_email='$user'";
				
				$run_img = mysqli_query($conn, $get_img); 
				
				$row_img = mysqli_fetch_array($run_img); 
        $c_id=$row_img['customer_id'];
   // echo $c_id;
    $r="select * from cart where ip_add='$id'";
    $run_r=mysqli_query($conn,$r);
    while($t=mysqli_fetch_array($run_r))
    {
        $bd=$t['b_id'];
       $h="insert into orders (b_id,c_id,qty,invoice_no) values ('$bd','$c_id',1,56)";
        $y=mysqli_query($conn,$h);
    }
$query="delete from cart where ip_add='$id'";
$run_query=mysqli_query($conn,$query);    
    
    ?>
    
</div>
    
    <!--footer -->
    <section class="footer bg-dark container-fluid">
    <div class="container-fluid text-center">
        <div class="row">
        <div class="col">
            <ul class="navbar-nav">
            
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
        </ul>
            </div>
        </div>
        </div>
    
    </section>
</body>
</html>
