<!-- Muhammad Nur Taufiq (L200190085) -->
<!DOCTYPE html>
<html>
	<head>
		<title>Register</title>
		<?php
			require 'function.php';
			if(isset($_POST['register'])){
				if(register() > 0){
					echo "<script>
						alert('Registration Success!')
				</script>";
				}
				else{
					echo mysqli_error($conn);
				}
			}
		?>
	</head>
	<body>
		<center>
			<form method="POST" action="">
        		<h1>Account Registration</h1>
				<h3>ID : <input type="text" name="user" placeholder="input ID"></h3>
				<h3>Password : <input type="password" name="password" placeholder="input password"></h3>
				<h3>Confirm : <input type="password" name="confirm" placeholder="confirm password"></h3>
				<br>
				<input type="submit" name="register" value="Register">
				<br><br>
				<p>Already have an account? </p><a href="login.php">Login</a>		
			</form>
		</center>
	</body>
</html>