<!--
    Logout
    10/22
    Ensure a full and proper logout to mitigate session hijacking possibilities.

-->
<!doctype html>
<html>
    <?php
        session_start();

        #Remove cookies
        $params = session_get_cookie_params();
        setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));

        #Terminate session
        session_unset();
        session_destroy();

        #Send back to login page
        header("Location: ../index.php");

    ?>