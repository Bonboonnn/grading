<?php
    session_start();
    require_once '../config/config.php';
    date_default_timezone_set('Asia/Manila');
    $conn = new mysqli(HOST, USER, PWD, DB);
    $app = 1;
    $act = 1;
    $sql = 'SELECT inf.*, acc.* FROM tblpersonalinfo AS inf LEFT JOIN accounts AS acc ON inf.recID = acc.recID WHERE inf.active=? AND inf.approve=?';
        $qry = $conn->prepare($sql);
    $qry->bind_param('ii', $act, $app);
        $qry->execute();
    
        $qry->bind_result($recID, $csID, $cSurname, $cFname, $cMname, $cname_ext, $cDOB, $cSex, $cStatus, $cCship, $cHeight, $cWeight, $cBType, $cGSISID, $cPagibigID, $cPHID, $cSSS, $cResAdd, $cRZCode, $cAdd, $cZCode, $cTelNo, $cEmail, $cCPNo, $cAgencyNo, $cTIN, $cPics, $cDateEncoded, $cEncodedBy, $sStatus, $cRHouse_no, $cPHouse_no, $cPOB, $approve, $active,$dept_id,$cat_id,$aca_id, $UserName, $Password, $AccountType, $sAdd, $sDelete, $sUpdate, $Print, $recid);
        $qry->store_result();
        $cnt=0;
        if($qry->num_rows() > 0) {
            while($qry->fetch()) {
                if($cPics==""){
                    $cPics="profile.jpg";
                }else{
                    $cPics="employeeImages/$recID.$cPics";
                }
                $cDOB=date('F d, Y',strtotime($cDOB));
                if(empty($UserName)) {
                    $cnt++;
                    echo '
                    <tr>
                        <td>'.$csID.'</td>
                        <td>'.$cSurname.'</td>
                        <td>'.$cFname.'</td>
                        <td>'.$cMname.'</td>
                        <td>'.$cSex.'</td>
                        <td>'.$cResAdd.'</td>
                        ';
                        if($_SESSION['add']==1){
                         echo'<td><button type="button" onclick="add_to_user('.$recID.')" class="btn btn-sm btn-primary pull-right"><i class="fa fa-user"></i>  Add User</button></td>';
                        }
                        echo "
                    </tr>";
                    
                }
                
            }
            if($cnt == 0) {
                echo '<tr><td colspan="7"><center>No Employee found</center></td></tr>';
            }
        }
        else {
            echo '<tr><td colspan="7"><center>No Employee found</center></td></tr>';
        }

?>