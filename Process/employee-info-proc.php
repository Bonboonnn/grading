<?php
require_once 'config/config.php';
$csid=$_POST['cs_id'];
$ext="";
$tmp="";
$img="";
echo $csid.'  ';
$surName=$_POST['sname'];
$firstName=$_POST['fname'];
$midName=$_POST['mname'];
$n_ext = $_POST['n_ext'];
$dob=$_POST['dob'];
$pob=$_POST['pob'];
$gender=$_POST['gender'];
$civilStat=$_POST['civil'];
if($civilStat=="Others"){
    $civilStat=$_POST['other'];
}
echo $civilStat;
$height=$_POST['height'];
$weight=$_POST['weight'];
$blood=$_POST['blood'];
$gsis=$_POST['gsis'];
$phid=$_POST['phid'];
$pgibig=$_POST['pagibig'];
$sss=$_POST['sss'];
$tin=$_POST['tin'];
$agency=$_POST['agency'];
$citizen=$_POST['citizen'];
if(isset($_POST['country']) && isset($_POST['dual'])){
    $country=$_POST['country'];
    $dual = $_POST['dual'];
    $citizen = $dual.': '."Filipino".', '.$country;
}
echo $citizen;
$rhouse_no=$_POST['rhousehold_no'];
$rstreet=$_POST['rstreet'];
$rsub=$_POST['rsub/vil'];
$rbrgy=$_POST['rbrgy'];
$rcity=$_POST['rcity'];
$rprov=$_POST['rprov'];
$rAddress = $rstreet.', '.$rsub.', '.$rbrgy.', '.$rcity.', '.$rprov;
$rzip=$_POST['rzip'];
$phouse_no=$_POST['phousehold_no'];
$pstreet=$_POST['pstreet'];
$psub=$_POST['psub/vil'];
$pbrgy=$_POST['pbrgy'];
$pcity=$_POST['pcity'];
$pprov=$_POST['pprov'];
$pAddress = $pstreet.', '.$psub.', '.$pbrgy.', '.$pcity.', '.$pprov;
$pzip=$_POST['pzip'];
$ptel=$_POST['ptelno'];
$pmobile=$_POST['pmobile'];
$pEmail=$_POST['e_mail'];
$dateNow = date('Y-m-d');
$status="Active";
$encodedBy = "Admin";
if(isset($_FILES['img']['name'])){
    $img=$_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $ext = pathinfo($img, PATHINFO_EXTENSION);
}
$sql="INSERT INTO tblpersonalinfo (csID, cSurname, cFname, cMname, cname_ext, cDOB, cSex, cStatus, cCship, cHeight, cWeight, cBType, cGSISID, cPagibigID, cPHID, cSSS, cResAdd, cRZCode, cAdd, cZCode, cTelNo, cEmail, cCPNo, cAgencyNo, cTIN, cPics, cDateEncoded, cEncodedBy, sStatus, cRHouse_no, cPHouse_no, cPOB) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
$query=$theConnection->prepare($sql);
$query->bind_param('ssssssssssssssssssssssssssssssss',$csid,$surName,$firstName,$midName,$n_ext,$dob,$gender,$civilStat,$citizen,$height,$weight,$blood,$gsis,$pgibig,$phid,$sss,$rAddress,$rzip,$pAddress,$pzip,$ptel,$pEmail,$pmobile,$agency,$tin,$ext,$dateNow,$encodedBy,$status,$rhouse_no,$phouse_no,$pob);
if($query->execute()){
    echo "Success!";
    $query->close();
    $sql = "select recID from tblpersonalinfo order by recID desc";
    $query = $theConnection->prepare($sql);
    $query->execute();
    $query->bind_result($record_id);
    $query->fetch();
    $recIMG = $record_id.".$ext";
    move_uploaded_file($tmp,'employeeImages/'.$recIMG);
}
else{
    echo "Failed";
}

?>