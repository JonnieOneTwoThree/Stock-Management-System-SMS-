<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: /myshop/login.php");
    exit();
}
?>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "knp_project";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$stock_name = "";
$date_of_order = "";
$supplier_name = "";
$supplier_number = "";
$stock_quantity = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $stock_name = $_POST["stock_name"];
    $date_of_order = $_POST ["date_of_order"];
    $supplier_name = $_POST ["supplier_name"];
    $supplier_number = $_POST ["supplier_number"];
    $stock_quantity = $_POST ["stock_quantity"];

    do {
        if ( empty($stock_name) || empty($date_of_order) || empty($supplier_name) ||
             empty($supplier_number) || empty($stock_quantity) ) {
            $errorMessage = "all the fields are required";
            break;
        }
        

        //add new client to the database

        $sql = "INSERT INTO order_stock (stock_name, date_of_order, supplier_name, supplier_number, stock_quantity) ".
                    "VALUES ('$stock_name', '$date_of_order', '$supplier_name', '$supplier_number', '$stock_quantity')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "invalid query: " . $connection->error;
            break;
        }


        $stock_name = "";
        $date_of_order = "";
        $supplier_name = "";
        $supplier_number = "";
        $stock_quantity= "";

        $successMessage = "Order Made Successfully,Contact The supplier For Enquiries";

        // header("location: /myshop/index.php");
        // exit;

     } while (false);
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
                      Track Orders
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="/myshop/view_orders_made.php">View Orders Made</a></li>
                      <li><a class="dropdown-item" href="/myshop/view_cleared_orders.php">View Cleared Orders</a></li>
                    </ul>
                  </li>
                        <hr>
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
      <br><br>
    <div class="container my-5">
    <center><h2>MAKE STOCK ORDERS:</h2></center>
                <!-- displaying error message -->
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
        <!-- first row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Stock Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="stock_name" value="<?php echo $stock_name;?>">
            </div>
        </div>

        <!-- second row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Date Of Order</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="date_of_order" value="<?php echo $date_of_order;?>">
            </div>
        </div>

        <!-- third row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Supplier Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="supplier_name" value="<?php echo $supplier_name;?>">
            </div>
        </div>

        <!-- fourth row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Supplier Number</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="supplier_number" value="<?php echo $supplier_number;?>">
            </div>
        </div>


        <!-- fourth row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Stock Quantity</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="stock_quantity" value="<?php echo $stock_quantity;?>">
            </div>
        </div>



        <!-- fifth row -->
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-success">Make Orders</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>