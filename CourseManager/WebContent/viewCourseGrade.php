<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Course Manager</title>
<style>
table {
	border-collapse: collapse;
}

table,th,td {
	border: 1px solid black;
}

* {
	margin: 0px auto;
}

html,body {
	text-align: center;
}
</style>
</head>
<body>
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

	$course_name = $_SESSION["view_course_grade"];
	$user_id = $_SESSION["user_id"];


	$result = $conn->query("SELECT * FROM course WHERE course_name = '" . $course_name . "'");

	$counter = mysqli_num_rows($result);

	if($counter > 0){
		$row = $result -> fetch_assoc();
		$course_id = $row['course_id'];


		$res = $conn->query("SELECT * FROM assignment WHERE user_id = '" . $user_id . "' AND course_id = '" . $course_id . "'");

		$count = mysqli_num_rows($res);


		if($count > 0){

			echo "<table>";
			echo "<tr>";
			echo "<td>Assignment Name</td>";
			echo "<td>Weight Category</td>";
			echo "<td>Assignment Grade</td>";
			echo "</tr>";

			for($i = 0; $i < $count; $i++){
				$r = $res -> fetch_assoc();
				$assignment_type_id = $r['assignment_type_id'];
				$assignment_type = "";

				$re = $conn->query("SELECT * FROM assignment_type WHERE assignment_type_id = '" . $assignment_type_id . "'");

				$c = mysqli_num_rows($res);

				if($c > 0){
					$ro = $re -> fetch_assoc();



					echo "<tr>";
					echo "<td>".$r['assignment_name']."</td>";
					echo "<td>". $ro['assignment_type'] ."</td>";
					echo "<td>".$r['assignment_grade']."</td>";
					echo "</tr>";
				}
			}
			echo "</table>";
		} else {
			echo "No assignments have been added for this course!";
		}
	}

	?>

	<br />
	<br />
	<button onclick="location.href = 'courseManager.php';">Home</button>

</body>
</html>
