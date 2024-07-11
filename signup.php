<?php
session_start();
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Include PHPMailer's autoload file if using Composer

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);

    // Check if username exists
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }
    $count_user = mysqli_num_rows($result);

    // Check if email exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn));
    }
    $count_email = mysqli_num_rows($result);

    if ($count_user == 0 && $count_email == 0) {
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $verification_code = mt_rand(100000, 999999); // Generate a 6-digit verification code

            // Store user data and verification code in session
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $hash;
            $_SESSION['verification_code'] = $verification_code;

            // Send verification email
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;  // Enable verbose debug output (0 for no output)
                $mail->isSMTP();  // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';  // Set the SMTP server to send through
                $mail->SMTPAuth   = true;  // Enable SMTP authentication
                $mail->Username   = 'diprajdhar08@gmail.com';  // SMTP username
                $mail->Password   = 'cyabsmrwnnqkcwyg';  // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption
                $mail->Port       = 587;  // TCP port to connect to

                //Recipients
                $mail->setFrom('no-reply@yourwebsite.com', 'Your Website');
                $mail->addAddress($email);  // Add a recipient

                // Content
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Verification Code';
                $mail->Body    = "Your verification code is: $verification_code";

                $mail->send();

                header("Location: verify.php");
                exit();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo '<script>
                    alert("Passwords do not match");
                    window.location.href = "signup.php";
                  </script>';
        }
    } else {
        if ($count_user > 0) {
            echo '<script>
                    alert("Username already exists!!");
                    window.location.href="signup.php";
                  </script>';
        }
        if ($count_email > 0) {
            echo '<script>
                    alert("Email already exists!!");
                    window.location.href="signup.php";
                  </script>';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }
        #form {
            background-color: #fff;
            padding: 20px;
            margin: 50px auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
        }
        #heading {
            text-align: center;
            color: #333;
        }
        label {
            color: #333;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: white;
            font-size: 16px;
        }
        #btn:hover {
            background-color: #0056b3;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div id="form">
        <h1 id="heading">SignUp Form</h1><br>
        <form name="form" action="signup.php" method="POST">
            <label>Enter Username: </label>
            <input type="text" id="user" name="user" required><br><br>
            <label>Enter Email: </label>
            <input type="email" id="email" name="email" required><br><br>
            <label>Create Password: </label>
            <input type="password" id="pass" name="pass" required><br><br>
            <label>Retype Password: </label>
            <input type="password" id="cpass" name="cpass" required><br><br>
            <input type="submit" id="btn" value="SignUp" name="submit"/>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <a href="login.php">Already Have an Account?</a>
</body>
</html>
