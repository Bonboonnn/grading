<?php

    require_once '../config/config.php';
    $conn = new mysqli(HOST, USER, PWD, DB);
    $un = $_POST['uname'];
    $up = $_POST['upass'];
    $acc = "admin";
    $rec = $_POST['recID'];
    $sql = 'INSERT INTO accounts VALUES(?,?,?,?,?,?,?,?)';
    $qry = $conn->prepare($sql);
    $qry->bind_param('sssiiiii', $un, $up, $acc,$_POST['add'],$_POST['del'],$_POST['upd'],$_POST['pri'],$rec);
    if($qry->execute()) {
        echo "Success";
    }
    else {
        echo " $un, $up, $acc, $rec,".$_POST['add'].",".$_POST['del'].",".$_POST['upd'].",".$_POST['pri']."";
        echo "Failed to add account, try to use different username";
    }
?>