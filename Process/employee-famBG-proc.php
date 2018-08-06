<?php
require_once 'config/config.php';
$ssurname=$_POST['ssurname'];
$sfname=$_POST['sfname'];
$smname=$_POST['smname'];
$soccu=$_POST['soccu'];
$semp=$_POST['semp'];
$spextension=$_POST['spextension'];
$sb_ad=$_POST['sb_ad'];
$stel=$_POST['stel'];
$fsurname=$_POST['fsurname'];
$ffname=$_POST['ffname'];
$flname=$_POST['flname'];
$sfextension=$_POST['sfextension'];
$mfname=$_POST['mfname'];
$msurname=$_POST['msurname'];
$mlastname=$_POST['mlastname'];
$smextension=$_POST['smextension'];
$child_fullname=$_POST['child_fullname'];
$child_dob=$_POST['child_dob'];
$row=0;
$sqlSelect="select recID from tblpersonalinfo order by recID desc";
$query = $theConnection->prepare($sqlSelect);
$query->bind_result($record_id);
$query->execute();
$query->fetch();
$query->close();
$sql = "INSERT INTO tblfambg (empID, cSSurname, cSFname, cSMame, cOccupation, cEmployer, cBusinessAddress, cFTelNo, cFSurname, cFFirstname, cFMiddlename, cMSurname, cMFirstname, cMMiddlename, spXtName, sfXtName, smXtName) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
$query = $theConnection->prepare($sql);
$query->bind_param('issssssssssssssss',$record_id,$ssurname,$sfname,$smname,$soccu,$semp,$sb_ad,$stel,$fsurname,$ffname,$flname,$msurname,$mfname,$mlastname,$spextension,$sfextension,$smextension);
if($query->execute()){
    echo 'Success!';
}
else{
    echo 'Failed!';
}
$query->close();
$sqlChild= "insert into tblchildren values (?,?,?)";
$query = $theConnection->prepare($sqlChild);
foreach($child_fullname as $cfn){
    $query->bind_param('iss',$record_id,$cfn,$child_dob[$row]);
    $query->execute();
    $row++;
}
?>