<?php
require_once("includes/db.inc.php");
$employee_id = $_GET["employee_id"];

$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$con->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
    <div id="container">
        <h1>View User</h1>
        <p>
            <label>First Name:</label>
            <input type="text" name="first_name" required="required" readonly value="<?php echo $user['first_name'] ?>" />
        </p>
        <p>
            <label>Last Name</label>
            <input type="text" name="last_name" required="required" readonly value="<?php echo $user['last_name'] ?>" />
        </p>
        <p>
            <label>Email</label>
            <input type="text" name="email" required="required" readonly value="<?php echo $user['email'] ?>" />
        </p>
        <p>
            <label>Active</label>
            <input type="checkbox" name="active" value="yes" disabled <?php echo ($user['active'] == 1 ? 'checked' : ''); ?>>
        </p>
        <p>
            <a href="edit_user.php?employee_id=<?php echo $employee_id ?>">Edit</a>
        </p>
        <p>
            <a href="list_users.php">Back to List</a>
        </p>

    </div>
</body>

</html>