<?php
    include("footer.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thulasi Medical</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="button.js"></script>
    <script>
        $(document).ready(function(){
            $('#gsearch').keyup(function(){
                var query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url: 'suggestions.php',
                        method: 'POST',
                        data: {query: query},
                        success: function(data){
                            $('#suggestions').html(data);
                        }
                    });
                } else {
                    $('#suggestions').html('');
                }
            });
            
            // Fill search bar with suggestion text when suggestion is clicked
            $(document).on('click', '.suggestion', function(){
                var suggestionText = $(this).text();
                $('#gsearch').val(suggestionText);
                $('#suggestions').html('');
            });
        });
    </script>
    <style>
        input{
            border:1px solid black;
            padding:14px;
            font-size:20px;
            display: inline-block; 
        }

        #gsearch{
            width: 70%;
            border-radius:12px;
        }

        #search {
            margin-left: 10px;
            background-color: lightseagreen;
            border: 1px solid black;
            padding: 14px;
            font-size: 20px;
            cursor: pointer;
            border-radius:12px;
        }

        .header{
            height:auto;
            display:flex;
            background-color:lightseagreen;
            border-bottom:1px solid black;
            position:sticky;
        }
        .a button{
            padding:15px;
            font-size:20px;
            border-radius:20px;
            border:none;
            margin-left:10px;
            background-color:lightseagreen;
            font-weight: bold;
            width:auto;
        }
        .a button:hover{
            color:white;
            background-color: lightseagreen;
        }
        .a{
            margin-top:50px;
            margin-left:42%;
        }
        img{
            width:140px;
            height:135px;
            margin-left:1%;
        }
        .container{
            width:80%;
            margin-left:10%;
            height:60%;
        }
        .container input[type=text]{
            width:60%;
            margin-left:10%;
        }
        .container p{
            font-size:20px;
        }
        .container h3{
            font-weight:bold;
            font-size:42px;
            margin-top:4%;
        }
        h1{
            font-size:40px;
            margin-top:50px;
            margin-left:20px;
        } 
        
        #suggestions {
            position: absolute;
            width: 57.5%;
            background:  #f1f1f1;
            border-right:1px solid black;
            border-left:1px solid black;
            margin-left:8%;
            border-radius:12px;
            font-size:18px;
            border-top:none;
        }
        
        .suggestion {
            cursor: pointer;
            font-size:35px;
            margin:0;
            padding:10px;
            border-radius:12px;
            border-bottom:1px solid black;
        }
        
        .suggestion:hover {
            background: #fff;
        }
        #buttons{
            width:280px;
            height:150px;
            font-size:20px;
            color:black;
            margin-top:4%;
            font-family: 'Times New Roman';
            margin-left:18%;
            font-weight: bold;
            /*background-color:lightseagreen;
            opacity:0.8;*/
        }
        a{
            text-decoration: none;
            
        }
    </style>
</head>
<body style="font-family:Arial;margin:0px;">
    <div class="header">
        <img src="images/logo.png" alt="logo">
        <h1>Thulasi Medical</h1>
        <div class="a">
            <a href="page1.php"><button><i class="fas fa-home"></i>  HOME</button></a>
            <a href="#"><button onclick="checkUser1()"><i class="fas fa-user-cog"></i>  ADMIN</button></a>
            <a href="#"><button onclick="checkUser()"><i class="fas fa-user"></i>  My Account</button></a>
            <a href="#"><button onclick="check()"><i class="fas fa-shopping-cart"></i>  MY CART</button></a>
        </div>
    </div>
    <div class="container">
        <center><h3>Search For The Product :</h3><br>
            <form action="content.php" method="post">
                <div style="display: flex; align-items: center;">
                    <input type="text" name="search_item" id="gsearch" placeholder="Search Here ..." required>
                    <input type="submit" name="search" value="SEARCH" id="search">
                </div>
                <div id="suggestions"></div>
            </form>
        </center><br>
    </div> 
    <div>
        <a href="index1.php"><button  id="buttons">CATEGORY</button></a>
    </div>
</body>
</html>
