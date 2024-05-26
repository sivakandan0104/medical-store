<?php
    include('user.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="user1.css" rel="stylesheet">
    <script src="button.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
</head>
<body>
    <div class="header">
        <div id="adm">
            <h1>USER PANEL</h1>
        </div>
        <div id="but">
            <button onclick="home()"><i class="fas fa-home"></i> HOME</button>
            <button onclick="logout()"><i class="fas fa-sign-out-alt"></i>
 LOGOUT</button>
        </div>
    </div>
    <div class="top">
        <a href="#" onclick="function1('detail')">USER DETAILS</a>
        <a href="#" onclick="function1('order')">MY ORDERS</a>
    </div><hr>
    <div class="user" id="detail">
        <div class="main">
            <div class="center">
                <p id="key">NAME : <span class="value"><?php echo $name ?></span></p>
                <p id="key">EMAIL : <span class="value"><?php echo $email ?></span></p>
                <p id="key">AGE : <span class="value"><?php echo $age ?></span></p>
                <p id="key">GENDER : <span class="value"><?php echo $gender ?></span></p>
                <p id="key">PHONE NUMBER : <span class="value"><?php echo $phone ?></span></p>
                <p id="key">ADDRESS : <span class="value"><?php echo $address ?></span></p>
            </div>  
        </div>
    </div>
    <div class="user table" id="order" style="display:none">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label>SEARCH BY DATE: </label>
            <input type="date" name="odate">
            <input type="submit" name="osearch" value="search">
        </form>

        <table>
    <tr>
        <th>NO</th>
        <th>ITEM NAME</th>
        <th>TOTAL</th>
        <th>CATEGORY</th>
        <th>STATUS</th>
    </tr>
    <?php 

    if (empty($orders)) {
        for ($i = 0; $i < 3; $i++) {
            echo '<tr>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '<td>&nbsp;</td>';
            echo '</tr>';
        }
    } else {

        foreach ($orders as $counter => $order) {
            echo '<tr>';
            echo '<td>'.($counter + 1).'</td>';
            echo '<td>'.$order['name'].'</td>';
            echo '<td>'.$order['amount'].'</td>';
            echo '<td>'.$order['category'].'</td>';
            echo '<td>'.$order['status'].'</td>';
            echo '</tr>';
        }
    }
    ?>
</table>

    </div>
</body>
</html>
