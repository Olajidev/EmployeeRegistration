
<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

    <?php
    // Connect to your database (replace with your credentials)
    include_once("connect.php");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['emp_id'])) {
        $emp_id = $_GET['emp_id'];

        // Fetch the record from the database
        $sql = "SELECT * FROM employee WHERE emp_id = $emp_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
    <body class = "align">
  
     <div class="grid align__item">
     <div class="register">
    <img class="site__logo" src="./images/logo.png" width="100" height="84">
    <h2>Edit Records</h2>
            <form action="update.php" method="post">
            <table>

            <input type="hidden" name="emp_id" value="<?php echo $row['emp_id']; ?>">
                       <tr> <td> <label>First Name</label></td>
                       	    <td> <div class="form__field"><input type="text" name="first_name" value="<?php echo $row['first_name'];?>" autocomplete="off">
                                 </div> 
                            </td> 
                       </tr>
                       <tr> <td> <label>Last Name</label></td>
                       	    <td> <div class="form__field"><input type="text" name="last_name" value="<?php echo $row['last_name'];?>"  autocomplete="off" >
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Contact Number</label></td>
                       	    <td> <div class="form__field"><input  type="phone" name="contact_no" value="<?php echo $row['contact_no'];?>" autocomplete="off" >
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Email</label></td>
                       	    <td> <div class="form__field"><input type="email" name="email" value="<?php echo $row['email'];?>" autocomplete="off">
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Staff Address</label></td>
                       	    <td> <div class="form__field"><textarea name="address" autocomplete="off"><?php echo $row['address'];?></textarea>
                           
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Gender</label></td>
                       	    <td> <div class="form__field">
        <input type="radio" name="gender" value="Male" ><label for="Male">Male</label>

        <input type="radio" name="gender" value="Female"><label for="Female">Female</label>

        <input type="radio"name="gender" value="others"><label for="others">others</label>
                                 </div> 
                            </td> 
                        </tr> 
                        <tr> <td> <label>Department</label></td>
                       	    <td> <div class="form__field"><select name="department" autocomplete = "off">
                  <option value="Software Engineering" name="department" >Software Engineering</option>
                  <option value="Computer Science" name="department" >Computer Science</option>
                  <option value="Information Technology" name="department">Information Technology</option>
         </select>

                                 </div> 
                            </td> 
                        </tr> 
                      
                </table>
                <br>
                <div>
                    <center><input type="submit" value="Update Record" ></center>
                </div>
               
            </form>
            
    </div>

              
    <?php
        } else {
            echo "Record not found.";
        }
    }
    $conn->close();
    ?>
</body>
</html>
