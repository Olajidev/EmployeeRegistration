<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="./style/table.css">
</head>
<body class="">
  <div class="">
  	<div class="register">
   
    <h3><u>Search Result</u></h3>
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
  

<?php
// Connect to your MySQL database
include_once("connect.php");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['search'])){

// Get the search term from the form
$search_term = $_POST['search_term'];

// Query the database
$sql = "SELECT * FROM employee WHERE first_name LIKE '%$search_term%' OR
last_name LIKE '%$search_term%' OR
contact_no LIKE '%$search_term%' OR
email LIKE '%$search_term%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display the results
   // echo "<h2>Search Results:</h2>";
    while ($row = $result->fetch_assoc()) {

        
      
        echo ' <tr> 
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
} else {
    echo "No results found for the search term: " . $search_term;
}
}
// Close the database connection
$conn->close();
?>
</table>
<a href="./display.php"><button >Display</button></a> 
                <br>
              <a href="./logout.php"><button>Log Out</button></a> 