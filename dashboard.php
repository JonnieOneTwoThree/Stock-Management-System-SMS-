<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: /myshop/login.php");
    exit();
}
?>

<!-- <?php
session_start();
if (!isset($_SESSION['username'])) {
  header("location: /myshop/login.php");
  exit();
}
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<style>

.animated-gradient {
  animation: animateBg 11s linear infinite;
  background-image: linear-gradient(90deg,#71c66c,#ff8000,#db5779,#37ba0d,#0f5669,#89fa4b,#e6b12a,#71c66c,#ff8000);
  background-size: 800% 100%;
}
@keyframes animateBg {
  0% { background-position: 0% 0%; }
  100% { background-position: 100% 0%; }
}
button{
    padding: 15px;
    font-size: larger;
    width: 50%;
    align-items: center;
    color: white;
    margin-left: 120px;
    border-radius: 15px;
    background: rgb(63,94,251);
    background: radial-gradient(circle, rgba(63,94,251,1) 11%, rgba(252,70,107,1) 87%);
    padding: 20px;
}
/* button :hover{
          transform: scale(1.095);
} */
/* body{
    background-image: url(/myshop/images/img1.webp);
} */
/* h1{
    margin-top: 15px; 
    margin-left: -17px; 
    background: radial-gradient(circle, rgba(63,94,251,1) 11%, rgba(252,70,107,1) 87%);
    background-size: cover;
    background-clip: text;
    -webkit-background-clip: text; 
    color: transparent; 
} */
.marquee p{
    color: white;
    animation: scroll-left 20s linear infinite;
}
</style>
</head>
<body class="animated-gradient">
<section class="row">
        <div class="col-md-3" style="margin-left: 30px;">
            <img src="images/logo2.png" width="30%" alt="">
        </div>
    <div class="col-md-8">
        <br>
        <h1><u>SCHOOL STOCK MANAGEMENT DASHBOARD.</u></h1>
    </div>
</section>
<section class="row">
  <div class="col-md-12">
  <marquee behavior="" direction="" style="color: white;">Lets Manage Our Stock And Keep The Store Up And Running</marquee>
  </div>
</section>
<section class="row">  
    <div class="col-md-7" style="margin-left: 15px;">
        <div  class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">

              <div class="carousel-item active" data-bs-interval="2000">
                <img src="images/c.jpg" width="100%" height="550px" alt="">
            </div>

              <div class="carousel-item" data-bs-interval="2000">
                <img src="images/b.webp" width="100%" height="550px" alt="">
            </div>
              
              <div class="carousel-item" data-bs-interval="2000">
                <img src="images/a.webp" width="100%" height="550px" alt="">
            </div>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>


    <div class="col-md-4" style="margin-top: 2%;">
        <button id="b1"><a class="nav-link active" href="/myshop/add_new_stock.php">Add new</a></button><br><br>
        <button id="b2"><a class="nav-link active" href="/myshop/index.php">View Stock Available</a></button><br><br>
        <button id="b3"><a class="nav-link active" href="/myshop/order_stock.php">Order Stock</a></button><br><br>
        <button id="b4"><a class="nav-link active" href="/myshop/view_orders_made.php">View Orders Made</a></button><br><br>
        <button id="b5"><a class="nav-link active" href="/myshop/view_cleared_orders.php">View Order Receipts</a></button><br><br>
        <!-- <button id="b1"><a class="nav-link active" href="">Logout</a></button><br><br> -->
        <!-- <button id="b6"><a class="nav-link active" href="/myshop/reports.php">Reports</a></button> -->
    </div>

</section>
</body>
</html>