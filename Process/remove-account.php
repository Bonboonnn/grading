<?php

    require_once '../config/config.php';
    $conn = new mysqli(HOST, USER, PWD, DB);
    $un = $_POST['uname'];

    $sql = 'DELETE FROM accounts WHERE UserName=?';
    $qry = $conn->prepare($sql);
    $qry->bind_param('s', $un);
    if($qry->execute()) {
        echo "Success";
    }
    else {
        echo "Failed to remove this account";
    }
?>