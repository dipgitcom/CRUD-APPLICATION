<?php 
include("connection.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $query = "SELECT * FROM FORM where id ='$id'";
    $data = mysqli_query($conn, $query);
    $total = mysqli_num_rows($data);
    $result = mysqli_fetch_assoc($data);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container mt-5">
        <form action="" method="POST">
            <div class="title">
                Update Student Details
            </div>
            <div class="form">
                <div class="input">
                    <label>ID</label>
                    <input type="text" value="<?php echo $result['id']; ?>" class="input-field" name="id" readonly>
                </div>
                <div class="input">
                    <label>First Name</label>
                    <input type="text" value="<?php echo $result['fname']; ?>" class="input-field" name="fname" required>
                </div>

                <div class="input">
                    <label>Last Name</label>
                    <input type="text" value="<?php echo $result['lname']; ?>" class="input-field" name="lname" required>
                </div>

                <div class="input">
                    <label>Password</label>
                    <input type="password" value="<?php echo $result['password']; ?>" class="input-field" name="password" required>
                </div>

                <div class="input">
                    <label>Confirm Password</label>
                    <input type="password" value="<?php echo $result['password']; ?>" class="input-field" name="conpassword" required>
                </div>
                <div class="input">
                    <label>Email Address</label>
                    <input type="email" value="<?php echo $result['email']; ?>" class="input-field" name="email" required>
                </div>
                <div class="input">
                    <label>Date of Birth</label>
                    <input type="date" value="<?php echo $result['dob']; ?>" class="input-field" name="dob" required>
                </div>
                <div class="input">
                    <label>Gender</label>
                    <select name="gender" class="input-field" required>
                        <option value="Not Selected">Select</option>
                        <option value="male" <?php if($result['gender'] == 'male'){ echo "selected"; } ?>>Male</option>
                        <option value="female" <?php if($result['gender'] == 'female'){ echo "selected"; } ?>>Female</option>
                    </select>
                </div>
                <div class="input">
                    <label>Address</label>
                    <textarea class="input-field" name="address" required><?php echo $result['address']; ?></textarea>
                </div>
                <div class="input">
                    <label>Phone Number</label>
                    <input type="text" value="<?php echo $result['phone']; ?>" class="input-field" name="phone" required>
                </div>
                <div class="input">
                    <label>Session</label>
                    <input type="text" value="<?php echo $result['session']; ?>" class="input-field" name="session" required>
                </div>
                <div class="input">
                    <label>CGPA</label>
                    <input type="text" value="<?php echo $result['cgpa']; ?>" class="input-field" name="cgpa" required>
                </div>
                <div class="input terms">
                    <label class="check">
                        <input type="checkbox">
                        <span class="checkmark"></span>
                    </label>
                    <p>Agree to terms and conditions</p>
                </div>
                <div class="input">
                    <input type="submit" value="Update" class="btn btn-primary" name="update">
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
if(isset($_POST['update'])){
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

    $query = "UPDATE FORM SET fname='$fname', lname='$lname', password='$pwd', email='$email', dob='$dob', gender='$gender', address='$address', phone='$phone', session='$session', cgpa='$cgpa' WHERE id='$id'";
    $data = mysqli_query($conn, $query);

    if($data){
        echo "<div class='container mt-3'><div class='alert alert-success'>Record Updated Successfully</div></div>";
    } 
    else {
        echo "<div class='container mt-3'><div class='alert alert-danger'>Failed to Update Record</div></div>";
    }
}
?>
