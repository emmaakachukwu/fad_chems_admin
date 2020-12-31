<?php

session_start();

$app_name = 'fad chemicals';
$title = ucfirst($title ?? 'Home');

function session_val(string $key): string {
	return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
}

function clear_sessions(): void {
	foreach ( $_SESSION as $key => $value ) {
		if ( $key != 'user' )
			unset($_SESSION[$key]);
	}
}

function toast_errors(): void {
    if ( isset($_SESSION['errors']) && count($_SESSION['errors']) ) {
        foreach ( $_SESSION['errors'] as $error ) {
          echo "<script>toastr.error('$error')</script>";
        }
        unset($_SESSION['errors']);
    }

    if ( isset($_SESSION['success']) && count($_SESSION['success']) ) {
        foreach ( $_SESSION['success'] as $msg ) {
          echo "<script>toastr.success('$msg')</script>";
        }
        unset($_SESSION['success']);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title><?php echo ucfirst($title) . ' | ' . strtoupper($app_name) ?> | Admin</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Redressed&display=swap" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
    
    <!--  FOR TOASTR -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
	<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
</head>
<body class="login-page">
	<?php toast_errors() ?>
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="./index.php">
					<h4 style="color: #000; font-family: 'Redressed', cursive; text-decoration: none; font-weight: 900; font-size: 28px;">
						<?php echo strtoupper($app_name) ?>
					</h4>
				</a>
			</div>
			<div class="login-menu nav-menu">
				<ul>
					<li>
						<h4 class="text-center text-primary">Admin</h4>
					</li>
				</ul>
			</div>
		</div>
	</div>