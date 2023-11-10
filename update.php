
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database (replace with your credentials)
    include_once("connect.php");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $emp_id = $_POST['emp_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];
    
    $gender = $_POST['gender'];
    
    $department = $_POST['department'];
  
   


    // Update the record in the database
    $sql = "UPDATE employee SET first_name = '$first_name', last_name = '$last_name', email = '$email', contact_no = '$contact_no', address = '$address', gender = '$gender', department = '$department' WHERE emp_id = $emp_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: display.php"); // Redirect to the page that displays records
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>
