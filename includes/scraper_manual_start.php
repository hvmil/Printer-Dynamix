<!--
    Scraper Manual Start
    10/22
    Calls the scraper aynschronously, and returns to main.
    Ensures that only one instance of the scraper is running.

-->
    <?php 
        # Ensure we have a valid session.
        require("../includes/validate_session.php");

        
        $cmd = "python .\\py\\scraper.py";
        $output = "";
        if (substr(php_uname(), 0, 7) == "Windows"){ # Windows
            exec("tasklist | findstr /i python.exe", $output, $exit_code);
            if ($exit_code == 1) { # if python not currently running
                pclose(popen("start /B ". $cmd, "r")); 
            }
        }
        else { # Unix
            exec("ps aux | pgrep python", $output, $exit_code);
            if ($exit_code == 1) { # if python not currently running
                pclose(popen($cmd . " > /dev/null &", "r"));
            }
        }
        
        
        
        header("Location: ../forms/main.php");
    ?>
