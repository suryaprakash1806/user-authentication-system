<?php
include 'db.php';

if(isset($_POST['register']))
{
    try
    {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password_text = $_POST['password'];

        if(empty($name))
        {
            die("Name is required");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            die("Invalid email format");
        }

        if(strlen($password_text) < 6)
        {
            die("Password must be at least 6 characters");
        }

        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if($result->num_rows > 0)
        {
            die("Email already registered");
        }

        $password = password_hash($password_text, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users(name,email,password)
             VALUES(?,?,?)"
        );

        $stmt->bind_param(
            "sss",
            $name,
            $email,
            $password
        );

        if($stmt->execute())
        {
            echo "Registration Successful";
        }
    }
    catch(Exception $e)
    {
        echo "Something went wrong. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <script>
    function validateRegister()
    {
        let name = document.forms["regForm"]["name"].value;
        let email = document.forms["regForm"]["email"].value;
        let password = document.forms["regForm"]["password"].value;

        if(name.trim() == "")
        {
            alert("Name is required");
            return false;
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if(!emailPattern.test(email))
        {
            alert("Enter a valid email address");
            return false;
        }

        if(password.length < 6)
        {
            alert("Password must be at least 6 characters");
            return false;
        }

        return true;
    }
    </script>
</head>
<body>

<h2>User Registration</h2>

<form method="POST" name="regForm" onsubmit="return validateRegister()">

    Name:<br>
    <input type="text" name="name">
    <br><br>

    Email:<br>
    <input type="email" name="email">
    <br><br>

    Password:<br>
    <input type="password" name="password">
    <br><br>

    <button type="submit" name="register">
        Register
    </button>

</form>

<br>

<a href="login.php">Go to Login</a>

</body>
</html>
