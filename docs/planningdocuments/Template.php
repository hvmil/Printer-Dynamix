<!doctype html>
<!-- Templet V1 11/13/22 John Waffenschmidt, [name_here],[calen]
A bare template of the main page design to add php code to for making new pages if needed. -->

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
            require_once "validate_session.php";
            if (isset($_SESSION["message"])){
                echo $_SESSION["message"];
                echo "<br /><br />";
                unset($_SESSION["message"]);
            }
    ?>
    <!-- navbar -->
    <header class="site-navbar" role="banner">

  <div class="container mb-5">
    <div class="row align-items-center">

    <div class="col-11 col-xl-2">
      <h1 class="mb-0 site-logo">
          <a href="main.php"><img src='images/Printer Dynamix-transparent 2.png' class="rounded float-left" alt="Logo" width="100" height="auto"></a> <!-- sets logo as home button -->
      </h1>
    </div>

    <div class="col-12 col-md-10 d-none d-xl-block">
      <nav class="site-navigation position-relative text-right" role="navigation">
        <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
          <li><a href="scraper_manual_start.php"><span>Refresh List</span></a></li>
          <li><a href="add_printer.php"><span>New Printer</span></a></li>
          <?php if ($_SESSION["is_admin"]==1) {
                echo "<li><a href='add_user.php'><span>New User</span></a></li>";
              }
              ?>
          <li><a href='removeprinter.php'><span>Remove Printer</span></a></li>
          <li><a href="password_change.php"><span>Change Password</span></a></li>
          <li><a href="about.php"><span>About</span></a></li>
          <li class="active"><a href="index.php"><span>Log Out</span></a></li>
        </ul>
      </nav>
    </div>

    <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

    </div>

  </div>
</div>
</header>



<div class="mt-5"></div>
<!-- Add content here

-

-

-


-->


    </body>
</html>
