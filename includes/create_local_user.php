<!--
    Create Local User
    This is a backend processing script. User should not be directly interacting with this.
-->
<!doctype html>
<html>
    <body>
        <?php
            # This script must be entered via the POST method.
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                header("Location: ../index.php");
            }
            # Ensure we have a valid session.
            require("../includes/validate_session.php");

            # Get our DB connection
            require_once "../includes/config.php"; 
            
            # Get values from the $_POST array.
            $first_name = $_POST["firstname_field"];
            $last_name = $_POST["lastname_field"];
            $email = $_POST["email_field"];
            $password = hash("sha256", $_POST["password_field"]);
            $username = $_POST["username_field"];
            $is_admin = $_POST["is_admin_field"] == "on";

            # Query the database to ensure email and usernames are unique.
            $stmt = $link->stmt_init();
	        $stmt = $link->prepare("select email,username from user where username=? or email=?");
            $stmt->bind_param("ss",$username,$email);
	        $stmt->execute();
	        $stmt->bind_result($demail,$duser);
	        $stmt->fetch();
            
            if (strcmp(strtoupper($email),strtoupper($demail)) == 0) {
                $_SESSION["message"] = "Email already registered";
                header("Location: ../forms/add_user.php");
            }
            if (strcmp(strtoupper($username),strtoupper($duser)) == 0) {
                $_SESSION["message"] = "Username taken. Please try another";
                header("Location: ../forms/add_user.php");
            }
            
            $stmt->free_result();

            # Insert the new user into DB
            $stmt = $link->stmt_init();
            $stmt = $link->prepare("insert into user(first_name,last_name,email,password,username,is_admin) 
                                    values (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $first_name, $last_name, $email, $password, $username, $is_admin);
            $stmt->execute();
            
            # Send back to main with a confirmation message
            $_SESSION["message"] = "User added successfully";
            header("Location: ../forms/main.php");
          
        ?>
    </body>
</html>