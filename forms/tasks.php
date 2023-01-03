<!DOCTYPE html>
<!-- Update External Stock 11/22

This page is for users to update each printer's external stock (reams of paper outside the device)
as well as to add notes to any given printer.
 -->
<html>
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




              <br />
  <div class="align-items-center mt-5 table-hover table-back form-back"  style="  border-style:solid;  border-width:5px;  border-color: rgb(255, 150, 40);">

    <?php
          echo "<h2 style='text-align:center'>Stock & Notes</h2>"; #Table title
          echo "<table border='1' class='w-table'>"; # added class w-table to adjust the width of table to fill page
          require "../includes/config.php"; # Database connection
          $sql = "SELECT name, ip, location, external_stock, notes from printer"; #Get info to build table
          $result = $link->query($sql);

          #Each row of the table is its own form, and each form has three submit buttons for three different tasks:
          # 1) Add 1 to external stock
          # 2) Remove 1 from external stock
          # 3) Add notes for a printer
          #
          # All three of these tasks are handled by update_printer.php.
          #
          if ($result->num_rows > 0) {
              echo "<tr><th style='text-align:center'>Name</th><th style='text-align:center'>Location</th><th colspan='3' style='text-align:center'>Stock</th><th colspan='2' style='text-align:center'>Notes</th><tr>";
              while ($row = $result->fetch_assoc()) {
                  echo "<form action='../includes/update_printer.php' method='POST'>";
                  echo "<input type=\"hidden\" name=\"printer_name\" value=\"" . $row["name"] . "\" /> "; #hidden input field needed to pass the printer name to post
                  echo "<tr><td>" . $row['name'] . "</td>";
                  echo "<td>" . $row["location"] . "</td>";
                  echo "<td>" . $row['external_stock'] . "</td>";
                  echo "<td><input id=".$row["name"]."inc type=\"submit\" value='+' name='submit' /></td>";
                  echo "<td><input id=".$row["name"]."dec type=\"submit\" value='-' name='submit'  /></td>";
                  echo "<td><textarea id=".$row["name"]."txt name='notes' placeholder='".$row['notes']."'></textarea></td>";
                  echo "<td><input id=".$row["name"]."addnote type='submit' value='Add Note' name='submit' /></td>";
                  echo "</tr></form>";
              }
          }
          echo "</table>";




?>
</div>

</div>
</body>
</html>
