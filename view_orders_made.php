<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: /myshop/login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        /* Card container styling */
        .card {
            border-radius: 15px;
            border: 3px solid green;
            width: 30%;
            margin: 10px;
            padding: 20px;
            margin-left: 30px;
            display: inline-block;
            vertical-align: top;
            transition: transform 0.5s, background-color 0.5s, color 0.5s;
        }
        .card:hover {
            transform: scale(1.05);
            background-color: black;
            color: #fff;
            box-shadow: 5px 5px 6px 2px blue;
        }
        div {
             box-shadow: 5px 5px 6px 2px green;
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
        .button{
          background: green;
          padding: 10px;
          color: white;
          font-size: 20px;
          font-style: italic;
          font-weight: 500;
          border-radius: 20px;
        }
    </style>
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
      <br><br><br>
    <center><h1><u>LIST OF ORDERS MADE:</u></h1></center>


    <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "knp_project";

//create connection
$conn = new mysqli($servername, $username, $password, $database);

$id = "";
$stock_name = "";
$entry_date = "";
$supplier_name = "";
$supplier_number = "";
$stock_description = "";
$stock_quantity = "";


$errorMessage = "";
$successMessage = "";
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Define your SQL query
$sq = "SELECT * FROM order_stock ORDER BY date_of_order DESC";

// Execute the query
$result = $conn->query($sq);

// Check for query execution errors
if (!$result) {
    die("Query failed: " . $conn->error);
}

// Loop through the query results and display data in cards
while ($row = $result->fetch_assoc()) {
    echo '<div class="card">';
    echo '<center><h3> Item Name: ' . $row['stock_name'] . '</h3></center>';
    echo '<center><h4> Date Of Order: ' . $row['date_of_order'] . '</h4> </center>';
    echo '</br>';
    echo '<center><h5> Supplied By: ' . $row['supplier_name'] . '</h5></center>';
    echo '<center><h5> Supplier Number: ' . $row['supplier_number'] . '</h5></center>';
    echo '</br>';
    echo '<center><h2"> Quantity Ordered: ' . $row['stock_quantity'] . '</h2></center>';
    echo '</br>';
    echo '<center><a class="btn btn-outline-success" style="text-decoration: none; color: white; padding: 15px; font-weight: bold; background-color: green; font-size: 20px;" href="/myshop/payment.php?id=$row[id]" role="button">Proceed To Payment</a>' . '</center>';
    echo '</div>';
}

// Close the database connection
$conn->close();
?>
</body>
</html>
