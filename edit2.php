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

$id = "";
$stock_name = "";
$entry_date = "";
$supplier_name = "";
$supplier_number = "";
$stock_description = "";
$stock_quantity = "";


$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET method: show data of the client
    if (!isset($_GET["id"]) ) {
        header("location: /myshop/index.php");
        exit;
    }
    $id = $_GET["id"];

     //read all data from the database table
     $sq = "SELECT * FROM add_new_stock WHERE id=$id";
     $result = $connection->query($sq);
     $row = $result->fetch_assoc();

     if (!$row) {
        header("location: /myshop/index.php");
        exit;
     }
    //  $id = $row["id"];
     $stock_name = $row["stock_name"];
     $entry_date = $row ["entry_date"];
     $supplier_name = $row ["supplier_name"];
     $supplier_number = $row ["supplier_number"];
     $stock_description = $row ["stock_description"];
     $stock_quantity = $row ["stock_quantity"];
}
else {
    // Assuming you have the $row containing the data
    
    // Insert the data into the destination table
    $insertSql = "INSERT INTO destination_table (column1, column2, ...) VALUES ('" . $row['column1'] . "', '" . $row['column2'] . "', ...)";
    
    // Connect to the database
    $connection = new mysqli($servername, $username, $password, $database);
    
    if ($conne->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Execute the INSERT SQL statement
    if ($connection->query($insertSql) === TRUE) {
        // Data successfully inserted into the destination table
    
        // Now, delete the data from the source table
        $deleteSql = "DELETE FROM add_new_stock WHERE id = $id";
    
        // Execute the DELETE SQL statement
        if ($connection->query($deleteSql) === TRUE) {
            echo "Data moved and deleted successfully.";
        } else {
            echo "Error deleting data: " . $connection->error;
        }
    } else {
        echo "Error inserting data: " . $connection->error;
    }
    
    // Close the database connection
    $connection->close();  
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
      <br>
    <div class="container my-5">
    <center><h2><u>UPDATE STOCK:</u></h2></center>
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
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <!-- first row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">stock_name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="stock_name" value="<?php echo $stock_name;?>">
            </div>
        </div>

        <!-- second row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">entry_date</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="entry_date" value="<?php echo $entry_date;?>">
            </div>
        </div>

        <!-- third row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">supplier_name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="supplier_name" value="<?php echo $supplier_name;?>">
            </div>
        </div>

        <!-- fourth row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">supplier_number</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="supplier_number" value="<?php echo $supplier_number;?>">
            </div>
        </div>

                <!-- fift row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">stock_description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="stock_description" value="<?php echo $stock_description;?>">
            </div>
        </div>

                <!-- sixth row -->
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">stock_quantity</label>
            <div class="col-sm-6">
                <input type="number" class="form-control" name="stock_quantity" value="<?php echo $stock_quantity;?>">
            </div>
        </div>


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

        <!-- fifth row -->
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-success">Dispatch Item</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">cancel</a>
            </div>
        </div>
    </form>
    </div>
</body>
</html>