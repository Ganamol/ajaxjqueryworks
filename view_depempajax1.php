<?php
include "connection.php";
$emp_id=$_POST['emp']; 
$dep_id=$_POST['dep']; 
$result=mysqli_query($con,"SELECT * FROM `assign_table` WHERE dep_id='$dep_id' and emp_id='$emp_id'");
$list = array();
if(mysqli_num_rows($result)) {
    while($row = mysqli_fetch_assoc($result))
    {
        $data   = array('msg' =>'already exist'); 
        array_push($list,$data);
    }
 }
echo json_encode($list);

