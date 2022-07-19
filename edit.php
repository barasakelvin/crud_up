<?php
require_once './db_connection.php';
require_once './fetch-data.php';
require_once './update.php';
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['first_name']) && isset($_POST['last_email'])&& isset($_POST['u_email'])&& isset($_POST['phone_number'])) {

    $update_data = updateUser($conn, $_GET['id'], $_POST['first_name'], $_POST['last_name'],$_POST['u_email'],$_POST['phone_number']);

    if ($update_data === true) {
        header('Location: index.php');
        exit;
    }
}

$theUser = fetchUser($conn, $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple PHP CRUD Application</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

<div class="container">
    <header class="header">
        <h1 class="title">PHP CRUD Application</h1>
        <p>By <a href="//www.w3jar.com">w3jar.com</a></p>
    </header>
    <div class="wrapper edit-wrapper">
        <div class="form">
            <form method="POST">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" value="<?php echo htmlspecialchars($theUser['name']); ?>" id="first_name" placeholder="First Name" autocomplete="off" required>

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" value="<?php echo htmlspecialchars($theUser['name']); ?>" id="first_name" placeholder="Last Name" autocomplete="off" required>

                <label for="email">Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($theUser['email']); ?>" id="email" placeholder="Email" autocomplete="off" required>

                <label for="phone_number">Phone number</label>
                <input type="number" name="phone_number" value="<?php echo htmlspecialchars($theUser['name']); ?>" id="phone_number" placeholder="Phone number" autocomplete="off" required>

                <?php if (isset($update_data) && $update_data !== true) {
                    echo '<p class="msg err-msg">' . $update_data . '</p>';
                }
                ?>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>
</div>

</body>

</html>