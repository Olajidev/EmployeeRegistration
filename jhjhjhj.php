<?php
       include_once('connect.php');
       $sql = "SELECT emp_id, first_name, last_name, email, contact_no FROM employee";
       $result = $conn-> query ($sql);
       if ($result-> num_rows > 0) {
    	   while ($row = $result -> fetch_assoc()) {
    		echo "<tr><td>".$row["emp_id"]."</td><td>". $row["first_name"]."</td><td>".$row["last_name"]."</td><td>".$row["email"]."</td><td>".$row["contact_no"]."</td></tr>";
    	   }
    	   echo "</table>";
       }else{
    	echo "No record found";
       }
       $conn->close();
       ?>



<?php
function valid($emp_id, $first_name, $last_name, $email, $contact_no, $error)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Edit Records</title>
</head>
<body>
<?php

if ($error != '')
{
echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
}
?>

<form action="" method="post">
<input type="hidden" name="emp_id" value="<?php echo $emp_id; ?>"/>

<table border="1">
<tr>
<td colspan="2"><b><font color='Red'>Edit Records </font></b></td>
</tr>
<tr>
<td width="179"><b><font color='#663300'>First Name<em>*</em></font></b></td>
<td><label>
<input type="text" name="first_name" value="<?php echo $first_name; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='#663300'>Last Name<em>*</em></font></b></td>
<td><label>
<input type="text" name="last_name" value="<?php echo $last_name; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='#663300'>Email<em>*</em></font></b></td>
<td><label>
<input type="text" name="email" value="<?php echo $email; ?>" />
</label></td>
</tr>

<tr>
<td width="179"><b><font color='#663300'>Contact Number<em>*</em></font></b></td>
<td><label>
<input type="text" name="contact_no" value="<?php echo $contact_no; ?>" />
</label></td>
</tr>

<tr align="Right">
<td colspan="2"><label>
<input type="submit" name="update_submit" value="Edit Records">
</label></td>
</tr>
</table>
</form>
</body>
</html>
<?php
}
include('connect.php');

if (isset($_POST['update_submit']))
{

if (is_numeric($_POST['emp_id']))
{

$emp_id = $_POST['emp_id'];
$first_name = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
$last_name = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
$contact_no = mysql_real_escape_string(htmlspecialchars($_POST['contact_no']));


if ($first_name == '' || $last_name == '' || $email == '' || $contact_no == '')
{

$error = 'ERROR: Please fill in all required fields!';


valid($emp_id, $first_name,$last_name, $email, $error);
}
else
{

mysql_query("UPDATE employee SET first_name='$first_name', last_name='$last_name', email='$email', contact_no=$contact_no WHERE emp_id='$emp_id'")
or die(mysql_error());

header("Location: display.php");
}
}
else
{

echo 'Error!';
}
}
else

{

if (isset($_GET['emp-id']) && is_numeric($_GET['emp_id']) && $_GET['emp_id'] > 0)
{

$emp_id = $_GET['emp_id'];
$result = mysql_query("SELECT * FROM employee WHERE emp_id=$emp_id")
or die(mysql_error());
$row = mysql_fetch_array($result);

if($row)
{

$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$contact_no= $row['contact_no'];

valid($emp_id, $first_name,$last_name, $email, $contact_no,'');
}
else
{
echo "No results!";
}
}
else
{
echo 'Error!';
}
}
?>

<input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
                <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>"><br>
                <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>"><br>
                <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
                <input type="phone" name="contact_no" value="<?php echo $row['contact_no']; ?>"><br>

                <input type="submit" value="Update Record">

                <form action="" method="GET">
    <input type="text" name="search_value" placeholder="Search...">
    <button type="submit">Search</button>
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
<?php
include_once("connect.php");
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Search value
$search_value = "";

// SQL query
$sql = "SELECT * FROM employee WHERE first_name = '$search_value'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Record(s) found
    while ($row = $result->fetch_assoc()) {
        
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

} else {
    echo 'no record found';
}

// Close the database connection
$conn->close();
?>
