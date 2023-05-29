<?php
/*
	$name = $_REQUEST['name'];
	$score = $_REQUEST['score'];

	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "gamecarnival";

	$conn = mysqli_connect($host, $user, $password, $db);
	if (!$conn) {
		die("FAILURE: " . mysqli_connect_error());
	}

	$query = "INSERT INTO personer (RFID, SCORE, NAMN) VALUES ('" . rand() . "', '" . $score . "', '" . $name . "')";
	echo $query;

	mysqli_query($conn, $query);
	*/
?>

<script>
	ws = new WebSocket("ws://127.0.0.1:8000");
	ws.onopen = function() {
		request = {
			"play": 1
		};
		ws.send(request);
	}
</script>