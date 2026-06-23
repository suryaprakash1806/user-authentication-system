<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM users WHERE id=$id";

if($conn->query($sql))
{
    header("Location: manage_users.php");
    exit();
}
else
{
    echo "Error: " . $conn->error;
}
?>
