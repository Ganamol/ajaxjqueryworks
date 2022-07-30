<?php
include "connection.php";
$dep_id=$_POST['dep']; 

$result=mysqli_query($con,"SELECT * FROM `employ` WHERE d_id='$dep_id'");
$list = array();
if(mysqli_num_rows($result)) {
    while($row = mysqli_fetch_assoc($result))
    {
        $data   = array(
            'id'                      => $row['e_id'],
            'name'                    => $row['e_name'],
            ); 
        array_push($list,$data);
    }
 }
echo json_encode($list);

