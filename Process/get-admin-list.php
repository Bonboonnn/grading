<?php

    require_once '../config/config.php';
    date_default_timezone_set('Asia/Manila');
    $conn = new mysqli(HOST, USER, PWD, DB);
    $app = 1;
    $act = 1;
    $accType = "superadmin";

        $sql = 'SELECT inf.*, acc.* FROM tblpersonalinfo AS inf INNER JOIN accounts AS acc ON inf.recID = acc.recID WHERE inf.active=? AND inf.approve=? AND AccountType !=?';
        $qry = $conn->prepare($sql);
    $qry->bind_param('iis', $act, $app, $accType);
        $qry->execute();
        $qry->bind_result($recID, $csID, $cSurname, $cFname, $cMname, $cname_ext, $cDOB, $cSex, $cStatus, $cCship, $cHeight, $cWeight, $cBType, $cGSISID, $cPagibigID, $cPHID, $cSSS, $cResAdd, $cRZCode, $cAdd, $cZCode, $cTelNo, $cEmail, $cCPNo, $cAgencyNo, $cTIN, $cPics, $cDateEncoded, $cEncodedBy, $sStatus, $cRHouse_no, $cPHouse_no, $cPOB, $approve, $active,$dept_id,$cat_id,$aca_id, $UserName, $Password, $AccountType, $sAdd, $sDelete, $sUpdate, $Print, $recid);
        $qry->store_result();
        if($qry->num_rows() > 0) {
            while($qry->fetch()) {
                if($cPics==""){
                    $cPics="profile.jpg";
                }else{
                    $cPics="employeeImages/$recID.$cPics";
                }
                $cDOB=date('F d, Y',strtotime($cDOB));
                
                echo '
                <tr>
                    <td>'.$csID.'</td>
                    <td>'.$cSurname.'</td>
                    <td>'.$cFname.'</td>
                    <td>'.$cMname.'</td>
                    <td>'.$cSex.'</td>
                    <td>'.$cResAdd.'</td>
                       <td><button type="button" onclick="remove_acc(\''.$UserName.'\')" class="btn btn-sm btn-warning pull-right"><i class="fa fa-times"></i>  Remove</button></td></tr>';
                
            }
        }

        else {
            echo '<tr><td colspan="7"><center>No Employee found</center></td></tr>';
        }

?>