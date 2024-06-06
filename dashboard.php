<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include("connection.php");
$user_id = $_SESSION['user_id'];

// Fetch user data from the database based on user_id
$query = "SELECT * FROM FORM WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .navbar {
            margin-bottom: 20px;
        }

        h2 {
            color: #343a40;
            margin-bottom: 20px;
        }

        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }

        .btn-logout {
            color: white;
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-logout:hover {
            background-color: #c82333;
            border-color: #bd2130;
            border-radius: 1px;
        }

        .carousel-indicators button {
            background-color: #343a40;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: grayscale();
        }

        .form-inline .form-control {
            border-radius: 0;
            text-align: right;
        }

        .form-inline .btn-outline-success {
            border-radius: 0;
        }

        .footer {
            background-color: #dc3545;
            color: white;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .form-control.me-2 {
            text-align: right;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-building"></i> IIT System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-home"></i> Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="fas-fa-call"></i> Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        
                    </li>
                </ul>
            </div>
            <form class="d-flex ml-auto" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>

    <div class="container">
        <h2>Welcome, <?php echo $user['fname']; ?>!</h2>
        <p class="lead">We are glad to have you here.</p>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://source.unsplash.com/random/800x600?code,coding" class="d-block w-100" alt="Corporate Image">
                </div>
                <div class="carousel-item">
                    <img src="https://source.unsplash.com/random/800x600?hacker,hacking" class="d-block w-100" alt="Office Meeting">
                </div>
                <div class="carousel-item">
                    <img src="https://source.unsplash.com/random/800x600?team,work" class="d-block w-100" alt="Team Work">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="text-center">&copy; 2024 IIT System. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
