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
				<h1>Add a New Assignment</h1>
                <form method="post">
				Assignment Type : 
				<select name='assignment_type_select'
			id='assignment_type_select'>
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
			$course_name = $_SESSION["new_assignment_course"];
			$result = $conn->query("SELECT * FROM assignment_type WHERE course_id = (SELECT course_id FROM course WHERE course_name = '" . $course_name . "')");

			$counter = mysqli_num_rows($result);

			if($counter > 0){

			for($i = 0; $i < $counter; $i++){

				$row = $result -> fetch_assoc();
				$assignment_type_name = $row['assignment_type'];
					
				echo "<option value ='" . $assignment_type_name . "'>" . $assignment_type_name . "</option>";
					

			}
		}

		?>
				</select> 
                    <input name="assignment_name" type="text" placeholder="Assignment Name">
                    <input name="assignment_grade" type="text" placeholder="Grade">
                    <button class="btn btn-info btn-block login" type="submit">Add Assignment</button>
                </form>
				<?php

	if (isset($_POST['assignment_type_select'])) {
		$course_name = $_SESSION["new_assignment_course"];
		$result = $conn->query("SELECT course_id FROM course WHERE course_name = '" . $course_name . "'");

		$counter = mysqli_num_rows($result);

		if($counter > 0){
			$row = $result -> fetch_assoc();
			$id = $row['course_id'];

			$assignment_choice = $_POST['assignment_type_select'];


			$res = $conn->query("SELECT * FROM assignment_type WHERE assignment_type = '" . $assignment_choice . "'");

			$count = mysqli_num_rows($res);

			if($count > 0){
				$r = $res -> fetch_assoc();
				$assignment_type_id = $r['assignment_type_id'];
				$assignment_name = $_POST['assignment_name'];
				$assignment_grade = $_POST['assignment_grade'];
				$user_id = $_SESSION["user_id"];

				$sql = "INSERT INTO assignment(user_id, course_id, assignment_name, assignment_type_id, assignment_grade)
					VALUES ('" . $user_id . "','" . $id . "','" . $assignment_name . "','" . $assignment_type_id . "','" . $assignment_grade . "')";
				$conn->query($sql);
			}

			echo "<script> alert('Assignment Updated'); </script>";
			echo "<script> location.replace('courseManager.php'); </script>";
		}
		}
		?>
            </div>
        </div>
        
</div>
</body>
</html>