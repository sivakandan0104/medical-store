<?php

    session_start();

    $_SESSION = array();

    session_destroy();

    setcookie('user_id', '', time() - 3600, '/');

    header('Location: page1.php');
    exit();

?>

