<?php
session_start();
include("mysqlconn.php");

$Items = array();
$cat = '';
$search = '';
$amount = 0;

if(isset($_POST['cat']) && isset($_POST['search'])){
    $cat = $_POST['cat'];
    $_SESSION['cat'] = $cat;
    $search = $_POST['search'];
    $sql = "SELECT * FROM medicine WHERE category = '$cat'";
    
    $result = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $dose = $row['dose'];
            $price = $row['amount'];
            $amount += $price; 
            $image = $row['image_path'];
            $Items[] = array(
                "name" => $name,
                "dose" => $dose,
                "price" => $price,
                "image" => $image
            );
        }
    }
}

$_SESSION['items'] = $Items;
$_SESSION['amount'] = $amount;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <link rel="stylesheet" href="admin1.css">
    <script src="button.js"></script>
    <style>
        img{
            width:30px;
            height:30px;
        }
        table,th,td{    
            border:2px solid black;
            border-collapse: collapse;
        }
        table{
            margin-top:2%;
            width:70%;
            height:auto;
            margin-left:15%;
        }
        th,td{
            padding:10px;
            font-size:20px;
            text-align: center;
        }
        label{
            font-size:20px;
            margin-left:32%;
            margin-top:2%;
        }
        input{
            font-size:20px;
            padding:4px;
            margin-top:2%;
            margin-left:1%;
        }
        th{
            color:lightseagreen;
        }
        #order{
            margin-left:74%;
            background-color: lightseagreen;
            border:1px solid black;
            width:11%;
        }
    </style>
</head>
<body>
    <div class="header">
        <div id="adm">
            <h1>ITEM CATEGORY</h1>
        </div>
        <div id="but">
            <button onclick="home()"><i class="fas fa-home"></i> HOME</button>
            <button onclick="logout1()"><i class="fas fa-sign-out-alt"></i> LOGOUT</button>
        </div>
    </div>
    <div class="">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label>SEARCH BY CATEGORY :</label>
            <input type="text" name="cat" required>
            <input type="submit" name="search" value="search">
        </form>
        <table>
            <tr>
                <th>S.NO</th>
                <th>IMAGE</th>
                <th>ITEM NAME</th>
                <th>DOSE</th>
                <th>PRICE</th>
            </tr>
            <?php
            foreach ($Items as $counter => $Item) {
            echo '<tr>';
            echo '<td>'.($counter + 1).'</td>';
            echo '<td><img src="'.$Item['image'].'"></td>';
            echo '<td>'.$Item['name'].'</td>';
            echo '<td>'.$Item['dose'] .' mg'.'</td>';
            echo '<td>'.'RS. '.$Item['price'].'</td>';
            /*echo '<td>'.$Item['category'].'</td>';*/
            echo '</tr>'; 
            }  
            ?>
        </table>
        <form action="catpurchase.php" method="post">
            <input type="submit" name="pur" value="Purchase" id="order">
        </form>
    </div>
</body>
</html>



























    