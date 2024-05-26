
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            background-image: url("images/medical1.jpg");
        }
        .main{
            width: 20%;
            height:auto;
            margin-left:30%;
            margin-top:8%;
            border:1px solid black;
        }
        h2{
            margin-top:4%;
            font-size:50px;
            color:black;
            text-align: center;
        }
        label{
            font-size:24px;
            margin-left:10%;
        }
        input{
            font-size:18px;
            padding:8px;
            margin-left:10%;
            width:75%;
        }
        input[type=submit]{
            width:80%;
            background-color: lightseagreen;
            color:azure;
            border:1px solid black;
        }
        p{
            font-size:20px;
        }
        h1{
            color:black;
        }
        body{
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <h2>THULASI MEDICAL</h2>
    <div class="main">
        <center><h1>USER LOGIN</h1></center><hr>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>username :</label><br><br>
            <input type="text" name="uname"><br><br>
            <label>password :</label><br><br>
            <input type="password" name="upword"><br><br><br>
            <input type="submit" name="enter" value="LOGIN"><br>
        </form><br>
        <center><p>Don't Have An Account ?<a href="userreg.php"> signup</a></p></center>
    </div>
</body>
</html>
<?php
    include("mysqlconn.php");

    if (isset($_COOKIE['user_id'])) {
        header('location: main.php');
        exit();
    }
    else{
        if (isset($_POST["enter"])) {

            $name = $_POST["uname"];
            $password = $_POST["upword"];
    
            $sql = "SELECT * FROM user WHERE username = '$name'";

            $result = mysqli_query($conn,$sql);
    
            if ($result && $row = mysqli_fetch_assoc($result)) {
                $storedHashedPassword = $row['password'];
    
                if(password_verify($password, $storedHashedPassword)){
                    setcookie('user_id', $name, time() + 86400 * 30, '/');
                    header('location: main.php');
                    exit(); 
                } 
                else{
                    echo "<script> alert ('password is incorrect'); </script>";
                }
            }
        }
    }

    mysqli_close($conn);
?>

