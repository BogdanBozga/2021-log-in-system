  

<div>
	<h2>Sing up</h2>
	<form action="include/signup.inc.php" method="post"><br>
	<input type="text" name="name" placeholder="Full name"><br>
	<input type="text" name="email" placeholder="email"><br>
	<input type="text" name="uid" placeholder="Username"><br>
	<input type="password" name="pwd" placeholder="password"><br>
	<input type="password" name="pwd_repeat" placeholder="password"><br>
	<button type="submit" name="submit"> Sign up</button><br>
	</form>
	<?php
	if(isset($_GET["error"])){
		if($_GET["error"] == "emptyinput"){
			echo "<p> Camp necompletat!</p>";
		}
		if($_GET["error"] == "invalid_username"){
			echo "<p> Username invalid!</p>";
		}

		if($_GET["error"] == "invalid_email"){
			echo "<p> Email invalid!</p>";
		}

		if($_GET["error"] == "invalid_password"){
			echo "<p> Parolele nu coincid!</p>";
		}

		if($_GET["error"] == "username_take"){
			echo "<p> Username deja luat!</p>";
		}
		if($_GET["error"] == "stmt_fail"){
			echo "<p> ERROR!</p>";
		}
		if($_GET["error"] == "none"){
			echo "<p> Inscriere reusita!</p>";
		}
	}
	?>
</div>

