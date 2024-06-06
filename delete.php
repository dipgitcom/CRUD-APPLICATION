<?php 
include("connection.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM FORM WHERE id='$id'";
    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "<script>alert('Record deleted successfully');</script>";
        echo "<script>window.location.href = 'display.php';</script>";
    } else {
        echo "<script>alert('Failed to delete the record');</script>";
    }
} else {
    echo "<script>alert('Invalid request');</script>";
    echo "<script>window.location.href = 'display.php';</script>";
}
?>
