<?php
function updateUser($conn, $id, $fname, $lname, $email, $phone_number)
{

    $id = trim(mysqli_real_escape_string($conn, $id));
    $fname = trim(mysqli_real_escape_string($conn, htmlspecialchars($fname)));
    $lname = trim(mysqli_real_escape_string($conn, htmlspecialchars($lname)));
    $email = trim(mysqli_real_escape_string($conn, htmlspecialchars($email)));
    $phone_number = trim(mysqli_real_escape_string($conn, htmlspecialchars($phone_number)));

    // IF NAME OR EMAIL IS EMPTY
    if (empty($fname) || empty($lname) || empty($email)|| empty($phone_number) ) {
        return 'Please fill all required fields.';
    }
    //IF EMAIL IS NOT VALID
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email address.';
    } else {
        $check_email = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '$email' AND `id`!='$id'");
        // IF THE EMAIL IS ALREADY IN USE
        if (mysqli_num_rows($check_email) > 0) {
            return 'This email is already registered. Please try another.';
        }

        // UPDATE USER DATA
        $query = mysqli_query($conn, "UPDATE `users` SET `first_name`='$fname', `last_name`='$lname',`email`='$email'`phone_number`='$phone_number', WHERE `id`='$id'");
        // IF USER UPDATED
        if ($query) {
            return true;
        }
        return 'Oops something is going wrong!';
    }
}