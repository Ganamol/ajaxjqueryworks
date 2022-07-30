<?php
include "connection.php";
$emp_id=$_POST['emp']; 
$dep_id=$_POST['dep']; 
$from_date=$_POST['from_date'];
$to_date=$_POST['to_date'];
// if($dep && $emp && $fromdate && $todate!="")
//   {
    $list="";
mysqli_query($con,"INSERT INTO `assign_table`(`dep_id`, `emp_id`, `from_date`, `to_date`) VALUES ('$dep_id','$emp_id','$from_date','$to_date')");

$result=mysqli_query($con,"SELECT department.d_name,employ.e_name,assign_table.from_date,assign_table.to_date from((assign_table INNER JOIN department ON assign_table.dep_id=department.d_id)INNER JOIN employ ON assign_table.emp_id=employ.e_id)order by a_id");
$list = array();
if(mysqli_num_rows($result)) {
    while($row = mysqli_fetch_assoc($result))
    {
        $data   = array('department' =>'d_name','Employ Name'=>'e_name','fromdate'=>'from_date','to date'=>'to_date'); 
        array_push($list,$data);
    }
 }
echo json_encode($list);
//   }
//   else
//   {

//   }

