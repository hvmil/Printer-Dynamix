<!doctype html>
<!-- index login page V4 11/13/22 
This is the application's landing page. It presents a login form.
Values will be passed via POST to login.php for validation.
-->
<html lang="en">
  <head>
  	<title>Printer Dynamix</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="/PrinterDynamix/img/Printer Dynamix-logos_transparent.png">
	<link rel="stylesheet" href="/PrinterDynamix/css/style.css">

	</head>
	<body >
	
	<section class="ftco-section">
	<?php 
		session_start();
		if (isset($_SESSION["message"])) {
			echo "<div>" . $_SESSION["message"] . "</div>";
		}
		?>
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div class="img" style="background-image: url(/PrinterDynamix/img/Printer\ Dynamix-logos.jpeg);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Welcome!</h3>
			      		</div>
			      	</div>
							<form action="/PrinterDynamix/includes/login.php" method="POST">
			      		<div class="form-group mt-3">
			      			<input type="text" name="username_field" id="username_field" class="form-control" required>
			      			<label class="form-control-placeholder" for="username_field">Username</label>
			      		</div>
		            <div class="form-group">
		              <input id="password_field" name="password_field" type="password" class="form-control" required>
		              <label class="form-control-placeholder" for="password_field">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
		          </form>

		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>


	</body>
</html>
