<?php
session_start();
include("connection.php");

if(isset($_SESSION['user_id'])){
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Query to check if email and password match
    $query = "SELECT * FROM FORM WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    
    if($user){
        $_SESSION['user_id'] = $user['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color:azure
            
        }

        .container {
            max-width: 400px;
            margin-top: 100px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color:#721c24;
            border: #343a40;
            text-decoration: solid;
        }

        .form-group label {
            color: #343a40;
            text-decoration: solid;
    
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <p>Forgot your password?</p>
            <p>If you have not registered!
            <a href="form.php" class="btn btn-primary">Register</a>
            </p>

            <?php if(isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary" name="login">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
