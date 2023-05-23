<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');
        * {
            margin: 0;
            color: black;
            font-family: 'Press Start 2P', cursive;
        }

        body {
            background-color: black;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            width: 90%;
        }

        #name {
            height: 200px;
            width: 100%;
            font-size: 48px;
        }
    </style>
    <title>Name</title>
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('name').focus();
        });
    </script>
</head>
<body>
    <form action="http://localhost:8080/set_name.php" method="post">
        <input type="text" id="name" placeholder="Enter username" name="name" autocomplete="off">
    </form>
</body>
</html>
