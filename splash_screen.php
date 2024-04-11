<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location: /myshop/dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #fff;
            text-align: center;
        }
        .sc1{
           position: relative;
           top: 0;
           left: 0;
           width: 100%;
           background: rgba(0, 0, 0, 0.7);
           display: flex;
           justify-content: center;
           align-items: center;
        }
        .sc2{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            text-align: center;
        }
        .simg{
            width: 115em;
            height: 760px;
        }
        h1{
            font-size: 70px;
            color: blue;
            margin: 10px 0;
        }
        p{
            font-size: 18px;
            margin: 10px 0;
        }
        .sc1{
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn{
            0%{
                opacity: 0;
            }
            100%{
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="sc1">
        <img src="images/img4.jpg" alt="" class="simg">
        <div class="sc2">
        <h1>Welcome To Our Stock <span style="color: blue;">Management System....</span></h1>
        </div>
    </div>
    <?php
    header("refresh:3;url=dashboard.php");
    ?>
</body>
</html>