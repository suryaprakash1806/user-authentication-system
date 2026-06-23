<?php
include 'db.php';

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <style>
        table{
            border-collapse: collapse;
            width: 80%;
        }

        th, td{
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th{
            background-color: lightgray;
        }

        a{
            text-decoration: none;
            padding: 5px 10px;
            border: 1px solid black;
            margin: 2px;
        }
    </style>
</head>
<body>

<h2>Manage Users</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Action</th>
    </tr>

    <?php while($row = $result->fetch_assoc()) { ?>

    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['phone']; ?></td>
        <td>
            <a href="edit_user.php?id=<?php echo $row['id']; ?>">
                Edit
            </a>

            <a href="delete_user.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Are you sure you want to delete this user?')">
                Delete
            </a>
        </td>
    </tr>

    <?php } ?>

</table>

<br>

<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>