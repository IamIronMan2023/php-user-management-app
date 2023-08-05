 <?php
    require_once("includes/db.inc.php");
    require_once("includes/util.inc.php");

    $employee_id = $_GET["employee_id"];
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $employee_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (isset($_POST['submit'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $username = $_POST['user_name'];
        $active = isset($_POST['active']) ? 1 : 0;

        $sql = "UPDATE user SET first_name = ?, last_name = ?, email = ?, user_name = ?, active=? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ssssii", $first_name, $last_name, $email, $username, $active, $employee_id);

        if ($stmt->execute()) {
            redirect("view_user.php?employee_id=$employee_id");
        }
    } else if (isset($_POST['cancel'])) {
        redirect("view_user.php?employee_id=$employee_id");
    }

    $stmt->close();
    $con->close();

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Edit User</title>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/dark.css">
 </head>

 <body>
     <div id="container">
         <h1>Edit User</h1>
         <form action="" method="post" id="form">
             <p>
                 <label>First Name</label>
                 <input type="text" name="first_name" required="required" value="<?php echo $user['first_name'] ?>" />
             </p>
             <p>
                 <label for="">Last Name</label>
                 <input type="text" name="last_name" required="required" value="<?php echo $user['last_name'] ?>" />
             </p>
             <p>
                 <label for="">User Name</label>
                 <input type="text" name="user_name" required="required" value="<?php echo $user['user_name'] ?>" />
             </p>
             <p>
                 <label for="">Email</label>
                 <input type="email" name="email" required="required" value="<?php echo $user['email'] ?>" />
             </p>
             <p>
                 <label>Active</label>
                 <input type="checkbox" name="active" value="yes" <?php echo ($user['active'] == 1 ? 'checked' : ''); ?>>
             </p>
             <button type="submit" name="submit">Update</button>
             <button type="submit" name="cancel">Cancel</button>
         </form>
     </div>

 </body>

 </html>