<?php
    session_start();
    require_once '../config/config.php';
    $conn = new mysqli(HOST, USER, PWD, DB);
    $un = $_SESSION['uname'];
    $up = $_SESSION['upass'];

    $old = $_POST['oldPass'];
    $new = $_POST['newPass'];
    
    if($old != $up) {
        echo "Incorrect Password";
    }
    
    else {
        $sql = 'UPDATE accounts SET Password=? WHERE UserName=? AND Password=?';
        $qry = $conn->prepare($sql);
        $qry->bind_param('sss', $new, $un, $up);
        if($qry->execute()) {
            echo "Success";
            session_destroy();
        }
        else {
            echo "Failed to update your account";
        }
    }
?>