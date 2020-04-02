<?php
	require 'header.php';
?>
	
	<main>
	
		<div class="wrapper-main">
			<section class="section-default">
				<form class="form-signup" action="includes/signup.inc.php" method="post">
					<input type="text" name="uid" placeholder="Username">
					<input type="text" name="mail" placeholder="E-mail">
					<input type="password" name="pwd" placeholder="Password">
					<input type="password" name="pwd-repeat" placeholder="Repeat Password">
					<button type="submit" name="signup-submit">Submit</button>
				</form>
				<?php
					if (isset($_GET['signup'])) {
						if ($_GET['signup'] = "success") {
							echo 'You have succesfully registered';
						}
						else {
							echo '';
						}
					}
					if (isset($_GET['error'])) {
						echo 'Problem with credentials, signup unsuccesful';
					}
					else {
						echo '';
					}
				?>
			</section>
		</div>
	
	</main>
	
<?php
	require "footer.php";
?>