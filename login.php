<?php
	//Start session
	session_start();

	//Unset the variables stored in session
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
	require_once('include/debug.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="include/style.css" media="screen"/>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<meta name="description" content="Personal inventory database to keep track of chemicals."/>
		<meta name="keywords" content="database, project, inventory"/>
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>ecDB - electronics component DataBase</title>

		<link href="include/jquery.tweet.css" rel="stylesheet">
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script src="include/jquery.tweet.js" charset="utf-8"></script>
		<?php include_once("include/analytics.php") ?>

	</head>
	<body>
		<div id="wrapper">

			<!-- Header -->
			<div id="header">
				<div class="logoWrapper">
					<a href ="."><span class="logoImage"></span></a>
				</div>
			</div>
			<!-- END -->

			<!-- Main menu -->
			<div id="menu">
				<ul>
					<li><a href="." class="selected"><span class="icon medium key"></span> Login</a></li>
					<!--<li><a href="register.php"><span class="icon medium user"></span> Register</a></li>-->
				</ul>
			</div>
			<!-- END -->

			<!-- Main content -->
			<div id="content">
				<div>
					<?php
						if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
							echo '<div class="message red">';
							echo '<ul class="error">';
							foreach($_SESSION['ERRMSG_ARR'] as $msg) {
								echo '<li>',$msg,'</li>';
							}
							echo '</ul>';
							echo '</div>';
							unset($_SESSION['ERRMSG_ARR']);
						}
					?>
				</div>

				<div class="loginWrapper">
					<div class="left">

						<form class="globalForms" name="loginForm" method="post" action="login-exec.php">
							<div class="textInput">
								<label class="keyWord">Username</label>
								<div class="input"><br /><input name="login" value="demo" class="medium" type="text" id="login"/></div>
							</div>
							<div class="textInput">
								<label class="keyWord">Password</label>
								<div class="input"><input name="password" class="medium" value="demo" type="password" id="password"/></div>
							</div>
							<div class="buttons">
								<div class="input">
									<button class="button green" name="Submit" type="submit"><span class="icon medium key"></span> Login</button>
								</div>
							</div>
						</form>
					</div>
					<div class="right"></div>
				</div>
			</div>
			<!-- END -->

			<!-- Text outside the main content -->
			<?php include 'include/footer.php'; ?>
			<!-- END -->

		</div>
	</body>
</html>
