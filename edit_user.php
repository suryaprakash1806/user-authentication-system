<?php
include 'db.php';

$id = $_GET['id'];

$result = $conn->query("SELECT * FROM users WHERE id=$id");
$user = $result->fetch_assoc();

if(isset($_POST['update']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users
            SET name='$name',
                email='$email',
                phone='$phone'
            WHERE id=$id";

    if($conn->query($sql))
    {
        header("Location: manage_users.php");
        exit();
    }
    else
    {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User</h2>

<form method="POST">

    Name:<br>
    <input type="text" name="name"
           value="<?php echo $user['name']; ?>" required>
    <br><br>

    Email:<br>
    <input type="email" name="email"
           value="<?php echo $user['email']; ?>" required>
    <br><br>

    Phone:<br>
    <input type="text" name="phone"
           value="<?php echo $user['phone']; ?>" required>
    <br><br>

    <button type="submit" name="update">
        Update User
    </button>

</form>

</body>
</html>