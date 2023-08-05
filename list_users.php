<?php
require_once("includes/db.inc.php");

$sql = "SELECT *, CASE Active WHEN 1 THEN 'true' ELSE 'false' END AS is_active FROM user";

$users = $con->query($sql) or die($con->error);
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Administration System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>User Administration System</h1>
    <p>
        <span><a href="create_user.php">Create New User</a></span>
        <span class="align-right"><a href="logout.php">Log out</a></span>
    </p>

    <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>User Name</th>
            <th>Active</th>
            <th>Action</th>
        </tr>

        <?php while ($row = $users->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['first_name'] ?></td>
                <td><?php echo $row['last_name'] ?></td>
                <td><?php echo $row['user_name'] ?></td>
                <td><?php echo $row['is_active'] ?></td>
                <td><a href="view_user.php?employee_id=<?php echo $row['id'] ?>">View</a></td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>