<!--
  Date: 11/12/2022
  Description: This script populates a table with printers that specifically need attention.

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

# query the data base for specific non-functioning printers
$sql = "SELECT printer.status, printer.ip, printer.name, printer.location,
toner_cartridge.color, toner_cartridge.toner_status, toner_cartridge.pages_remaining, printer.external_stock, printer.notes
FROM printer LEFT JOIN toner_map ON 
printer.ip = toner_map.printer_ip
LEFT JOIN toner_cartridge ON
toner_map.toner_serial_number = toner_cartridge.serial_number
WHERE printer.status != 'Ready' AND printer.status != 'Sleep mode on' AND printer.status != 'Exiting sleep mode'
ORDER BY printer.name, toner_cartridge.color";

$result = $link->query($sql);

if ($result->num_rows > 0) {
  echo "<table id='enhanced_printer_display' border='1'>
  <tr>
  <th colspan='9' style='text-align:center'> Printers That Need Attention</th>
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

  # build and print the table
  while ($row = $result->fetch_assoc()) {
    
    
    echo 
    "<tr><td>".$row["status"]."</td><td>"
    ."<a href=http://".$row['ip'].">".$row["ip"]."</a></td><td>"
    .$row["name"]."</td><td>"
    .$row["location"]."</td><td>"
    .$row["color"]."</td><td>"
    .$row["toner_status"]."</td><td>"
    .$row["pages_remaining"]."</td><td>"
    .$row["external_stock"]."</td><td>"
    .$row["notes"]."</td>"
    ."</tr>";
  }
  echo "</table>";
}

?>
</html>