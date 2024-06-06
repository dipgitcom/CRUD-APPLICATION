<?php include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <form action="" method="POST">
            <div class="title">
                Registration Form
            </div>
            <div class="form">
            <div class="input">
                    <label>ID</label>
                    <input type="text" class="input-field" name="id" required>
                </div>
                <div class="input">
                    <label>First Name</label>
                    <input type="text" class="input-field" name="fname" required>
                </div>

                <div class="input">
                    <label>Last Name</label>
                    <input type="text" class="input-field" name="lname" required>
                </div>

                <div class="input">
                    <label>Password</label>
                    <input type="password" class="input-field" name="password" required>
                </div>

                <div class="input">
                    <label>Confirm Password</label>
                    <input type="password" class="input-field" name="conpassword" required>
                </div>
                <div class="input">
                    <label>Email Address</label>
                    <input type="text" class="input-field" name="email" required>
                </div>
                <div class="input">
                    <label>Date of Birth</label>
                    <input type="date" class="input-field" name="dob" required>
                </div>
                <div class="input">
                    <label>Gender</label>
                    <select name="gender" class="input-field" required>
                        <option value="Not Selected">Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="input">
                    <label>Address</label>
                    <textarea class="input-field" name="address"></textarea>
                </div>
                <div class="input">
                    <label>Phone Number</label>
                    <input type="text" class="input-field" name="phone" required>
                </div>
                <div class="input">
                    <label>Session</label>
                    <input type="text" class="input-field" name="session" required>
                </div>
                <div class="input">
                    <label>CGPA</label>
                    <input type="text" class="input-field" name="cgpa">
                </div>
                <div class="input terms">
                    <label class="check">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <p>Agree to terms and conditions</p>
                </div>
                <div class="input">
                    <input type="submit" value="Register" class="btn" name="register">
                </div>
                
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
if(isset($_POST['register'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pwd = $_POST['password'];
    $cpwd = $_POST['conpassword'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $session = $_POST['session'];
    $cgpa = $_POST['cgpa'];

   $query = "INSERT INTO FORM (fname, lname, password, email, dob, gender, address, phone, session, cgpa) VALUES ('$fname', '$lname', '$pwd', '$email', '$dob', '$gender', '$address', '$phone', '$session', '$cgpa')";
   $data = mysqli_query($conn, $query);

   if($data){
       echo "Inserted";
   } else {
       echo "Failed";
   }
}
?>
