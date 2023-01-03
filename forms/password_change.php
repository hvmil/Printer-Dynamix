<!-- 
    Password Change
    10/22

    Allows a user to change their password, provided they can recall their current.

-->


<!doctype html>
<html>
    <head>
        <title>
            Update Password
        </title>
        <!-- Styple sheet setup -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

          <link rel="stylesheet" href="../css/style.css">
          <link rel="stylesheet" href="../css/main.css">
          <link rel="stylesheet" href="../fonts/icomoon/style.css">
          <link rel="stylesheet" href="../css/owl.carousel.min.css">
          <link rel="stylesheet" href="../css/bootstrap.min.css">

        <script>
            // Basic user-side form validation.
            function validateForm() {
                let valid = true;
                if (document.getElementById("current_field").value == "") {
                    valid = false;
                    document.getElementById("error1").innerHTML = "<div>Required</div>";
                } else {
                    document.getElementById("error1").innerHTML = "";
                }
                if (document.getElementById("new_pass_field").value == "") {
                    valid = false;
                    document.getElementById("error2").innerHTML = "<div>Required</div>";
                } else {
                    document.getElementById("error2").innerHTML = "";
                }
                if (document.getElementById("confirm_pass_field").value != document.getElementById("new_pass_field").value) {
                    valid = false;
                    document.getElementById("error3").innerHTML = "<div>Passwords don't match</div>";
                } else {
                    document.getElementById("error3").innerHTML = "";
                }
                return valid;
            }
        </script>
    </head>
    <body class="container d-flex flex-column" id="body-background">
      <!-- validate the session. -->
    <?php
            require_once "../includes/validate_session.php";
            if (isset($_SESSION["message"])){
                echo $_SESSION["message"];
                echo "<br /><br />";
                unset($_SESSION["message"]);
            }
    ?>
  <!-- navbar -->
    <?php include "../includes/navbar.php" ?>

</div>



<div class="mt-5"></div>
<!-- Top of table (logo & heading) -->
<div class="" >
  <section class="ftco-section">

    <div class="container">

      <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
          <div class="wrap">
            <div class="img" style="background-image: url(../img/Printer\ Dynamix-logos.jpeg);"></div>
            <div class="login-wrap p-4 p-md-5">
              <div class="d-flex">
                <div class="w-100">
                  <h3 class="mb-4">Change Password</h3>
                </div>
              </div>

              
  <!-- Change Password Form  -->
  <table>
      <form action="../includes/change_password.php" onsubmit="return validateForm()" method="POST">
          <tr>
              <td>
                  <label for="current_field">Current Password</label>
              </td>
              <td>
                  <input type="password" id="current_field" name="current_field" />
              </td>
              <td id="error1"></td>
          </tr>
          <tr>
              <td>
                  <label for="new_pass_field">New Password</label>
              </td>
              <td>
                  <input type="password" id="new_pass_field" name="new_pass_field"  />
              </td>
              <td id="error2"></td>
          </tr>
          <tr>
              <td>
                  <label for="confirm_pass_field">Confirm New Password</label>
              </td>
              <td>
                  <input type="password" id="confirm_pass_field" name="confirm_pass_field" />
              </td>
              <td id="error3"></td>
          </tr>
          <tr>
            <td></td>
              <td colspan="2">
                  <input type="submit" value="Submit" />
              </td>
          </tr>
      </form>
  </table>


  </div>
  </div>
  </div>
  </div>
  </div>
  </section>

</div>
</html>
