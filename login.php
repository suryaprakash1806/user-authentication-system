<?php
session_start();
include 'db.php';

if(isset($_POST['login']))
{
    try
    {
        $email = trim($_POST['email']);
        $password = $_POST['password'];

        if(empty($email))
        {
            die("Email is required");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            die("Invalid email format");
        }

        if(empty($password))
        {
            die("Password is required");
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

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
                echo "<p style='color:red;'>Wrong Password</p>";
            }
        }
        else
        {
            echo "<p style='color:red;'>User Not Found</p>";
        }
    }
    catch(Exception $e)
    {
        echo "<p style='color:red;'>Something went wrong. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <script>
    function validateLogin()
    {
        let email = document.forms["loginForm"]["email"].value;
        let password = document.forms["loginForm"]["password"].value;

        if(email.trim() == "")
        {
            alert("Email is required");
            return false;
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!emailPattern.test(email))
        {
            alert("Enter a valid email address");
            return false;
        }

        if(password.trim() == "")
        {
            alert("Password is required");
            return false;
        }

        return true;
    }
    </script>
</head>
<body>

<h2>User Login</h2>

<form method="POST" name="loginForm" onsubmit="return validateLogin()">

    Email:<br>
    <input type="email" name="email">
    <br><br>

    Password:<br>
    <input type="password" name="password">
    <br><br>

    <button type="submit" name="login">
        Login
    </button>

</form>

<br>

<a href="register.php">Register Here</a>

</body>
</html>
