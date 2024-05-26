<?php
    include("footer.php");
?>
<?php
    include("mysqlconn.php");

    $sql = "SELECT * FROM user";
    $result = mysqli_query($conn, $sql);

    $counter = 1;

    $customers = array();

    $user = $age = $gen = $phone = '';

    while ($row = mysqli_fetch_assoc($result)) {
        $user = ucfirst($row['username']);
        $age = $row['age'];
        $gen = $row['gender'];
        $phone = $row['phone_number'];

        $customers[] = array(
            "user" => $user,
            "age" => $age,
            "gen" => $gen,
            "phone" => $phone, 
        );
    }

    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="header.css">
    <script src="button.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
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
        <h2>CUSTOMERS LIST</h2>
        <hr style="border:1px solid black">
            <table>
                <tr>
                    <th>NO</th>
                    <th>USER NAME</th>
                    <th>AGE</th>
                    <th>GENDER</th>
                    <th>PHONE</th>
                </tr>
                <?php foreach ($customers as $counter => $customer): ?>
                    <tr>
                        <td><?php echo $counter + 1; ?></td>
                        <td><?php echo $customer['user']; ?></td>
                        <td><?php echo $customer['age']; ?></td>
                        <td><?php echo $customer['gen']; ?></td>
                        <td><?php echo $customer['phone']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
    </div>
</body>
</html>

