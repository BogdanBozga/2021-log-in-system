
<div >
	<h2>Log in</h2>
	<form action='include/login.inc.php' method="post">
		<input type="text" name="user_mail" placeholder="Username/Email">
		<input type="password" name="pwd_log" placeholder="password">
		<button type="submit" name="submit"> Log in</button>
	</form>
	<?php
	if(isset($_GET["error"])){
		if($_GET["error"] == "empty_input"){
			echo "<p> Camp necompletat!</p>";
		}
		if($_GET["error"] == "loging_failed"){
			echo "<p> Username/email sau parola incorect introdus!</p>";
		}
	}
	?>
</div>