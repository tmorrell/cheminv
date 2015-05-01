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
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="apple-touch-icon" href="img/apple.png" />
		<title>Login - ecDB</title>
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
					<li><a href="."class="selected"><span class="icon medium key"></span> Login</a></li>
				</ul>
			</div>
			<!-- END -->
			
			<!-- Main content -->
			<div id="content">
				<div class="message green center">
					You have successfully signed out of your account.
				</div>
				
				<div class="loginWrapper">
					<div class="left">
						<form class="globalForms" name="loginForm" method="post" action="login-exec.php">
							<div class="textInput">
								<label class="keyWord">Username</label>
								<div class="input"><input name="login" class="medium" type="text" id="login"/></div>
							</div>
							<div class="textInput">
								<label class="keyWord">Password</label>
								<div class="input"><input name="password" class="medium" type="password" id="password"/></div>
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

