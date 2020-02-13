<?php 
	Session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Very cool forum." />
    <meta name="keywords" content="sordes, forum" />
    <title>Sordes</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
	<div id=frame>
	<header>
		<nav class=nav>
			<ul class=navbuttons>
				<li class="homebutton"><a href="index.php">Home</a><li>
			</ul>
			<div class=login>
				<?php 
					if (isset($_SESSION['userId'])) {
						echo '<form action="includes/logout.inc.php" method="post" class="logoutbutton">
							<button type="text" name="logout-submit">Logout</button>
							</form>
							<ul class=navbuttons>
							<li class="messagesbutton"><a href="#">Messages</a><li>
							<li class="profilebutton"><a href="#">Profile</a><li>
							</ul>';
					}
					else {
						echo '<form action="includes/login.inc.php" method="post" class="loginfields">
							<input type="text" name="Uid" placeholder="Username...">
							<input type="password" name="pwd" placeholder="Password...">
							<button type="submit" name="login-submit">Login</button>
							</form>
							<a href="signup.php" class="signupbutton">Signup</a>';
					}	
				?>
				
				
			</div>
		</nav>
	</header>
	