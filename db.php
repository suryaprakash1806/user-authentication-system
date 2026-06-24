<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

try
{
    $conn = new mysqli(
        $servername,
        $username,
        $password,
        $dbname
    );
}
catch(Exception $e)
{
    die("Database Connection Failed");
}

?>
