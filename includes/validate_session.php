<!--
    Validate Session
    9/22
    Basic checks to ensure user is properly logged on prior to being able to view pages.

-->

<!doctype html>
<html>
    <?php
        session_start();
        # Check a handul of session variables. If any are not set,
        # require user to login to continue.
        if (!isset($_SESSION['username']) || !isset($_SESSION['first_name'])
        || !isset($_SESSION['first_name']) || !isset($_SESSION['email']) || !isset($_SESSION['is_admin'])) {
            header("Location: ../index.php");
        }
        ?>
        </html>