<?php
// Start the session
session_start();
?>
<!DOCTYPE>
<html>
<meta charset="ISO-8859-1">
<header>
<link rel="stylesheet" href="css/bootstrap.css" > </link>
<script type="text/javascript" src="js/bootstrap.js"> </script>
</header>
<body>
<div class="container">

	<div class="login-container">
            <div id="output"></div>
            <div class="form-box">
				<h1>Course Manager</h1>
                <form method="post">
                    <input name="email" type="text" placeholder="Email">
                    <input name="password" type="password" placeholder="password">
                    <button class="btn btn-info btn-block login" type="submit">Login</button>
                    <button class="btn btn-info btn-block login" type="button" onclick="location.href = 'register.php;">Register</button>
                </form>
				<?php
	$servername = "localhost:3306";
	$username = "root";
	$password = "root";
	$db = "course_manager";


	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	if (isset($_POST['email'])){

			$email = $_POST['email'];
			$password = $_POST['password'];
			$login = FALSE;

			$result = $conn->query("SELECT * FROM user WHERE email = '" . $email . "'");

			$counter = mysqli_num_rows($result);

			if($counter > 0){
				$row = $result -> fetch_assoc();

				$actual_password = $row['password'];
				if($password == $actual_password){
					$_SESSION["user_id"] = $row['user_id'];
					echo "<script> location.replace('courseManager.php'); </script>";
				} else{
					echo "Invalid Login Info";
				}
			} else {
				echo "Invalid Login Info";
			}
		}

		?>
            </div>
        </div>
        
</div>

</body>
</html>
	

