<?php
session_start();
include("connection.php");

if (!isset($_SESSION['email']) || !isset($_SESSION['verification_code'])) {
    header("Location: signup.php");
    exit();
}

if (isset($_POST['verify'])) {
    $entered_code = mysqli_real_escape_string($conn, $_POST['verification_code']);
    $email = $_SESSION['email'];
    $expected_code = $_SESSION['verification_code'];

    if ($entered_code == $expected_code) {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $hash = mysqli_real_escape_string($conn, $password);

        // Insert user data into database
        $sql = "INSERT INTO users(username, email, password, verification) VALUES('$username', '$email', '$hash', 1)";
        if (mysqli_query($conn, $sql)) {
            echo '<script>
                    alert("Signup successful. Please login.");
                    window.location.href = "login.php";
                  </script>';
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo '<script>
                alert("Verification code does not match. Please try again.");
                window.location.href = "verify.php";
              </script>';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification Code</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Arial', sans-serif;
        }

        .card {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 1.5rem;
            color: #333333;
        }

        p {
            color: #666666;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4 shadow-lg">
            <h1 class="mb-4 text-center">Verification Code</h1>
            <form action="verify.php" method="POST">
                <p class="text-center">Enter the 6-digit verification code sent to your email.</p>
                <div class="mb-3">
                    <input type="text" class="form-control" name="verification_code" maxlength="6" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="verify">Verify</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
