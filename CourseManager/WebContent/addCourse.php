<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
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
				<h1>Course Manager</h1>
				</br>
				<script>
				function add(num){

		var assignmentTypes = parseInt(num);
		for (i = 0; i < assignmentTypes; i++) {
		
		//Create an input type dynamically.
        var element = document.createElement("input");
     
        //Assign different attributes to the element.
        element.setAttribute("type", "text");
        element.setAttribute("name", "assignment".concat(i));
		
		//Create an input type dynamically.
        var element2 = document.createElement("input");
     
        //Assign different attributes to the element.
        element2.setAttribute("type", "text");
        element2.setAttribute("name", "weight".concat(i));
        
     
     
        var newCat = document.getElementById("course");
     
        //Append the element in page (in span).
		newCat.appendChild(document.createTextNode("Assignment Category: "));
        newCat.appendChild(element);
		newCat.appendChild(document.createTextNode(" Weight: "));
		newCat.appendChild(element2);
		newCat.appendChild(document.createElement("br"));
		newCat.appendChild(document.createElement("br"));
		}
}


				</script>
                <form method="post">
					<br /> <br /> <span id="course"></span>
                    <button class="btn btn-info btn-block login" type="submit">Add Course</button>
                </form>
				<?php
	$num = $_SESSION["num_types"];
	$percent_total = 0;

	echo '<script type="text/javascript">'
		, 'add(' . $num . ');'
		, '</script>';
	if (isset($_POST['weight0'])) {
		for ($x = 0; $x < $num; $x++) {
			$temp = $_POST['weight' . $x];
			$percent_total = $percent_total + $temp;

		}
		if($percent_total != 100){
			echo "Weights do not equal 100";
		} else{
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

			$course_name = $_SESSION["course_name"];

			$result = $conn->query("SELECT * FROM course WHERE course_name = '" . $course_name . "'");

			$counter = mysqli_num_rows($result);

			if($counter > 0){
				$row = $result -> fetch_assoc();
				$course_id = $row['course_id'];
				$id = $_SESSION["user_id"];
				$sql = "INSERT INTO course_lookup(course_id, user_id)
				VALUES ('" . $course_id . "' ,'" . $id . "')";
				$conn->query($sql);
				echo "<script> alert('Course already existed Has been added'); </script>";
				echo "<script> location.replace('courseManager.php'); </script>";

			} else {
				$sql = "INSERT INTO course(course_name)
				VALUES ('" . $course_name . "')";

				$conn->query($sql);

				$result = $conn->query("SELECT * FROM course WHERE course_name = '" . $course_name . "'");

				$counter = mysqli_num_rows($result);

				if($counter > 0){
					$row = $result -> fetch_assoc();
					$course_id = $row['course_id'];
					$id = $_SESSION["user_id"];
					$sql = "INSERT INTO course_lookup(course_id, user_id)
				VALUES ('" . $course_id . "' ,'" . $id . "')";

					$conn->query($sql);



					for ($y = 0; $y < $num; $y++) {
						$assignment_type = $_POST['assignment' . $y];
						$assignment_weight = $_POST['weight' . $y];
						$sql = "INSERT INTO assignment_type(course_id, assignment_type, weight_percent)
					VALUES ('" . $course_id . "', '" . $assignment_type . "', '" . $assignment_weight . "')";

						$conn->query($sql);
					}
					echo "<script> alert('Course Added'); </script>";
					echo "<script> location.replace('courseManager.php'); </script>";

				}

			}


		}


	}
	?>
            </div>
    </div>        
</div>
</body>
</html>

