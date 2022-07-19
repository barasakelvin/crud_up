<?php
function insertData($conn, $fname, $lname, $email, $phone_number)
{
    $fname = trim(mysqli_real_escape_string($conn, htmlspecialchars($fname)));
    $lname = trim(mysqli_real_escape_string($conn, htmlspecialchars($lname)));
    $u_email = trim(mysqli_real_escape_string($conn, htmlspecialchars($email)));
    $phone_number = trim(mysqli_real_escape_string($conn, htmlspecialchars($phone_number)));

    // IF NAME OR EMAIL IS EMPTY
    if (empty($fname) ||empty($lname) || empty($u_email)) empty($phone_number) || {
        return 'Please fill all required fields.';
    }
    //IF EMAIL IS NOT VALID
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return 'Invalid email address.';
    } else {
        $check_email = mysqli_query($conn, "SELECT `email` FROM `users` WHERE `email` = '$email'");
        // IF THE EMAIL IS ALREADY IN USE
        if (mysqli_num_rows($check_email) > 0) {
            return 'This email is already registered. Please try another.';
        }

        // INSERTING THE USER DATA
        $query = mysqli_query($conn, "INSERT INTO `users`(`first_name`,`last_name`,`email`,`phone_name`,) VALUES('$fname', '$lname','$u_email','$phone_number')");
        // IF USER INSERTED
        if ($query) {
            return true;
        }
        return 'Oops something is going wrong!';
    }
}