<!doctype html>
<!-- Add user V3 11/13/22 
Formats page of add user to replicate main page and allow the user to add a new user to the database. -->
<html>
    <head>
    <link rel="icon" href="../img/Printer Dynamix-logos_transparent.png">


        <title>
            Add User
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
            //basic user-side form validation
            function validateForm() {
                    let valid = true;
                    if (document.getElementById("firstname_field").value == ""){
                        valid = false;
                        document.getElementById("error1").innerHTML="Required!";
                    } else {
                        document.getElementById("error1").innterHTML="";
                    }
                    if (document.getElementById("lastname_field").value == "") {
                        valid = false;
                        document.getElementById("error2").innerHTML="Required!";
                    } else {
                        document.getElementById("error2").innterHTML="";
                    }
                    if (document.getElementById("email_field").value == "") {
                        valid = false;
                        document.getElementById("error3").innerHTML="Required!";
                    } else {
                        document.getElementById("error3").innterHTML="";
                    }
                    if (document.getElementById("username_field").value == "") {
                        valid = false;
                        document.getElementById("error4").innerHTML="Required!";
                    } else {
                        document.getElementById("error4").innterHTML="";
                    }
                    if (document.getElementById("password_field").value == "") {
                        valid = false;
                        document.getElementById("error5").innerHTML="Required!";
                    } else {
                        document.getElementById("error5").innterHTML="";
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
              if (!$_SESSION["is_admin"]==1){
                header("Location: ../forms/main.php");
              }
      ?>
      
      <!-- navbar -->
       <?php include "../includes/navbar.php" ?>

  </div>
  <div class="mt-5"></div>

  <!-- Top of Table with Logo and Heading -->
  <div class="container" >
    <section class="ftco-section">

      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-7 col-lg-5">
            <div class="wrap">
              <div class="img" style="background-image: url(../img/Printer\ Dynamix-logos.jpeg);"></div>
              <div class="login-wrap p-4 p-md-5">
                <div class="d-flex">
                  <div class="w-100">
                    <h3 class="mb-4">Create New User</h3>
                  </div>
                </div>
    <!--
    The new user creation form.
    -->
    <table>
    <form action="../includes/create_local_user.php" onsubmit="return validateForm()" method="POST">
    <tr>
        <td><label for="firstname_field">First name</label></td>
        <td><input type="text" name="firstname_field" id="firstname_field" alt="Enter first name" /></td>
        <td><div class="error" id="error1"></div></td>
    </tr>
    <tr>
        <td><label for="lastname_field">Last name</label></td>
        <td><input type="text" name="lastname_field" id="lastname_field" alt="Enter last name" /></td>
        <td><div class="error" id="error2"></div></td>
    </tr>
    <tr>
        <td><label for="email_field">Email</label></td>
        <td><input type="text" name="email_field" id="email_field" alt="Enter email address" /></td>
        <td><div class="error" id="error3"></div></td>
    </tr>
    <tr>
        <td><label for="username_field">Username</label></td>
        <td><input type="text" name="username_field" id="username_field" alt="Enter user name" /></td>
        <td><div class="error" id="error4"></div></td>
    </tr>
    <tr>
        <td><label for="password_field">Password</label></td>
        <td><input type="password" name="password_field" id="password_field" alt="Create password" /></td>
        <td><div class="error" id="error5"></div></td>
    </tr>
    <tr>
              <td><label for="is_admin_field">Administrator Rights?</label></td>
              <td><input type="checkbox" name="is_admin_field" id="is_admin_field" alt="Is this user an admin?" /></td>
    </tr>
    <tr>
      <td></td>
        <td span="2">
            <input type="submit" class="form-control btn btn-primary rounded submit px-3" value="Submit" alt="submit" />
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

</body>
</html>
