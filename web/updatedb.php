<?php
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
?>
