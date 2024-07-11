<?php
session_start();
include("connection.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['update_status'])) {
    $id = $_POST['id'];
    $new_status = $_POST['new_status'];
    
    // Prepare and bind
    $stmt = $conn->prepare("UPDATE FORM1 SET status=? WHERE id=?");
    $stmt->bind_param("si", $new_status, $id);

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page to reflect changes
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$query = "SELECT * FROM FORM1";
$data = mysqli_query($conn, $query);
$total = mysqli_num_rows($data);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Records</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">NSTU-QuickBill</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="fas fa-building"></i> IIT System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php"><i class="fas fa-home"></i> Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#"><i class="fas-fa-call"></i> Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="btn btn-logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        
                    </li>
                </ul>
            </div>
    </nav>

    <div class="container mt-5">
        <h2 class="text-center">Student Records</h2>
        <?php if ($total > 0): ?>
            <table class='table table-bordered'>
                <thead class='thead-dark'>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Session</th>
                        <th>CGPA</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($result = mysqli_fetch_assoc($data)): ?>
                        <tr>
                            <td><?= $result['id'] ?></td>
                            <td><?= $result['fname'] ?></td>
                            <td><?= $result['lname'] ?></td>
                            <td><?= $result['password'] ?></td>
                            <td><?= $result['email'] ?></td>
                            <td><?= $result['dob'] ?></td>
                            <td><?= $result['gender'] ?></td>
                            <td><?= $result['address'] ?></td>
                            <td><?= $result['phone'] ?></td>
                            <td><?= $result['session'] ?></td>
                            <td><?= $result['cgpa'] ?></td>
                            <td>
                                <?php if ($result['status'] == 'accepted'): ?>
                                    <i class='fas fa-check-circle text-success'></i> Accepted
                                <?php elseif ($result['status'] == 'rejected'): ?>
                                    <i class='fas fa-times-circle text-danger'></i> Rejected
                                <?php else: ?>
                                    <i class='fas fa-hourglass-half text-warning'></i> Pending
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($result['status'] == 'pending'): ?>
                                    <form method='POST' action='' style='display:inline;'>
                                        <input type='hidden' name='id' value='<?= $result['id'] ?>'>
                                        <input type='hidden' name='new_status' value='accepted'>
                                        <button type='submit' name='update_status' class='btn btn-success btn-sm'>Accept</button>
                                    </form>
                                    <form method='POST' action='' style='display:inline;'>
                                        <input type='hidden' name='id' value='<?= $result['id'] ?>'>
                                        <input type='hidden' name='new_status' value='rejected'>
                                        <button type='submit' name='update_status' class='btn btn-danger btn-sm'>Reject</button>
                                    </form>
                                <?php else: ?>
                                    <form method='POST' action='' style='display:inline;'>
                                        <input type='hidden' name='id' value='<?= $result['id'] ?>'>
                                        <input type='hidden' name='new_status' value='pending'>
                                        <button type='submit' name='update_status' class='btn btn-warning btn-sm'>Withdraw</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href='update_design.php?id=<?= $result['id'] ?>' class='btn btn-primary btn-sm'>Update</a>
                                <a href='delete.php?id=<?= $result['id'] ?>' class='btn btn-danger btn-sm' onclick='return confirmDelete()'>Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <h2 class='text-center'>No Records Found</h2>
        <?php endif; ?>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this record?');
        }
    </script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
