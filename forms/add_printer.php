<!-- Add Printer V2 11/13/22
Allows user to add a new printer to the system. 
-->

<!doctype html>

<html>
    <head>

        <title>
            Add Printer
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


            // Author:CS
            // Description: Takes in user input for a few fields and then passes that information to "create printer"

            // validates to make sure all fields are filled out
            function validateForm() {
                    let valid = true;
                    if (document.getElementById("ip_field").value == ""){
                        valid = false;
                        document.getElementById("error1").innerHTML="Required!";
                    } else {
                        document.getElementById("error1").innterHTML="";
                    }
                    if (document.getElementById("name_field").value == "") {
                        valid = false;
                        document.getElementById("error2").innerHTML="Required!";
                    } else {
                        document.getElementById("error2").innterHTML="";
                    }
                    if (document.getElementById("make_field").value == "") {
                        valid = false;
                        document.getElementById("error3").innerHTML="Required!";
                    } else {
                        document.getElementById("error3").innterHTML="";
                    }
                    if (document.getElementById("model_field").value == "") {
                        valid = false;
                        document.getElementById("error4").innerHTML="Required!";
                    } else {
                        document.getElementById("error4").innterHTML="";
                    }
                    if (document.getElementById("location_field").value == "") {
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
            if (isset($_SESSION["is_admin"]) and $_SESSION["is_admin"] != 1){
                header("Location: ../forms/main.php");
              }
    ?>
    <!-- navbar -->
    <!-- navbar -->
    <?php include "../includes/navbar.php" ?>

</div>
<div class="mt-5"></div>
<!-- Table -->
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
                  <h3 class="mb-4">Add Printer</h3>
                </div>
              </div>
  <!--
  <h1>Create New printer</h1>
  -->
  <table>
      <form action="../includes/create_printer.php" onsubmit="return validateForm()" method="POST">
          <tr>

          <!-- Builds the input boxes for the user to submit new printer credentials-->
              <td><label for="ip_field">Printer IP</label></td>
              <td><input type="text" class="form-control" name="ip_field" id="ip_field" alt="Enter IP" /></td>
              <div class="error" id="error1"></div>
          </tr>
          <tr>
              <td><label  for="name_field">Name</label></td>
              <td><input type="text" class="form-control" name="name_field" id="name_field" alt="Enter name" /></td>

              <td><div class="error" id="error2"></div></td>
          </tr>
          <tr>
              <td><label  for="make_field">Make</label></td>
              <td><input type="text" class="form-control" name="make_field" id="make_field" alt="Enter make" /></td>

              <td><div class="error" id="error3"></div></td>
          </tr>
          <tr>
              <td><label  for="model_field">Model</label></td>
              <td><input type="text" class="form-control" name="model_field" id="model_field" alt="Enter model" /></td>

              <td><div class="error" id="error4"></div></td>
          </tr>
          <tr>
              <td><label  for="location_field">Location</label></td>
              <td><input type="text" class="form-control" name="location_field" id="location_field" alt="Enter location" /></td>

              <td><div class="error" id="error5"></div></td>
          </tr>


          <tr>
            <td></td>
              <td>
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
