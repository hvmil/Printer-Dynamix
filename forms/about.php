<!--
Date: 11/6/22
Description: This file describes the fundamentals of the project, credit to group memebers, and general info about the project.
-->

<!DOCTYPE html>
<html lang="en">
<head>
<title>PrinterDynamix</title>
        <!-- Styple sheet setup -->
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../fonts/icomoon/style.css">
        <link rel="stylesheet" href="../css/owl.carousel.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="icon" href="../img/Printer Dynamix-logos_transparent.png" >
    </head>
</head>

<body class="container d-flex flex-column" id="body-background">
    <!-- navbar -->
    <?php
    require_once "../includes/validate_session.php";
    if (isset($_SESSION["message"])){
        echo "div" . $_SESSION["message"] . "</div>";
        echo "<br /><br />";
        unset($_SESSION["message"]);
    }

    include "../includes/navbar.php" ;


    ?>
    <div class="mt-5"></div>
    <div class="mt-5"></div>
    <div class="container mt-5 ">

    <!-- <h3 style="font-size: 24px; background: -webkit-linear-gradient(#E9721B, #FFF); -webkit-background-clip: text;-webkit-text-fill-color: transparent;"> -->
    <h3 class="about-us">
  <div class="about-us-1 text-muted">
    <!-- optinal change to make about us page look more inline with other pages -->
    This project serves to provide SUNY New Paltz with a printer application that betters their current application.
    It provides information about all printers on campus, including two dashboards: one that is comprehensive of all
    printers and one that filters to show printers requiring specific attention. It also has functionalities like
    connecting to the New Paltz local network to update the current list of printers, manual additon of printers,
    the ability to update external paper stock, the addition of being able to remove printers from the list and a login system.
    <!-- <br /><br /><br /> -->
    </div>
  </h3>
  <br>
  <h3 class="about-us">
  <div class="about-us-1 text-muted">
    This project was originally taken on by Zedekiah Fermon to give SUNY New Paltz a more robust printer dashboard application.
    Conceptualized and created with the help of the following people, and their code focus:<br /><br />

<ul class="about=-us-1 text-muted">
    <li>Zedekiah Fermon (Original Project Contact & coder of Python scripts and Printer Scraper)</li>
    <li>Calen Sullivan (Group Leader & coder of PHP functions)</li>
    <li>Steve Cina (Database Administrator, coder of login pages & general coding wizard)</li>
    <li>John Waffenschmit (Website Design & UI)</li>
    <li>Hamil Dimanapat (Website Design & UI)</li>
</ul>
</div>
</h3></div>
</body>
</html>
