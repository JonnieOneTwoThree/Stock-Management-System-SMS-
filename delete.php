<?php
if ( isset($_GET["id"]) ) {
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "knp_project";

    //create connection
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM add_new_stock WHERE id=$id";
    $connection->query($sql);
}

header("location: /myshop/index.php");
exit;
?>