<?php require_once("connect.php"); 
$emp_id=$_GET['emp_id']; 
		$res=mysqli_query($conn,"SELECT* from employee WHERE emp_id=$emp_id limit 1");
if($row=mysqli_fetch_array($res)) 
{
$deletefirst_name=$row['first_name']; 
}
unlink($deletefirst_name);
$result=mysqli_query($conn,"DELETE from employee WHERE emp_id=$emp_id") ; 
if($result)
{
	 header("location:registration.php?action=deleted");
}
?>