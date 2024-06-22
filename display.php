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
    <div class="container mt-5">
        <h2 class="text-center">Student Records</h2>
        <?php 
        if ($total > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";
            echo "<th>Password</th>";
            echo "<th>Email</th>";
            echo "<th>Date of Birth</th>";
            echo "<th>Gender</th>";
            echo "<th>Address</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Session</th>";
            echo "<th>CGPA</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "<th>Operations</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($result = mysqli_fetch_assoc($data)) {
                echo "<tr>";
                echo "<td>" . $result['id'] . "</td>";
                echo "<td>" . $result['fname'] . "</td>";
                echo "<td>" . $result['lname'] . "</td>";
                echo "<td>" . $result['password'] . "</td>";
                echo "<td>" . $result['email'] . "</td>";
                echo "<td>" . $result['dob'] . "</td>";
                echo "<td>" . $result['gender'] . "</td>";
                echo "<td>" . $result['address'] . "</td>";
                echo "<td>" . $result['phone'] . "</td>";
                echo "<td>" . $result['session'] . "</td>";
                echo "<td>" . $result['cgpa'] . "</td>";
                echo "<td>";
                if ($result['status'] == 'accepted') {
                    echo "<i class='fas fa-check-circle text-success'></i> Accepted";
                } elseif ($result['status'] == 'rejected') {
                    echo "<i class='fas fa-times-circle text-danger'></i> Rejected";
                } else {
                    echo "<i class='fas fa-hourglass-half text-warning'></i> Pending";
                }
                echo "</td>";
                echo "<td>";
                if ($result['status'] == 'pending') {
                    echo "<form method='POST' action='' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $result['id'] . "'>
                            <input type='hidden' name='new_status' value='accepted'>
                            <button type='submit' name='update_status' class='btn btn-success btn-sm'>Accept</button>
                          </form>";
                    echo "<form method='POST' action='' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $result['id'] . "'>
                            <input type='hidden' name='new_status' value='rejected'>
                            <button type='submit' name='update_status' class='btn btn-danger btn-sm'>Reject</button>
                          </form>";
                } else {
                    echo "<form method='POST' action='' style='display:inline;'>
                            <input type='hidden' name='id' value='" . $result['id'] . "'>
                            <input type='hidden' name='new_status' value='pending'>
                            <button type='submit' name='update_status' class='btn btn-warning btn-sm'>Withdraw</button>
                          </form>";
                }
                echo "</td>";
                echo "<td>
                        <a href='update_design.php?id=" . $result['id'] . "' class='btn btn-primary btn-sm'>Update</a>
                        <a href='delete.php?id=" . $result['id'] . "' class='btn btn-danger btn-sm' onclick='return confirmDelete()'>Delete</a>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<h2 class='text-center'>No Records Found</h2>";
        }
        ?>
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
