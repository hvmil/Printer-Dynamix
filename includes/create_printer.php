<!--

Description: This file takes in fields from "add_printer" and makes an entry in the printer database, based on those fields.
This is backend processing, and users should not itneract directly with this file.

-->
<!doctype html>
<html>

    <body>
        <?php
            # make a db connection
            require_once "../includes/config.php";

            # assign variables from "add_printer"
            $ip = $_POST["ip_field"];
            $name = $_POST["name_field"];
            $location = $_POST["location_field"];

            # check database to ensure duplicate not added
            $stmt = $link->stmt_init();
	        $stmt = $link->prepare("select ip from printer where ip=?");
            $stmt->bind_param("s",$ip);
	        $stmt->execute();
	        $stmt->bind_result($dip);
	        $stmt->fetch();


            # check if IP is being used before inserting
            if ($dip==$ip){
                $_SESSION["message"] = "IP already registered";
                echo "IP registered";
                header("Location: ../forms/add_printer.php");
            } else {
            
                # inserts the result with the variables into the printer db
                $stmt->free_result();
                $stmt = $link->stmt_init();
                $stmt = $link->prepare("insert into printer(ip,name,location) 
                                        values (?,?,?)");
                $stmt->bind_param("sss", $ip, $name, $location);
                $stmt->execute();
            }
            $_SESSION["message"] = "Printer added successfully";
            header("Location: ../forms/main.php");
          
        ?>
    </body>
</html>