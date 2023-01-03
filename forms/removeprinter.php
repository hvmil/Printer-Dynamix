<!DOCTYPE html>
<!-- Remove Printer V1 11/13/22 
This page is for admin users to delete printers from the database -->
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
        <script>
            function verify_action(printer_name){ //Function simply confirms the action
              return confirm("Are you sure you want to delete " + printer_name + "?");
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
    <?php include "../includes/navbar.php" ?>



      <div class="mt-5"></div>
      <!-- Table -->
      <div class="table justify-content-center align-items-center mt-5" >


<!-- added new div file because of odd nature of form in main  -->

              <br />
  <div class="align-items-center mt-5 table-hover table-back form-back"  style="  border-style:solid;  border-width:5px;  border-color: rgb(255, 150, 40);">
<!-- ran into an error with the form-back class not applying did as inline style -->
    <?php
          echo "<h2>Select printer to delete:</h2>";
          echo "<table border='1' class='w-table'>";
          require "../includes/config.php";
          $sql = "SELECT name, ip, location from printer";
          $result = $link->query($sql);

          if ($result->num_rows > 0) {                                # Display each printer within a form along
              while ($row = $result->fetch_assoc()) {                 # with a corresponding delete button
                  echo "<form action='../includes/remove_printer.php' method='POST' onsubmit='return verify_action(\"" . $row["name"] . "\")'>";
                  echo "<input type=\"hidden\" name=\"name_field\" value=\"" . $row["name"] . "\" /> "; #hidden input field needed to pass the value to post
                  echo "<tr><td>" . $row['name'] . "</td>";
                  echo "<td>" . $row["location"] . "</td>";
                  echo "<td>" . $row['ip'] . "</td>";
                  echo "<td><input type=\"submit\" value='Delete' /></td>";
                  echo "</tr></form>";
              }
          }
          echo "</table>";




?>
</div>

</div>
</body>
</html>
