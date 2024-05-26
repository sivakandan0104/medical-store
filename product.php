<?php
    include("footer.php");
?>
<?php
     include("mysqlconn.php");

     $productlists = [];
 
     if (isset($_POST["search"])) {
 
         $cat = $_POST["cat"];
 
         $sql = "SELECT * FROM medicine WHERE category = '$cat'";
 
         $result = mysqli_query($conn,$sql);

     } else {
         $sql = "SELECT * FROM medicine";
 
         $result = mysqli_query($conn, $sql);
     }
 
     while ($row = mysqli_fetch_assoc($result)) {
         $productlists[] = array(
             "name" => $row['name'],
             "amount" => $row['amount'],
             "stock" => $row['stock'],
             "category" => $row['category']
         );
     }
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
        
        .a1 form{
            font-size:22px;
            margin-top:2%;
            margin-left:30%;
        }
        .a1 input[type=text]{
            width:30%;
            font-size:22px;
        }
        .a1 input[type=submit]{
            width:10%;
            font-size:22px;
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
    <div class="main1">
        <h2>PRODUCT LIST</h2>
        <hr style="border:1px solid black">
        <div class="a1">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <label>ITEM CATEGORY :</label>
                <input type="text" name="cat">
                <input type="submit" name="search" value="Search">
            </form>
            <table>
                <tr>
                    <th>#</th>
                    <th>ITEM NAME</th>
                    <th>AMOUNT</th>
                    <th>STOCK</th>
                    <th>CATEGORY</th>
                </tr>
                <?php foreach ($productlists as $counter => $productlist):  ?>
                <tr>
                    <td><?php echo $counter + 1; ?></td>
                    <td><?php echo $productlist['name']; ?></td>
                    <td><?php echo $productlist['amount']; ?></td>
                    <td><?php echo $productlist['stock']; ?></td>
                    <td><?php echo$productlist['category']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        
    </div><br><br><br>
</body>

</html>