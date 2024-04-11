<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "knp_project";

//create connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("connection failed: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieve users input from the form
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //query the db to check if credentials are valid
    $sql = "SELECT * FROM register WHERE username = '$username' AND email = '$email' AND password = '$password'";
    $result = $connection->query($sql);

    if($result->num_rows ==1) {
        //athentication successfull
        session_start();
        $_SESSION['username'] = $username;
        header("location: /myshop/splash_screen.php");
        // $successMessage = "Login Successfull";
        exit();
    }else {
        $errorMessage = "Wrong Credentials... " . $connection->error;
    }
}
//close db connection
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</head>
<style>
 body{
    background-image: url(images/education-school-apple-learn-ss-1920.jpg);
    -wekit-background-size: cover;
    background-size: cover;
    background-position: center center;
}
.form-area{
    width: 500px;
    height: 700px;
    margin: 60px auto 0;
    position: relative;
    background: rgba(0,0,0,0.8);
    text-align: center;
    margin-top: 50px;
    padding: 35px;
    padding-bottom: 10px;
    border: 20px solid #fff;
    /* -webkit-border-radius:  70px 0 70px 0; */
    /* -moz-border-radius:  70px 0 70px 0; */
    border-radius: 300px 0 300px 0;
}
.form-area h2{
      margin-bottom: 45px;
      color: #fff;
}
::placeholder{
    color: tomato;
    font-size: larger;
    padding-left: 20px;
}
input{
    width: 100%;
    height: 50px;
    border-radius: 15px 0 15px 0;
    border: 2px solid #fff;
    margin-bottom: 15px;
    background-color: transparent;
    color: #fff;
}
.form-area p{
    text-align: left;
    height: fit-content;
    color: #fff;
    text-transform: uppercase;
    font-weight: bold;
}
.for-pass{
    display: block;
    margin-top: 10px;
    margin-left: -70px;
    font-size: 19px;
    color: white;
    
}
.btn{
    padding: 4%;
    color: #fff;
    font-weight: bolder;
    background-color: tomato;
    border-radius: 30px;
}
#sub1{
    background-color: red;
    font-size: large;
    font-weight: bold;
    width: 70%; 
    border-radius: 40px;
}
h2{
    font-size: 45px;
}
</style>
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
    <form method="post" action="/myshop/login.php">
        <div class="form-area">
            <div class="img-area">
                <img src="" alt="">
            </div>
            <h2><i>Login:</i></h2>
            <!-- <p>Your UserName: </p>
            <input type="text" placeholder="Enter Username"> -->
            <p>Your Username: </p>
            <input type="text" placeholder="Enter Your Username" id="username" name="username" required>
            <p>Your Email: </p>
            <input type="email" placeholder="Enter Your Email" id="email" name="email" required>
            <br>
            <p>Your Password: </p>
            <input type="password" placeholder="Enter Your password" id="password" name="password" required>
            <br>
            <input type="submit" name="login" value="LOGIN" id="sub1">
            <br>
            <a href="register.php" class="for-pass">Dont have an account? Register here ....</a>
        </div>
    </form>


    <script>
        //disable the back button on this page
        history.pushstate(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</body>
</html>