<?php

if (isset($_POST['submit'])) {
    require_once("includes/db.inc.php");
    require_once("includes/util.inc.php");

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['user_name'];
    $password = $_POST['password'];

    $sql = "INSERT INTO user (first_name, last_name, email, user_name, password) VALUES(?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $username, $password);

    if ($stmt->execute()) {
        $employee_id = $con->insert_id;

        redirect("view_user.php?employee_id=$employee_id");
    }
    $stmt->close();
    $con->close();
} else if (isset($_POST['cancel'])) {
    redirect("view_user.php?employee_id=$employee_id");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
</head>

<body>
    <div id="container">
        <h1>Create User</h1>
        <form action="" method="post" id="form">
            <p>
                <label>First Name</label>
                <input type="text" name="first_name" required="required" />
            </p>
            <p>
                <label for="">Last Name</label>
                <input type="text" name="last_name" required="required" />
            </p>
            <p>
                <label for="">User Name</label>
                <input type="text" name="user_name" required="required" />
            </p>
            <p>
                <label for="">Email</label>
                <input type="email" name="email" required="required" />
            </p>
            <p>
                <label for="">Password</label>
                <input type="text" name="password" required="required" />
            </p>

            <button type="submit" name="submit">Create</button>
            <button type="submit" name="cancel">Cancel</button>
        </form>
    </div>

</body>

</html>