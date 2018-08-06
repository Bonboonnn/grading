<?php
require_once 'config/config.php';
$elem_school_name=$_POST['elem_school_name'];
$elem_degree=$_POST['elem_degree'];
$from=$_POST['from'];
$to=$_POST['to'];
$elem_units_earned=$_POST['elem_units_earned'];
$elem_year_grad=$_POST['elem_year_grad'];
$elem_honor=$_POST['elem_honor'];
$sec_school=$_POST['sec_school'];
$sec_degree=$_POST['sec_degree'];
$sec_from=$_POST['sec_from'];
$sec_to=$_POST['sec_to'];
$sec_unit_earned=$_POST['sec_unit_earned'];
$sec_year_grad=$_POST['sec_year_grad'];
$sec_honor=$_POST['sec_honor'];
$row=0;
$sql = "select recID from tblpersonalinfo order by recID";
$query = $theConnection->prepare($sql);
$query->execute();
$query->bind_result($record_id);
$query->fetch();
$query->close();
$elementary="Elementary";
$sql= "INSERT INTO tbledubak(empID, cLevel, cSchoolName, cCourseDegree, cGraduated, cHighestLevel, cEDateFrom, cEDateTo, cScholarshipAcad) VALUES (?,?,?,?,?,?,?,?,?)";
$query = $theConnection->prepare($sql);
$query->bind_param('issssssss',$record_id,$elementary,$elem_school_name,$elem_degree,$elem_year_grad,$elem_units_earned,$from,$to,$elem_honor);
$query->execute();
$query->close();
$sec='Secondary';
$query = $theConnection->prepare($sql);
$query->bind_param('issssssss',$record_id,$sec,$sec_school,$sec_degree,$sec_year_grad,$sec_unit_earned,$sec_from,$sec_to,$sec_honor);
$query->execute();
$query->close();
$voc = "Vocational";
if(isset($_POST['voc_name_school'])){
$voc_name_school=$_POST['voc_name_school'];
$voc_degree_course=$_POST['voc_degree_course'];
$voc_from=$_POST['voc_from'];
$voc_to=$_POST['voc_to'];
$voc_units_earned=$_POST['voc_units_earned'];
$voc_year_grad=$_POST['voc_year_grad'];
$voc_honor=$_POST['voc_honor'];
$query = $theConnection->prepare($sql);
foreach($voc_name_school as $vnc){
    $query->bind_param('issssssss',$record_id,$voc,$vnc,$voc_degree_course[$row],$voc_year_grad[$row],$voc_units_earned[$row],$voc_from[$row],$voc_to[$row],$voc_honor[$row]);
    $query->execute();
    $row++;
}
$query->close();
$row=0;
}
$col="College";
if(isset($_POST['col_name_school'])){
$col_name_school=$_POST['col_name_school'];
$col_degree_course=$_POST['col_degree_course'];
$col_from=$_POST['col_from'];
$col_to=$_POST['col_to'];
$col_units_earned=$_POST['col_units_earned'];
$col_year_grad=$_POST['col_year_grad'];
$col_honor=$_POST['col_honor'];
$query = $theConnection->prepare($sql);
foreach($col_name_school as $cns){
    $query->bind_param('issssssss',$record_id,$col,$cns,$col_degree_course[$row],$col_year_grad[$row],$col_units_earned[$row],$col_from[$row],$col_to[$row],$col_honor[$row]);
    $query->execute();
    $row++;
}
$query->close();
$row=0;
}
$grad="Graduate School";
if(isset($_POST['grad_name_school'])){
$grad_name_school=$_POST['grad_name_school'];
$grad_degree_course=$_POST['grad_degree_course'];
$grad_from=$_POST['grad_from'];
$grad_to=$_POST['grad_to'];
$grad_units_earned[]=$_POST['grad_units_earned'];
$grad_year_grad[]=$_POST['grad_year_grad'];
$grad_honor=$_POST['grad_honor'];
$query = $theConnection->prepare($sql);
foreach($grad_name_school as $gns){
    $query->bind_param('issssssss',$record_id,$grad,$gns,$grad_degree_course[$row],$grad_year_grad[$row],$grad_units_earned[$row],$grad_from[$row],$grad_to[$row],$grad_honor[$row]);
    $query->execute();
    $row++;
}
$query->close();
$row=0;
}
?>
