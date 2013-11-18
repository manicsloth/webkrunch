<?php
//admin login front page. login process handled by login_script.php
	$title="Admin Login";
	require"header.php";
?>

<img src="images/logo-light.png" id="logo">
<fieldset id="loginform">
	<legend>
		Admin Login
	</legend>
	<form action="login_script.php" method="post">
		<label for="name"> 
			Username:
		</label>
		<br />
		<input type="text" name="username" id="username" size="34"<?php if(isset($_SESSION['login_username'])){ echo "value='$_SESSION[login_username]'";}?>/>
		<br />
		<label>
			Password:
		</label>
		<br />
		<input type="password" name="password" id="password" size="34"< />
		<br />
		<input type = "checkbox" name="remeber" id="remeber">
		<label for="remeber">
			Remember me
		</label>

		<hr />
		<?php
			if (isset($_SESSION['loginerrors']) && !empty($_SESSION['loginerrors'])){
				echo "<p id='loginerrors'>*" . $_SESSION['loginerrors'] .  "</p>";
			}
		?>
		<input type="submit" value="Login" id="submit" />
	</form>
</fieldset>

<p id="warning">
	This page is for administration use only, if you do not belong here please
	<a href="http://www.walkkernow.co.uk/">
		click this here
	</a>
	to return to the Walk Kernow website.
	
</p>


</body>
</html>