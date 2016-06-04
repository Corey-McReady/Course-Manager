<?php
// Start the session
session_start();
?>
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
				<h1>Course Select</h1>
				</br>
				</br>
                <form method="post">
						<select name='course_select' id='course_select'>

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

			$id = $_SESSION["user_id"];

			$result = $conn->query("SELECT * FROM course_lookup WHERE user_id = '" . $id . "'");

			$counter = mysqli_num_rows($result);

			if($counter > 0){

					

				for($i = 0; $i < $counter; $i++){

					$row = $result -> fetch_assoc();
					$course_id = $row['course_id'];


					$res = $conn->query("SELECT * FROM course WHERE course_id= '" . $course_id . "'");

					$count = mysqli_num_rows($res);

					if($count > 0){
					$r = $res -> fetch_assoc();
					$course_name = $r['course_name'];
					echo "<option value ='" . $course_name . "'>" . $course_name . "</option>";

				}
				}
			} else {
			echo "<script> alert('No Course Available'); </script>";
			echo "<script> location.replace('courseManager.php'); </script>";
		}

		?>

						</select>
                    <button class="btn btn-info btn-block login" type="submit">Next</button>
					</br>
					</br>
                </form>
					<?php

	if (isset($_POST['course_select'])) {
			$_SESSION["new_assignment_course"] = $_POST['course_select'];

			echo "<script> location.replace('newAssignment.php'); </script>";

		}
		?>
            </div>
     </div>
        
</div>
</body>
</html>