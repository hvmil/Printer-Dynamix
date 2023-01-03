<!-- View History 12/2/22

Allows an admin user to generate a history report and displays it

-->

<!doctype html>

<html>
    <head>

        <title>
            View History
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


            // Author:CS, ZF
            // Description: Takes in user input for a few fields and then passes that information to "display_history"

            // validates to make sure all fields are filled out
            function validateForm() {
                    let valid = true;
                    if (document.getElementById("name_field").value == ""){
                        valid = false;
                        document.getElementById("error1").innerHTML="Required!";
                    } else {
                        document.getElementById("error1").innterHTML="";
                    }
                    if (document.getElementById("color_field").value == "") {
                        valid = false;
                        document.getElementById("error2").innerHTML="Required!";
                    } else {
                        document.getElementById("error2").innterHTML="";
                    }
                    if (document.getElementById("start_date_field").value == "") {
                        valid = false;
                        document.getElementById("error3").innerHTML="Required!";
                    } else {
                        document.getElementById("error3").innterHTML="";
                    }
                    if ((document.getElementById("end_date_field").value == "") {
                        valid = false;
                        document.getElementById("error4").innerHTML="Required!";
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


    <div class="mt-5"></div>

    <div class="container">
    <section class="ftco-section">
        <div class="col-md-7 col-lg-5 float-left">
            <?php include "../includes/submit_history.php"; ?>
        </div>
        <div class="col-md-7 col-lg-5 float-right">
            <?php   include "../includes/display_history.php";  ?>
        </div>
    </div>
    </section>
    </body>

</html>
