<?php
    include("footer.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="button.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="header.css">
    <style>
        .top{
            margin-top:3%;
            margin-bottom:2%;
        }
        .top a{
            display:inline;
            font-size:20px;
            font-weight: bold;
            margin-left:28%;
            color:black;
            text-decoration:none;
        }
        hr{
            border:1px solid black;
        }
        .main{
            width:40%;
            margin-left:30%;
            margin-top:6%;
        }
        label{
            font-size:20px;
            margin-left:10%;
        }
        input[type=text],input[type=submit]{
            width:80%;
            margin-left:10%;
            font-size:20px;
            padding:8px;
            margin-top:4%;
            margin-bottom:4%;
            border:1px solid black;
        }
        .center{
            margin-top:4%;
            margin-bottom:8%;
        }
    </style>
</head>
<body>
    <div class="header">
        <div id="adm">
            <h1>ADMIN PANEL</h1>
        </div>
        <div id="but">
            <button onclick="home()"><i class="fas fa-home"></i> HOME</button>
            <button onclick="logout1()"><i class="fas fa-sign-out-alt"></i> LOGOUT</button>
        </div>
    </div>
    <div class="top">
        <a href="#" onclick="myfunction1('update')">UPDATE ITEM</a>
        <a href="#" onclick="myfunction1('delete')">DELETE ITEM</a>
    </div><hr>
    <div class="main del" id="update">
        <div class="center">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label style="padding-top:50px;">ITEM NAME :</label><br>
                <input type="text" name="uiname"><br>
                <label style="padding-top:50px;">ADD STOCK :</label><br>
                <input type="text" name="ustock"><br>
                <input type="submit" name="addStock" value="ADD STOCK" style="background-color: lightseagreen">
            </form>
        </div>
    </div>
    <div class="main del" id="delete"  style="display:none">
        <div class="center">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label style="padding-top:50px;">ITEM NAME :</label><br>
                <input type="text" name="name"><br>
                <input type="submit" name="delete" value="DELETE ITEM" style="background-color: lightseagreen">
            </form>
        </div>       
    </div>
</body>
</html>
<?php
    include("mysqlconn.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {

        $itemName = $_POST["name"];

        $query = "SELECT * FROM medicine WHERE name = '$itemName'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            $dquery = "DELETE FROM medicine WHERE name = '$itemName'";

            $deleteResult = mysqli_query($conn, $dquery);

            if ($deleteResult) {
                echo '<script>alert("Record deleted successfully!");</script>';
            } else {
                echo "<p>Unable to delete record</p>";
            }
        } else {
            echo '<script>alert("Item not found!");</script>';
        }

        mysqli_close($conn);
    }

?>

<?php
    include("mysqlconn.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addStock"])) {

        $itemName = $_POST['uiname'];

        $stock = $_POST['ustock'];

        $sql = "UPDATE medicine SET stock = stock + $stock WHERE name = '$itemName'";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>successful</script>";
        }
        $conn->close();
    }
?>