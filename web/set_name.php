<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Set name</title>
</head>
<body>
	<?php
		$_SESSION['name'] = $_REQUEST['name'];
		header('Location: http://localhost:8080/arduino.php')
	?>
</body>
</html>