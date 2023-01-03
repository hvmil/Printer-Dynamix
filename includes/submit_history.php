<!--
  History Table Submission Box
  Description: This file builds a submission box for viewing a printer's consumption history
-->
<div class="container">
    <div class="row justify-content-center">
    <div class="wrap">
        <div class="img" style="background-image: url(../img/Printer\ Dynamix-logos.jpeg);"></div>
    <div class="login-wrap p-4 p-md-5">
        <div class="d-flex">
        <div class="w-100">
            <h3 class="mb-4">View History</h3>
        </div>
        </div>
<!-- Builds the input boxes for the user to select printer name, toner color, how long to go back-->
            <div class="table justify-content-center align-items-center" >
            <!--div class="align-items-center mt-5 table-responsive table-secondary" -->
                <table class="table-borderless" style="outline-style:none">
                <form action="view_history.php" onsubmit="return validateForm()" method="POST">
                    <tr>
                        <td>
                            <label for="name_field">Printer Name</label>
                        </td>

                        <td>
                            <input list="names" class="form-control" name="name_field" id="name_field" alt="Enter Name"/>
                                <!-- get datalist of printer names from db -->
                                <?php
                                // connect to the DB via config.php
                                include_once "../includes/config.php";
                                // echo "test";
                                echo "<datalist id='names'>";

                                // Get all names from printer table
                                $sql = "SELECT name FROM printer";
                                $result = $link->query($sql);

                                if ($result->num_rows > 0)  {
                                while ($row = $result->fetch_assoc()) {
                                    $name = $row["name"];
                                    //echo $name;
                                    echo "<option value=".$name.">";
                                }
                                } else {
                                echo "No printers to list";
                                }

                                echo "</datalist>";
                                ?>
                        </td>

                        <td>
                            <div class="error" id="error1"></div>
                        </td>

                    </tr>
                    <tr>

                        <td>
                            <label for="color_field">Toner Color</label>
                        </td>

                        <td>
                            <select type="text" class="form-control" name="color_field" id="color_field" alt="Enter toner color" />
                                <option value="black" selected>Black</option>
                                <option value="cyan">Cyan</option>
                                <option value="magenta">Magenta</option>
                                <option value="yellow">Yellow</option>
                        </td>

                        <td>
                            <div class="error" id="error2"></div>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="start_date_field">From: </label></td>

                        <td><input type="date" class="form-control" name="start_date_field" id="start_date_field" alt="Enter starting date" /></td>
                        <td><div class="error" id="error3"></div></td>
                    </tr>
                    <tr>
                        <td>
                            <label for="end_date_field">To: </label>
                        </td>

                        <td>
                            <input type="date" class="form-control" name="end_date_field" id="start_date_field" alt="Enter ending date" />
                        </td>

                        <td>
                            <div class="error" id="error4"></div>
                        </td>
                    </tr>
                    <tr>
                        <td></td> <!-- added to move submit under user input boxs -->
                        <td>
                            <input type="submit" class="form-control btn btn-primary rounded submit px-3" value="Submit" alt="submit" />
                        </td>
                        <td></td>
                    </tr>
                </form>
                </table>
            </div>
    </div>
    </div>
    </div>
</div>