<!-- <?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: /myshop/login.php");
    exit();
}
?> -->


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "knp_project";

//create connection
$connection = new mysqli($servername, $username, $password, $database);
// $id = "";
// $stock_name = "";
// $date_of_order = "";
// $supplier_name = "";
// $supplier_number = "";
// $stock_quantity = "";



$item_name = "";
$date_of_delivery = "";
$supplier_name = "";
$supplier_number = "";
$quantity_ordered = "";
$price = "";
$payer_name = "";
$payer_number = "";
$total = "";



$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET method: show data of the client
    if (!isset($_GET["id"]) ) {
        header("location: /myshop/payment.php");
        exit;
    }
    $id = $_GET["id"];

     //read all data from the database table
     $sql = "SELECT * FROM order_stock";
     $result = $connection->query($sql);
     $row = $result->fetch_assoc();

     if (!$row) {
        header("location: /myshop/payment.php");
        exit;
     }
     $id = $row["id"];
     $stock_name = $row["stock_name"];
     $date_of_order = $row ["date_of_order"];
     $supplier_name = $row ["supplier_name"];
     $supplier_number = $row ["supplier_number"];
     $stock_quantity = $row ["stock_quantity"];
}
else {
    //POST method: update the data of the client
    $id = $_POST["id"];
    $stock_name = $_POST["stock_name"];
    $date_of_order = $_POST ["date_of_order"];
    $supplier_name = $_POST ["supplier_name"];
    $supplier_number = $_POST ["supplier_number"];
    $stock_quantity = $_POST ["stock_quantity"];
    do {
        if ( empty($id) || empty($stock_name) || empty($date_of_order) || empty($supplier_name) ||
             empty($supplier_number) || empty($stock_quantity) ) {
            $errorMessage = "all the fields are required";
            break;
        }
        // $sql = "UPDATE payment
        //     SET 
        //     item_name = '$item_name', 
        //     date_of_delivery = '$date_of_delivery', 
        //      supplier_name = '$supplier_name',
        //      supplier_number = '$supplier_number', 
        //      quantity_ordered = '$quantity_ordered', 
        //      price = '$price',
        //      payer_name = '$payer_name',
        //      payer_number = '$payer_number',
        //      total = '$total' ".
        //      "WHERE id = $id ";

        // $result = $connection->query($sql);

        $sql = "INSERT INTO payment (id, item_name, date_of_delivery, supplier_name, supplier_number, quantity_ordered, price, payer_name, payer_number, total)".
        "VALUES ('$id', $item_name', '$date_of_delivery', '$supplier_name', '$supplier_number', '$quantity_ordered', '$price', '$payer_name', '$payer_number', '$total')";
            $result = $connection->query($sql);
        

        if (!$result) {
            $errorMessage = "invalid query" . $connection->error;
            break;
        }
        $successMessage = "successfull";

        header("location: /myshop/payment.php");
        exit;
    } while (true);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<style>
            form {
            border-radius: 15px;
            border: 3px solid green;
            width: 100%;
            font-size: 20px;
            font-weight: bold;
            margin: 10px;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin-left: 50px;
            padding: 30px;
            vertical-align: top;
        }
        h4{
            color: green;
        }
        h5{
          color: red;
        }
        h4{
          color: green;
        }
        h6{
          color: green;
        }
        h2{
          font-size: 20px;
        }
        #button{
          background: green;
          padding: 7px;
          color: white;
          font-size: 20px;
          font-weight: 500;
          margin-left: 47%;
        }
        #total{
          border: 0px;
          font-weight: bolder;
          font-size: 30px;
          color: green;
          text-decoration: underline;
        }
        #ttl{
          border: 0px;
          font-weight: bolder;
          color: green;
          font-size: 30px;
          text-decoration: underline;
        }
</style>
<body>
<nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Stock Management System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Menu</h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-center">
              <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/myshop/dashboard.php">Back To Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/myshop/add_new_stock.php">Add new</a>
                </li>

                <li class="nav-item">
                      <a class="nav-link" href="/myshop/index.php">View Stock</a>
                </li>
                                          
                <li class="nav-item">
                         <a class="nav-link" href="/myshop/order_stock.php">Order Stock</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Orders
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/myshop/view_orders_made.php">View Orders Made</a></li>
                      <li><a class="dropdown-item" href="/myshop/view_cleared_orders.php">View Cleared Orders</a></li>
                    </ul>
                  </li>
                        <hr>

                        <li class="nav-item">
                         <a class="nav-link" href="/myshop/reports.php">logout</a>
                </li>

                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Reports
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/myshop/stock_report.php">Stock Report</a></li>
                      <li><a class="dropdown-item" href="/myshop/order_report.php">Orders Report</a></li>
                    </ul>
                    <li class="nav-item">
                         <a class="nav-link" href="/myshop/logout.php">logout</a>
                </li>
                  </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
      <br>


      <section class="row">
            <div class="col-md-8" style="margin-left: 15%;">
            <div class="container my-5">
    <br>
    <?php
    if ( !empty($errorMessage) ) {
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class ='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>
        ";
    }
    ?>
            <!-- displaying success message -->
            <?php
        if ( !empty($successMessage) ) {
            echo "
            <div class='row mb-3>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show role='alert'>
                        <strong>$successMessage</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'>
                        </button>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    <form method="post">
    <center><h1><u>STOCK PAYMENTS:</u></h1></center>
    <br>
    <!-- <center> -->
    <center><h4><u>DETAILS OF THE SUPPLIER:</u></h4></center>
    <br>
    <input type="hidden" name="id" value="<?php echo $id;?>">

    <label class="col-sm-3 col-form-label">Item Name : </label>
            <input style="margin-left: -9%;" type="text" id="stock_name" name="stock_name"  readonly value="<?php echo $stock_name;?>">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <label class="col-sm-3 col-form-label">Date Of Delivery : </label>
            <input style="margin-left: -9%;" type="date" id="date_of_order" name="date_of_order" readonly value="<?php echo $date_of_order;?>">
            <br><br>

        <label class="col-sm-3 col-form-label">Supplier Name : </label>
            <input style="margin-left: -9%;" type="text" id="supplier_name" name="supplier_name" readonly value="<?php echo $supplier_name;?>">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <label class="col-sm-3 col-form-label">Supplier Number : </label>
            <input style="margin-left: -9%;" type="number" id="supplier_number" name="supplier_number" readonly value="<?php echo $supplier_number;?>">
            <br><br>


        <label class="col-sm-3 col-form-label">Quantity Ordered : </label>
            <input style="margin-left: -9%;" type="number" id="quantity" name="stock_quantity" readonly value="<?php echo $stock_quantity;?>" oninput="calculateTotal()">
            <br><br>


        <center><h4><u>DETAILS OF ONE PAYING FOR THE ITEMS:</u></h4></center>
        <br>  
        <label class="col-sm-3 col-form-label">Name Of One To Pay : </label>
            <input style="margin-left: -6%;" type="text" id="payer_name" name="payer_name">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <label class="col-sm-3 col-form-label">Number Of One To Pay : </label>
            <input style="margin-left: -4%;" type="number" id="payer_number" name="payer_number">
            <br><br>

            <label class="col-sm-3 col-form-label">price per item : </label>
            <input style="margin-left: -6%;" type="number" id="price" name="price" oninput="calculateTotal()">
            <br><br>


        <label style="margin-left: 40%;" class="col-sm-3 col-form-label" id="ttl"><b>TOTAL COST : </b></label>
            <input style="margin-left: -6%;" type="number" id="total" name="total" readonly  oninput="calculateTotal()">
            <br><br>

        <input type="submit" id="button" name="button" value="MAKE PAYMENTS" class="btn btn-success">
    <!-- </center> -->
        </form>
    </div>
        </div>

        <!-- <div class="col-md-4" style="margin-left: -17%; ">
        <br><br><br><br>
        <center><img src="images/logo2.png" width="30%" alt=""></center>
        <h1>Make Instant Payments</h1>
            <p style="font-size: 30px;">Lorem ipsum dolor sit amet Lorem Lorem consectetur adipisicing elit. Libero esse exercitationem labore minus eos. Velit, laudantium pariatur fugiat fuga minima, doloremque aliquam perspiciatis quaerat maxime minus quos dolorum architecto quasi.</p>
            <img src="images/c.jpg" width="100%" height="550px" alt="">
        </div> -->
      </section>


    <script>
        function calculateTotal() {
            var quantity = parseFloat(document.getElementById("quantity").value) || 0;
            var price = parseInt(document.getElementById("price").value) || 0;

            var total = quantity * price;

            document.getElementById("total").value = total.toFixed(2);
        }
    </script>
</body>
</html>