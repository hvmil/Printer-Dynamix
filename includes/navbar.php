<!--
  Navbar
  10/22
  Author: Hamil Dimapanat


  This is the navbar that is displayed throughout the app. It has been abstracted from the individual pages to reduce clutter.
-->

<!DOCTYPE html>
<html>
<header class="site-navbar" role="banner">

<div class="container mb-5">
  <div class="row align-items-center">

  <div class="col-11 col-xl-2">
    <h1 class="mb-0 site-logo">
        <a href="main.php"><img src='../img/Printer Dynamix-transparent 2.png' class="rounded float-left" alt="Logo" width="100" height="auto"></a> <!-- sets logo as home button -->
    </h1>
  </div>

  <div class="col-12 col-md-10 d-none d-xl-block">
    <nav class="site-navigation position-relative text-right" role="navigation">
      <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
        <li><a href="../includes/scraper_manual_start.php"><span>Refresh List</span></a></li>
        <?php if ($_SESSION["is_admin"]==1) { #These links are only shown to application administrators.
              echo "<li><a href='../forms/add_user.php'><span>New User</span></a></li>";
              echo "<li><a href='../forms/add_printer.php'><span>New Printer</span></a></li>";
              echo "<li><a href='../forms/removeprinter.php'><span>Remove Printer</span></a></li>";
            }
            ?>
        <li><a href='../forms/view_history.php'><span>Get History</span></a></li>
        <li><a href="../forms/tasks.php"><span>Tasks</span></a></li>
        <li><a href="../forms/password_change.php"><span>Change Password</span></a></li>
        <li><a href="../forms/about.php"><span>About</span></a></li>
        <li class="active"><a href="../includes/logout.php"><span>Log Out</span></a></li>
      </ul>
    </nav>
  </div>

  <div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

  </div>

</div>
</div>
</header>
</html>