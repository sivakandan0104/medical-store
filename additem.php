<?php
    include("footer.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="header.css">
    <script src="button.js"></script>
    <style>
        .form {
            width: 100%;
        }

        .form label {
            font-size: 20px;
            margin-left: 25%;
        }

        .form input[type=text],
        [type=button],
        [type=file] {
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 25%;
            width: 50%;
            padding: 8px;
            font-size: 16px;
        }

        .form input[type=submit] {
            width: 50%;
            padding: 15px;
            margin-left: 25%;
            background-color: lightseagreen;
            color: white;
            border: 1px solid black;
            margin-bottom: 20px;
        }

        textarea {
            margin-left: 25%;
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
        <center>
            <h2>ENTER ITEM</h2>
        </center>
        <hr style="border:1px solid black">
        <div class="form">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <label>ITEM NAME :</label><br>
                <input type="text" name="iname"><br>
                <label>DOSE :</label><br>
                <input type="text" name="dose"><br>
                <label>AMOUNT :</label><br>
                <input type="text" name="amount"><br>
                <label>AVAILABLE STOCK :</label><br>
                <input type="text" name="stock"><br>
                <label>ITEM DESCRIPTION :</label><br><br>
                <textarea name="des" rows="10" cols="127"></textarea><br><br>
                <label>ITEM CATEGORY :</label><br>
                <input type="text" name="category"><br>
                <label>ITEM IMAGE :</label><br>
                <input type="file" name="image"><br>
                <input type="submit" name="enter" value="ENTER"><br><br><br><br>
            </form>
        </div>
</body>

</html>
<?php
include("mysqlconn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enter"])) {

    $iname = $_POST["iname"];
    $dose = mysqli_real_escape_string($conn, $_POST["dose"]);
    $amount = floatval($_POST["amount"]);
    $stock = intval($_POST["stock"]);
    $description = $_POST["des"];
    $category = mysqli_real_escape_string($conn, $_POST["category"]);

    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {

            $imagePath = $targetFile;
            $query = "INSERT INTO medicine (name, dose, amount, stock, description, category, image_path) VALUES ('$iname','$dose',$amount,$stock,'$description','$category',' $imagePath')";
            $stmt = $conn->prepare($query);

            if ($stmt->execute()) {
                echo '<script>alert("Record inserted successfully!");</script>';
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


    $conn->close();
}
?>