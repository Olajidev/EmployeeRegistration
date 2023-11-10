<?php 

    // initialize session and validate authentication

    session_start();
    if (!isset($_SESSION['authenticate'])) {
        echo "<h2 style='color:red;text-align:center;'>Access Denied. Redirecting....<h2>";
        header("refresh:3;url=./index.php");
        die();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="UTF-8">
  <title>Employees</title>
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/table.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body class="">
  <div class="">
  	<div class="register">
   
    <h3><u>Employee Information Table</u></h3>
	<br>
  <form action="search.php" method="POST">
        <label for="search_term">Search</label>
        <input type="text" name="search_term" id="search_term">
        <input type="submit" name ="search" value="Search">
    </form>
  
<table>
	<tr><th >Employee ID</th> 
        <th>First Name</th> 
        <th>Last Name</th>
        
        <th>Contact</th>
        <th>E-mail</th>
        <th>Staff Address</th>
   <th>Gender</th>
   <th>Department</th>
        <th>Action</th>
	</tr>
  

  <!-- connect to database get display data from employee table -->
  <?php

  

  include_once('connect.php');
   $res=mysqli_query($conn,"SELECT* from employee ORDER by emp_id ");
			while($row=mysqli_fetch_array($res)) 
			{
				echo '<tr> 
                  <td>'.$row['emp_id'].'</td> 
                  <td>'.$row['first_name'].'</td> 
                  <td>'.$row['last_name'].'</td> 
                  <td>'.$row['contact_no'].'</td> 
                  <td>'.$row['email'].'</td> 
                  
                  
                 <td>'.$row['address'].'</td>
                 <td>'.$row['gender'].'</td>
                 <td>'.$row['department'].'</td>
                 
                  <td><a href="edit.php?emp_id='.$row['emp_id'].'"><button class="btn-primary">Edit </button></a>
                  	<br> <br>
                  	 <a href=\'delete.php?emp_id='.$row['emp_id'].'\' onClick=\'return confirm("Are you sure you want to delete?")\'"><button class="btn-primary btn_del">Delete</button></a>
                  </td> 
				</tr>';
} 


?>
</table>
      
<br><br>
 <a href="./registration.php"><button>Add new Employee</button></a>  
 <br>
 <a href="./logout.php"><button>Log Out</button></a>   
  	</div>
  </div>
</body>
</html>
