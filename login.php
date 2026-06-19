<?php

session_start();
include 'db.php';

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";

    $result = $conn->query($sql);

    if($result->num_rows > 0)
    {
        $user = $result->fetch_assoc();

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user'] = $user['name'];

            header("Location: dashboard.php");
            exit();
        }
        else
        {
            echo "Wrong Password";
        }
    }
    else
    {
        echo "User Not Found";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>User Login</h2>

<form method="POST">

    Email:<br>
    <input type="email" name="email" required>
    <br><br>

    Password:<br>
    <input type="password" name="password" required>
    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

<br>

<a href="register.php">Register Here</a>

</body>
</html>