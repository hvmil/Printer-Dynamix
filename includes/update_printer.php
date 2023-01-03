<!--
    Update Stock PHP Backend
    11/22
        Updates external stock for a given printer. No direct user interaction
-->

<!DOCTYPE html>
<html>
    <body>


<?php
    # Ensure this file was accessed correctly.
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        header("Location: ../index.php");
    }
    
    # Increments or decrements the stock.
    # $increase is a Boolean: True if +1, False if -1
    function update_stock($increase){
        require "../includes/config.php";
        #Get current stock
        $stmt = $link->stmt_init();
        $stmt = $link->prepare("select external_stock from printer where name=?");
        $stmt->bind_param("s",$_POST['printer_name']);
        $stmt->execute();
        $stmt->bind_result($cstock);
        $stmt->fetch();

        # Clear the connection
        $stmt->free_result();

        #Increment or Decrement
        if ($increase){
            $cstock = $cstock + 1;
        } else {
            $cstock = $cstock - 1;
            if ($cstock < 0) { # Printer can't be in paper debt.
                $cstock = 0;
            }
        }
        
        #Push new value to the DB
        $stmt = $link->stmt_init();
        $stmt = $link->prepare("update printer set external_stock=? where name=?");
        $stmt->bind_param("ss", $cstock, $_POST['printer_name']);
        $stmt->execute();

        
        #Send back to the printer list
        header("Location: ../forms/tasks.php");
    }

    #Pass the printer name and a new note
    # and the note will be added to the printer object.
    function addNote($printer_name, $note){
        require "../includes/config.php";
        $stmt = $link->stmt_init();
        $stmt = $link->prepare("update printer set notes=? where name=?");
        $stmt->bind_param("ss", $note, $printer_name);
        $stmt->execute();
        header("Location: ../forms/tasks.php");
    }


    # This is the program entry point.
    # Routing is based on which form submission
    # button was selected (+, -, or Add Note)
    if (strcmp($_POST["submit"], '+')==0){
        update_stock(True);
    } elseif (strcmp($_POST["submit"], '-')==0) {
        update_stock(False);
    } else {
        addNote($_POST['printer_name'], $_POST['notes']);
    }
    

    
?>

</body>
</html>