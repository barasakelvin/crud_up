<?php
require_once './db_connection.php';
require_once './fetch-data.php';
require_once './insert-data.php';
$all_user = array_reverse(fetchUsers($conn));

if (isset($_POST['first_name'])&& isset($_POST['last_name']) && isset($_POST['email'])&& isset($_POST['phone_number'])) {
    $insert_data = insertData($conn, $_POST['first_name'], $_POST['last_name'],  $_POST['email'], $_POST['phone_number']);
    if ($insert_data === true) {
        header('Location: index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Php Crud Application</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>

<div class="container">
    <header class="header">
        <h1 class="title">Crud up</h1>
    </header>
    <div class="wrapper">
        <div class="form">
            <form method="POST">
                <label for="first_name">Firs Name</label>
                <input type="text" name="first_name" id="first_name" placeholder="First Name" autocomplete="off" required>

                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" placeholder="Last Name" autocomplete="off" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>

                <label for="phone_number">Phone number</label>
                <input type="number" name="phone_number" id="phone_number" placeholder="Name" autocomplete="off" required>

                <?php if (isset($insert_data) && $insert_data !== true) {
                    echo '<p class="msg err-msg">' . $insert_data . '</p>';
                }
                ?>
                <input type="submit" value="Submit">
            </form>
        </div>
        <div class="user-list">
            <?php if (count($all_user) > 0) : ?>
                <table>
                    <tbody>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone number</th>
                        <th>Action</th>
                    </tr>
                    <?php foreach ($all_user as $user) :
                        $id = $user['id'];
                        $fname = $user['first_name'];
                        $lname = $user['last_name'];
                        $email = $user['email'];
                        $phone_number = $user['phone_number'];
                        ?>
                        <tr>
                            <td><?php echo $fname; ?></td>
                            <td><?php echo $lname; ?></td>
                            <td><?php echo $email; ?></td>
                            <td><?php echo $phone_number; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $id; ?>" class="edit">Edit</a>&nbsp;|
                                <a href="delete.php?id=<?php echo $id; ?>" class="delete delete-action">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <h2>No records found. Please insert some records.</h2>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    let delteAction = document.querySelectorAll('.delete-action');
    delteAction.forEach((el) => {
        el.onclick = function(e) {
            e.preventDefault();
            if (confirm('Are you sure?')) {
                window.location.href = e.target.href;
            }
        }
    });
</script>

</body>

</html>