<!-- <?php
session_start();

if (!isset($_SESSION["username"])) {
    header("location: /myshop/login.php");
    exit();
}
?> -->


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
b{
  color: green;
}
p{
  color: #f5024b;
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
        <center><h2><u>PAYMENT REPORT:</u></h2></center>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ITEM NAME</th>
                    <th>DATE OF DELIVERY</th>
                    <th>SUPPLIER NAME</th>
                    <th>SUPPLIER NUMBER</th>
                    <th>QUANTITY ORDERED</th>
                    <th>PRICE PER ITEM</th>
                    <th>PAYER NAME</th>
                    <th>PAYER NUMBER</th>
                    <th>TOTAL PRICE OF ITEMS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "knp_project";
                //creating connection to the database
                $connection = new mysqli($servername, $username, $password, $database);

                //checking connection
                if ($connection->connect_error) {
                    die("connection failed: " . $connection->connect_error);
                }

                //read all data from the database table
                $sq = "SELECT * FROM payment";
                $result = $connection->query($sq);

                if (!$result) {
                    die("invalid query: " . $connection->error);
                } 

                //read data of each row
                while($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td><b>$row[item_name]</b></td>
                        <td><p>$row[date_of_delivery]</p></td>
                        <td><p>$row[supplier_name]</p></td>
                        <td><p>$row[supplier_number]</p></td>
                        <td><p>$row[quantity_ordered]</p></td>
                        <td><p>$row[price]</p></td>
                        <td><p>$row[payer_name]</p></td>
                        <td><p>$row[payer_number]</p></td>
                        <td><b>$row[total]</b></td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>