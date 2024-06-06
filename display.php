<?php 
include("connection.php");

$query = "SELECT * FROM FORM";
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
                echo "<td>
                        <a href='update_design.php?id=" . $result['id'] . "&fn=" . $result['fname'] . "&ln=" . $result['lname'] . "&pwd=" . $result['password'] . "&email=" . $result['email'] . "&dob=" . $result['dob'] . "&gen=" . $result['gender'] . "&add=" . $result['address'] . "&phone=" . $result['phone'] . "&ssn=" . $result['session'] . "&cgpa=" . $result['cgpa'] . "' class='btn btn-primary btn-sm'>Update</a>
                        <a href='delete.php?id=" . $result['id'] . "&fn=" . $result['fname'] . "&ln=" . $result['lname'] . "&pwd=" . $result['password'] . "&email=" . $result['email'] . "&dob=" . $result['dob'] . "&gen=" . $result['gender'] . "&add=" . $result['address'] . "&phone=" . $result['phone'] . "&ssn=" . $result['session'] . "&cgpa=" . $result['cgpa'] . "' class='btn btn-danger btn-sm' onclick='return confirmDelete()'>Delete</a>
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
</body>

</html>
