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
				<h1>Create New Course</h1>
                <form method="post">
                    <input name="course_name" type="text" placeholder="Course Name">
                    <input name="num_types" type="password" placeholder="Assignment Types">
                    <button class="btn btn-info btn-block login" type="submit">Next</button>
                </form>
					<?php
	/* Checks if email has a value */
	if (isset($_POST['course_name'])) {
		$_SESSION["course_name"] = $_POST['course_name'];
		$_SESSION["num_types"] = $_POST['num_types'];
		echo "<script> location.replace('addCourse.php'); </script>";
	}
	?>
            </div>
        </div>
        
</div>
</body>
</html>
