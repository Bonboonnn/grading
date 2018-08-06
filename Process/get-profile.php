<?php
    session_start();
    require_once '../pages/config/config.php';
    
    $uname = $_SESSION['uname'];
    $upass = $_SESSION['upass']; 

    $sql = "SELECT acc.*, inf.cSurname, inf.cFname, inf.cMname, inf.cname_ext, inf.cDOB, inf.cSex, inf.cEmail, inf.cCPNo, inf.cPics, inf.cPOB FROM accounts AS acc INNER JOIN tblpersonalinfo AS inf ON inf.recID = acc.recID WHERE UserName=?	AND Password=?";
    $qry = $theConnection->prepare($sql);
    $qry->bind_param('ss', $uname, $upass);
    $qry->execute();
    $qry->bind_result($UserName, $Password, $AccountType, $sAdd, $sDelete, $sUpdate, $Print, $recid, $cSurname, $cFname, $cMname, $cname_ext, $cDOB, $cSex, $cEmail, $cCPNo, $cPics, $cPOB);
    $qry->store_result();
    $qry->fetch();
    if($qry->num_rows() == 0) {
        session_destroy();
    }
   
    if($cPics==""){
        $cPics="profile.jpg";   
    }else{
         $cPics="employeeImages/$recid.$cPics";
    } 
    $qry->close();
?>



<ul class="nav navbar-nav">
    <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo $cPics; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo "$cFname $cMname $cSurname" ?></span>
        </a>
        <ul class="dropdown-menu">
            <li class="user-header">
                <img src="<?php echo $cPics; ?>" class="img-circle" alt="User Image">
                <p>
                    <?php echo "$cSurname, $cFname $cMname".$AccountType; ?>
                    <small><?php echo $cEmail; ?></small>
                </p>
            </li>
            <li class="user-body">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <a href="#">Cell No. <?php echo $cCPNo; ?></a>
                    </div>
                </div>
            </li>
            <li class="user-footer">
                <div class="pull-left">
                    <a href="#" onclick="view_profile(<?php echo $recid; ?>)" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                    <a href="../log-out.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
            </li>
        </ul>
    </li>
</ul>
    


<script>
    function view_profile(id) {
        localStorage.setItem('recID', id);
        window.location.href = 'view-info.php';
    }
</script>