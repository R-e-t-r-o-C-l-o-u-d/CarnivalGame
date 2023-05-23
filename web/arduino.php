<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Scoreboard</title>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
		* {
			margin: 0;
			color: white;
		  font-family: 'Press Start 2P', cursive;
		}

		/* Set the background color of the page to black */
		body {
		  background-color: black;
		}

		/* Style the scoreboard container */
		#scoreboard-container {
		  margin: 0 auto;
		  width: 600px;
		  font-size: 24px;
		}

		/* Style the table */
		table {
		  border-collapse: collapse;
		  width: 100%;
		}

		/* Style the table header */
		th {
		  background-color: black;
		  font-size: 35px;
		  color: white;
		  text-align: center;
		  padding: 30px;
		}

		/* Style the table cells */
		td {
		  background-color: black;
		  color: white;
		  text-align: center;
		  padding: 15px;
		  border-bottom: 0px dashed rgba(255, 255, 255, 0.35);
		}

		/* Style the first column */
		td:first-child {
		  font-size: 28px;
		}

		tr:nth-child(even) td {
		  background-color: #333;
		}

		#currently-playing-container {
			display: none;
		}

		.playing-as {
			position: fixed;
			left: 50%;
			bottom: 20px;
			transform: translate(-50%, -50%);
			margin: 0 auto;
		}

		.score {
			position: fixed;
			font-size: 175px;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			margin: 0 auto;
		}

		#press-enter {
		  position: fixed;
		  left: 50%;
		  bottom: 20px;
		  transform: translateX(-50%);
		  text-align: center;
		  font-size: 24px;
		}
	</style>
</head>
<body>
	<p id="press-enter">Press enter to start</p>
<div class="scoreboard-container" id="scoreboard-container">
<table>
	<tr>
		<th>SCORE</th>
		<th>NAME</th>	
	</tr>
	<tr>
	<?php
	echo '<input type="hidden" name="usrname" id="usrname" value="' . $_SESSION['name'] . '">';
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "gamecarnival";

	$conn = mysqli_connect($host, $user, $password, $db);
	if (!$conn) {
		die("FAILURE: " . mysqli_connect_error());
	}

$result = mysqli_query($conn, "SELECT SCORE, NAMN FROM personer ORDER BY SCORE DESC LIMIT 10");
$num_rows = mysqli_num_rows($result);

// Display the rows from the query
mysqli_data_seek($result, 0); // reset the result pointer to the first row
while ($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row["SCORE"] . "</td>";
  echo "<td>" . strtoupper($row["NAMN"]) . "</td>";
  echo "</tr>";
}

if ($num_rows < 10) {
  for ($i = $num_rows + 1; $i <= 10; $i++) {
    echo "<tr>";
    echo "<td>0</td>";
    echo "<td>UNKNOWN</td>";
    echo "</tr>";
  }
}
?>

	</tr>
</table>
</div>

<div id="currently-playing-container">

	<p id="score" class="score"></p>
	<p class="playing-as" id="playing-as"></p>
</div>

<script>

const ws = new WebSocket('ws://localhost:8000');
let DataStatus;
var usrnameInput = document.getElementById('usrname');
var usrnameValue = usrnameInput.value;

ws.addEventListener('error', function(event) {
	//document.getElementById("scoreboard-container").style.display = "block";
	//document.getElementById("currently-playing-container").style.display = "none";
  console.log('WebSocket connection error:', event);
  //setInterval(window.location.reload(), 0)
});

ws.addEventListener('message', function (event) {
  var data = JSON.parse(event.data);
  DataStatus = data.status;
  if (data.status == 1) {
			document.getElementById("scoreboard-container").style.display = "none";
			document.getElementById("currently-playing-container").style.display = "block";

			document.getElementById('playing-as').innerHTML = "Playing as " + usrnameValue;
			document.getElementById('score').innerHTML = data.score;
		}
	else {
    // On stand-by, update database after previous game.
    function updateDatabase(name, score) {
      var url = 'updatedb.php?name=' + encodeURIComponent(usrnameValue) + '&score=' + encodeURIComponent(score);

      var xhr = new XMLHttpRequest();
      xhr.open('GET', url, true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          var response = xhr.responseText;
          console.log(response);
          window.location.reload(); // Reload the page after the entry is added to the database
        }
      };
      xhr.send();
    }
    updateDatabase(usrnameValue, data.score);
  }
});

document.addEventListener("keyup", function(event) {
  if (event.keyCode === 13 && DataStatus != 1) {
  	window.location.href = '.'
  }
});

</script>

</body>
</html>