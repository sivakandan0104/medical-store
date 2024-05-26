<?php
    include("footer.php");

    include("mysqlconn.php");

    if(isset($_COOKIE['user_id'])) {
        $username = $_COOKIE['user_id'];

        $sql = "SELECT * FROM user WHERE username = '$username'";
        
        $result = mysqli_query($conn, $sql);

        if ($result && $row = mysqli_fetch_assoc($result)) {
            $name = $row['username']; 
            $email = $row['email'];
            $age = $row['age']; 
            $gender = $row['gender']; 
            $phone = $row['phone_number']; 
            $address = $row['address'];
        }
    }
    else {
        echo "<script>alert(Please Login.);</script>";
    }
    mysqli_close($conn);
?>
<?php
    include("mysqlconn.php");

    $orders = [];

    $username = $_COOKIE['user_id'];

    if (isset($_POST['osearch'])) {

        $date = $_POST['odate'];

        $sql = "SELECT * FROM orders WHERE order_date = '$date' AND customer_name = '$username' LIMIT 10";

        $result = mysqli_query($conn, $sql);

    } else {

        $sql = "SELECT * FROM orders WHERE customer_name = '$username'";

        $result = mysqli_query($conn, $sql);
    }
    if(mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = array(
                "name" => $row['item_name'],
                "amount" => $row['amount'],
                "status" => $row['status'],
                "category" => $row['category']
            );
        }
    }
    else{
        echo "<script>alert(NO ORDERS PLACED IN THAT DAY !);</script>";
    }
    
    mysqli_close($conn);
?>