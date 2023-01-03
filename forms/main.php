<!doctype html>
<!-- 
    Main 
    11/13/22 
This is the main landing page for the program. It will display a dashboard for printers needing attention as well
as a list of all printers.
-->

<html>
    <head>
        <title>PrinterDynamix</title>
        <!-- Style sheet setup -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../fonts/icomoon/style.css">
        <link rel="stylesheet" href="../css/owl.carousel.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="icon" href="../img/Printer Dynamix-logos_transparent.png" >
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
<!-- Table -->
<div class="table justify-content-center align-items-center mt-5" >
            <div class="align-items-center mt-5 table-hover table-back">
            <?php
              include "../includes/enhanced_dashboard.php";
              include "../includes/display_printer.php";
            ?>
            </div>

</div>



    </body>
</html>
