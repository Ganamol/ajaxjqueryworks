<?php

include 'connection.php';
$flag=1;
$data=mysqli_query($con,"select * from department");
$showdata=mysqli_query($con,"SELECT department.d_name,employ.e_name,assign_table.from_date,assign_table.to_date from((assign_table INNER JOIN department ON assign_table.dep_id=department.d_id)INNER JOIN employ ON assign_table.emp_id=employ.e_id);");
// if(isset($_POST['submit']))
// {
//   $dep=$_POST['dep'];
//   $emp=$_POST['emp'];
  
//   $fromdate=$_POST['fromdate'];
//   $todate=$_POST['todate'];
//   if($dep && $emp && $fromdate && $todate!="")
//   {
//   mysqli_query($con,"INSERT INTO `assign_table`(`dep_id`, `emp_id`, `from_date`, `to_date`) VALUES ('$dep','$emp','$fromdate','$todate')");

//  }


// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
  table,th,td
  {
    border:2px solid black;
    border-collapse: collapse;
  }
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type = "text/javascript"src = "https://www.tutorialspoint.com/jquery/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <center>
    <form action="" method="POST">
      <br><br><br>
      <table>
        <tr>
          <td>
    <label for="">Department:</label></td>
  <td> <select name="dep" id="dep">
        <option value="selected">Select</option>
    <?php
while($row=mysqli_fetch_assoc($data))
{
 
?> 
  <option value="<?php echo $row['d_id'];?>"><?php echo $row['d_name'];?></option> 
<?php

}
?> 
</select></td> </tr>
<br>
<tr><td>
<label for="">select employees:</label></td>
<td><select id="emp" name="emp">
      <option value="">--Select Employee--</option>

 </select>
 <span style="color: red;" id="print"></span>
</td>
</tr>
<tr>
<td>From date</td><td><input type="date" name="fromdate" id="fromdate"></td><td>From date</td><td><input type="date" name="todate" id="todate"></td>

</tr>
<tr>

<td></td><td><button name="submit" id="submit" >Save</button></td>
</tr>
 </table>
<br> <br><br><br>
<table style="padding-left: 20%;width:80%" id="table1">
  <tr>
    <th>Employ</th>
    <th>Department</th>
    <th>From</th>
    <th>To</th>
  </tr>
  <center>
    <?php
    while($rowdata=mysqli_fetch_assoc($showdata))
    {
      ?>
      <tr>
<td><?php echo $rowdata['e_name'];?> </td>
<td><?php echo $rowdata['d_name'];?> </td>
<td><?php echo $rowdata['from_date'];?> </td>
<td><?php echo $rowdata['to_date'];?></td>
</tr>
      <?php
    }
    ?>
   
</center>
</table>


 </form>
 </center>
 <script>
$('#dep').change(function(){
           var dep_id   = $('#dep').val();
           $.ajax({
             url:'view_depempajax.php',
             method: 'post',
             data: {
              dep: dep_id},
             dataType: 'json',
             success: function(response){
                 // Remove options 
                //  $('#print').remove();
               $('#emp').find('option').not(':first').remove();
              //  Add options
               $.each(response,function(index,data){
                  $('#emp').append('<option value="'+data['id']+'">'+data['name']+'</option>');
               });
             }
          });
         });
</script>
<script>

  
$('#emp').change(function(){
 
  $('#print').empty();
           var emp_id   = $('#emp').val();
           var dep_id   =$('#dep').val();
           $.ajax({
             url:'view_depempajax1.php',
             method: 'post',
             data: {
              emp: emp_id,dep: dep_id},
             dataType: 'json',
             success: function(response){
                 // Remove options 
              //  $('#emp').find('option').not(':first').remove();
              //  Add options
               $.each(response,function(index,data){
                
                   $('#print').append(data['msg']);
               });
             }
          });
         });
</script>

<script>
    
$('#submit').click(function(){
           var emp_id =$('#emp').val();
           var dep_id =$('#dep').val();
           var from_date=$('#fromdate').val();
           var to_date=$('#todate').val();
 
           $.ajax({
             url:'view_depempajax2.php',
             method: 'post',
             data: {
              emp: emp_id,dep: dep_id,from_date: from_date,to_date: to_date},
             dataType: 'json',
             success: function(response){
                
               $.each(response,function(index,data){
                   $('#table1').append(data);
                  
               });
             }
            
          });
         
          setInterval('location.reload()', 5000); 
         });
      
</script>

</script>

</body>

</html>