<!DOCTYPE html>
<html>
<head>
    <title>Data Movement</title>
</head>
<body>
    <h1>Data Movement</h1>
    
    <!-- Display data from source_table -->
    <h2>Source Table</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Value</th>
        </tr>
    </table>


    <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "knp_project";
// Establish a database connection (replace with your database credentials)
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select data from source_table
$sql = "SELECT * FROM source_table";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td><a href='move_data.php?id=" . $row["ID"] . "'>Move</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data available</td></tr>";
}
$connection->close();
?>

<?php
// Establish a database connection (replace with your database credentials)
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Check if the "id" parameter is set in the URL
if (isset($_GET["id"])) {
$id = $_GET["id"];

// Select data from source_table for the specified ID
$sql = "SELECT * FROM source_table WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();

// Insert the data into target_table
$sql = "INSERT INTO target_table (name, value) VALUES ('" . $row["name"] . "', " . $row["value"] . ")";
if ($conn->query($sql) === TRUE) {
    // Data moved successfully, now delete it from source_table
    $sql = "DELETE FROM source_table WHERE id = $id";
    $conn->query($sql);
}
}
}

// Close the database connection
$connection->close();

// Redirect back to the source table page
header("Location: dispatch.php");
?>
</body>
</html>
