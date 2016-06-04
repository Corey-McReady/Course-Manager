<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" href="css/bootstrap.css" > </link>
<script type="text/javascript" src="js/bootstrap.js"> </script>
</head>
<body>
<div class="container">

	<div class="login-container">
            <div id="output"></div>
            <div class="form-box">
				<h1>Register For An Account</h1>
                <form method="post">
                    <input name="email" type="text" placeholder="Email">
                    <input name="password" type="password" placeholder="password">
                    <button class="btn btn-info btn-block login" type="submit">Register</button>
                </form>
				<?php
	/* Checks if email has a value */
	if (isset($_POST['email'])) {
		$servername = "localhost:3306";
		$username = "root";
		$password = "root";
		$db = "course_manager";

		$user_email = $_POST['email'];
		$user_password = $_POST['password'];

		// Create connection
		$conn = new mysqli($servername, $username, $password, $db);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$result = $conn->query("SELECT * FROM user WHERE email = '" . $user_email . "'");

		$counter = mysqli_num_rows($result);

		if($counter > 0){
			echo "Email is already in us, please use a different email";
		} else{
			$sql = "INSERT INTO user(email, password)
				VALUES ('" . $user_email . "','" . $user_password . "')";
			$conn->query($sql);

			echo "<script> alert('Account Creation Successful! Login..'); </script>";
			echo "<script> location.replace('index.php'); </script>";
		}
	}
	?>
            </div>
        </div>
        
</div>
</body>
</html>
