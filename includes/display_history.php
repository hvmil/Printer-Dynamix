<!--
  History Table Display
  Author: Zed Fermon

  Description: This file builds a table for a given printer displaying the consumption history over the given (POSTed) date range
-->


<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" type="text/css" href="../css/PrinterDisplay.css">
</head>
<!-- UI update: John Waffenschmist 12/3/22 -->
<body class="table-back form-back">



<?php

# Check if args have been submitted
if(isset($_POST["name_field"]) && isset($_POST['color_field']) && isset($_POST['start_date_field']) && isset($_POST['end_date_field'])) 
{
  # connect to the DB via config.php
  include_once "../includes/config.php";

  # get vars from post array
  $name = $_POST["name_field"];
  $color = $_POST["color_field"];
  $startDate = $_POST["start_date_field"];
  $endDate = $_POST["end_date_field"];


  $sql = "SELECT day_measured, consumption FROM `printer_history`
      WHERE printer_name=? AND toner_color=? AND day_measured>=? AND day_measured<=?";

  $stmt = $link->stmt_init();
  $stmt = $link->prepare($sql);
  $stmt->bind_param("ssss", $name, $color, $startDate, $endDate);
  $stmt->execute();
  $stmt->bind_result($day, $consumption);


    echo "<div class='login-wrap p-4 p-md-5 justify-content-center align-content-start align-items-center'>
    <table class='table table-back'>
    <tr>
    <th colspan='2' style='text-align:center'>History for $name</th>
    </tr>
    <tr>
    <th>Day</th>
    <th>Consumption</th>
    </tr>";

    while ($stmt->fetch()) {
      echo
      "<tr>
        <td>$day</td>
        <td>$consumption</td>
      <tr>";
    }
    echo "</table>";


  $link->close();
}


?>


</html>
