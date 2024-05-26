<?php
include("mysqlconn.php");

ob_start(); 

if(isset($_POST["submit"])) {
    $uname = htmlspecialchars($_POST["fname"]);
    $email = $_POST["amail"];
    $age = $_POST["uage"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $address = $_POST["adrr"];
    $pword = password_hash($_POST["pword"], PASSWORD_DEFAULT);

    $sql = "INSERT INTO user VALUES('$uname','$email','$age','$gender','$phone','$address','$pword')";
    mysqli_query($conn, $sql);

    echo "<script>alert('registered successfully')</script>";

    header("location:userlog.php");
} else {
    //echo "<script> alert('Form not submitted'); </script>";
}

mysqli_close($conn);

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
    <style>
        body{
            background-image: url("images/medical2.jpg");
        }
        .register{
            width:40%;
            margin-left:25%;
            margin-right:30%;
            /*border:2px solid black;*/
        }
        h2{
            text-align: center;
            font-size:35px;
        }
        label{
            font-size:23px;
        }
        input{
            padding:7px;
            margin-top:15px;
            margin-bottom:15px;
            font-size:16px;
            background-color: rgb(252, 252, 252);
        }
        .middle{
            margin-left:10%;
        }
        input[type=text],input[type=email],input[type=tel],input[type=password]{
            width:81%;
        }
        input[type=number]{
            width:25%;
        }
        input[type=submit]{
            width:20%;
            border:1px solid black;
            background-color: lightgreen;
        }
        input[type=reset]{
            float:right;
            margin-right:16%;
            width:20%;
            background-color:#f69697;
            border:1px solid black;
        }
        /*hr{
            /*border:1px solid black;
        }*/
        body{
            background-color: antiquewhite;
        }
    </style>
</head>
<body>
    <div class="register">   
            <h2>USER REGISTER</h2><!--<hr>--><br>
            <div class="middle">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label for="fname">User Name :</label><br>
                    <input type="text" name="fname" id="fname" required placeholder="Enter Username..."><br>
                    <label>Email Address :</label><br>
                    <input type="email" name="amail" required placeholder="Enter Email ..."><br>
                    <label>AGE :</label><br>
                    <input type="text" name="uage" placeholder="Enter Age..."><br>
                    <label>Gender :</label> <br>
                    <input type="radio" name="gender" value="Male"><label>Male</label><br>
                    <input type="radio" name="gender" value="Female"><label>Female</label><br>
                    <label>Phone Number :</label><br>
                    <input type="text" name="phone"required placeholder="Enter Phone Number .."><br>
                    <label>Address :</label><br>
                    <input type="text" name="adrr" required placeholder="Enter Address..."><br>
                    <label>Password :</label><br>
                    <input type="password" name="pword" required placeholder="Enter Password.."><br>
                    <input type="submit" value="SUBMIT" name="submit">
                    <input type="reset" value="CLEAR FORM">
                </form>
            </div><br>
    </div>
</body>
</html>























