<!doctype html>
<!-- Change Password November 2022 
This is a backend PHP processing script. The user does not have direct interation with this file.
Allows a user to change their password. -->

<html>

    <body>
        <?php
            include "../includes/validate_session.php";
            # This page cannot be accessed directly. User must arrive via the POST method.
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                header("Location: ../index.php");
            }
            require_once "../includes/config.php"; # This creates the database connection.
            $h_current = hash("sha256", $_POST["current_field"]); #hash the current password
            $h_new = $_POST["new_pass_field"];
            $h_confirm= $_POST["confirm_pass_field"];
            if ($h_new != $h_confirm) { #Ensure that the new password and confirm password fields match.
                die("passwords must match");
            }
            $h_new = hash("sha256", $h_new); #hash the new password
            unset($h_confirm); 
            $username = $_SESSION["username"]; 


            # First we'll pull the current [hashed] password for the user.
            $stmt = $link->stmt_init();
            $stmt = $link->prepare("select username from user where username=? and password=?");
            $stmt->bind_param("ss",$username,$h_current);
            $stmt->execute();
            $stmt->bind_result($duser);
            $stmt->fetch();

            # If the current password is incorrect, send user back to try again.
            if ($duser == ""){
                $_SESSION["message"] = "Invalid current password";
                header("Location: ../forms/password_change.php");
            }
            # Otherwise clear the SQL to prepare to change password.
            $stmt->free_result();


            # Change the password in the database
            $stmt = $link->prepare("update user set password=? where username=? and password=?");
            $stmt->bind_param("sss",$h_new,$username,$h_current);
            $stmt->execute();

            # Send user back to main with a nice little confirmation message
            $_SESSION["message"] = "Password successfully changed";
            header("Location: ../forms/main.php");
            

            ?>
    </body>
</html>
