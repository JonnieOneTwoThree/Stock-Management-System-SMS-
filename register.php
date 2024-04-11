<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "knp_project";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

$username = "";
$email  = "";
$password = "";

$errorMessage = "";
$successMessage = "";

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    $username = $_POST["username"];
    $email = $_POST ["email"];
    $password = $_POST ["password"];

    do {
        if ( empty($username) || empty($email) || empty($password) ) {
            $errorMessage = "all the fields are required";
            break;
        }

        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     array_push($errors, "email is not valid");
        // }
        // if (strlen($password)<3){
        //     array_push($errors, "password too short");
        // }
        // if ($password!==$passwordRepeat) {
        //     array_push($errors, "pass do not match");
        // }
        // if (count($errors)>0) {
        //     foreach ($errors as $error) {
        //         echo "<div class='alert alert-danger'>$error</div>";
        //     }
        // }
        

        //add new client to the database

        $sql = "INSERT INTO register (username, email, password) ".
                    "VALUES ('$username', '$email', '$password')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "invalid query: " . $connection->error;
            break;
        }


        $username = "";
        $email = "";
        $password = "";

        $successMessage = "Registration Successfully";

        // header("location: /myshop/index.php");
        // exit;

     } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <style>
        body{
    margin: 0;
    padding: 0;
    background-image: url(images/bg.jpeg);
    background-repeat: no-repeat;
    -webkit-background-size: cover;
    background-size: cover;
    font-family: Tahoma, sans-serif;
}
.form-area{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 400px;
    height: 600px;
    box-sizing: border-box;
    background: rgba(14, 2, 251, 0.336);
    padding: 40px;
    border-radius: 50px 50px 50px;
    border: 22px solid #fff;
}
h3{
    margin: 0;
    padding: 0 0 20px;
    font-weight: bold;
    color: #fff;
}
.form-area p{
    margin: 0;
    padding: 0;
    font-weight: bold;
    font-size: 20px;
    color: #fff;
}
.form-area input{
    margin-bottom: 20px;
    width: 105%;
    height: 45px;
}
::placeholder{
    color: red;
    font-size: larger;
}
.form-area select{
    margin-top: 20px;
    padding: 10px 0;
}
.form-area input[type=submit]{
    border: none;height: 40px;
    outline: none;
    color: #fff;
    font-size: 20px;
    background: tomato;
    cursor: pointer;
    border-radius: 20px;
}
.form-area a{
    color: #fff;
    font-size: 18px;
    font-weight: bold;
}
    </style>
</head>
<body>
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
    <div class="form-area">
        <center><h1>Registration:</h1></center>
        <form action="/myshop/register.php" method="post">
        <p>Your Username: </p>
            <input type="text" placeholder="Enter Your Username" id="username" name="username" required>
            <p>Your Email: </p>
            <input type="email" placeholder="Enter Your Email" id="email" name="email" required>
            <br>
            <p>Your Password: </p>
            <input type="password" placeholder="Enter Your password" id="password" name="password" required>
            <br>
            <br>
            <input type="submit" value="Register">
           &nbsp; &nbsp; &nbsp; <a href="login.php" class="for-pass">Already Registered ? Login</a>
        </form>
    </div>
</body>
</html>