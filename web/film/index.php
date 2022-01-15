<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'luna.temmerman');
define('DB_PASSWORD', '@zerty!123');
define('DB_NAME', 'coproject');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Kon niet verbinden: " . mysqli_connect_error());
}

if(isset($_POST['submit'])) {
    $movie_id=$_GET['id'];

    $insert = mysqli_query($link, "INSERT INTO users()")
}

<?>
<!DOCTYPE html>
<html lang="nl">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<script src="./js/index.js"></script>
		<script src="../js/index.js"></script>
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
			integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
			crossorigin="anonymous"
		/>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
			crossorigin="anonymous"
		></script>
		<link rel="stylesheet" href="../css/index.css" />
		<title>Film</title>
		<link rel="shortcut icon" href="../img/logo.png" type="image/png">
	</head>
	<body onload="loadMovie()">
		<?php
			include_once '../headersub.php'
		?>
		<main class="container back">
			<div class="row">
				<div class="col">
					<img class="backdrop" id="Backdrop" src="" alt="backdrop" />
				</div>
			</div>
			<div class="clearfix my-4">
				<img
					src=""
					id="Poster"
					alt="Poster"
					class="col-md-6 float-md-end mb-3 ms-md-3"
					width="100%"
				/>
				<h1 id="Title"></h1>
				<p id="Year"></p>
				<p id="Rating"></p>
				<p id="Genre"></p>
				<p id="Runtime"></p>
				<p id="Plot"></p>

                <form method="post">
                    <button type="submit" name="submit" value="submit">Ik heb deze film gekeken</button>
                </form>

			</div>
		</main>
		<footer></footer>
	</body>
</html>
