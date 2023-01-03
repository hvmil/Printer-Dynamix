<!--
    Remove Printer
    11/22
    Removes a printer from the database. Backend script. No direct user interaction
-->

<!DOCTYPE html>
<html>
    <body>


<?php
    # Ensure this file was accessed correctly.
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header("Location: ../index.php");
    }
    #DB Connection
    require_once "../includes/config.php";

    #Printer Deletion
    $stmt = $link->stmt_init();
	$stmt = $link->prepare("delete from printer where name=?");
    $stmt->bind_param("s",$_POST['name_field']);
	$stmt->execute();

    #Send back to the printer list
    header("Location: ../forms/removeprinter.php");

    

    
?>

</body>
</html>