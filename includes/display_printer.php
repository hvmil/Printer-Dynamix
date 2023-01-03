<!--
  Main Printer Dashboard
  Date: October 2022
  Description: This file serves as a dashboard on main.php to display the most important printer info. and all printers.
-->


<!DOCTYPE html>
<html>
<head>
<style>

table

{

    border-style:solid;
    border-width:5px;
    border-color: rgb(255, 150, 40);
}


</style>
  <link rel="stylesheet" type="text/css" href="../css/PrinterDisplay.css">
</head>
<body bgcolor="#ffe6a1">

<?php

# connect to the DB via config.php
include_once "../includes/config.php";

# query the data base for specific info, but display all printers

# sql command to get toner info out of relational databases
$sql = "SELECT printer.status, printer.ip, printer.name, printer.location,
toner_cartridge.color, toner_cartridge.toner_status, toner_cartridge.pages_remaining, printer.external_stock, printer.notes
FROM printer LEFT JOIN toner_map ON 
printer.ip = toner_map.printer_ip
LEFT JOIN toner_cartridge ON
toner_map.toner_serial_number = toner_cartridge.serial_number
ORDER BY printer.name, toner_cartridge.color";
$result = $link->query($sql);

# build the table/column headings 
if ($result->num_rows > 0) {
  echo "<table id='printer_display' border='1'>
  <tr>
  <th colspan='9' style='text-align:center'>All Printers</th>
  </tr>
  <tr>
  <th>Status</th>
  <th>IP</th>
  <th>Name</th>
  <th>Location</th>
  <th>Toner Color</th>
  <th>Toner Status</th>
  <th>Toner Pages Remaining</th>
  <th>External Stock Paper</th>
  <th>Notes</th>
  </tr>";

  # fufills the printer fields into the table itself
  while ($row = $result->fetch_assoc()) {
    
    $external_stock = $row["external_stock"];
    $name = $row["name"];

    echo 
    "<tr><td class='status'>".$row["status"]."</td><td>"
    ."<a href=http://".$row['ip'].">".$row["ip"]."</a></td><td>"
    . $name . "</td><td>"
    .$row["location"]."</td><td>"
    .$row["color"]."</td><td>"
    .$row["toner_status"]."</td><td>"
    .$row["pages_remaining"]."</td><td>"
    .$row["external_stock"]."</td><td>"
    .$row["notes"]."</td>"
    ."</tr>";
  }
  # print the table
  echo "</table>";
}

# cloes the link toe the sql database
$link->close();

?>
</html>