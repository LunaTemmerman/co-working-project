<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'luna.temmerman');
define('DB_PASSWORD', '@zerty123!');
define('DB_NAME', 'coproject');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Kon niet verbinden: " . mysqli_connect_error());
}

$id=$_SESSION['id'];
$username=$_SESSION['username'];

?>
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
		<title>Film Review - Film Details</title>
		<link rel="shortcut icon" href="../img/logo.png" type="image/png">
	</head>
	<body onload="loadMovie()">
		<?php
			include_once './headersub.php'
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

                <form method='post'><button class="btn btn-outline-dark" type='submit' name='gekeken' value ='gekeken'>Voeg toe aan kijklijst</button ></form >

                <?php

                if((isset($_POST['gekeken']))&&(isset($_SESSION["id"]))) {
                    $currentMovie_id = $_GET['id'];

                    $sql = "SELECT `movie_id` FROM `users` WHERE `username`='$username'";
                    $result = mysqli_query($link, $sql);

                    if(!$result) {
                        die('Kon data niet ophalen: ' . mysqli_error($link));
                    } else {

                        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                            $existingMovie_id=$row['movie_id'];
                        }
                    }

                    if($existingMovie_id !== "0") {
                        $finalMovie_id = "{$currentMovie_id},{$existingMovie_id}";
                    } else {
                        $finalMovie_id = $currentMovie_id;
                    }

                    $insert = mysqli_query
                    ($link, "UPDATE `users` SET `movie_id`='$finalMovie_id' WHERE `id`='$id'");

                    if (!$insert) {
                        echo "Er ging iets mis!: " . mysqli_error($link);
                    } else {
                        echo "Film is succesvol toegevoegd!";
                    }

                    mysqli_close($link);
                }

                if(((isset($_POST['gekeken']))&&(!isset($_SESSION["id"])))) {
                    header("location: ../login.php");
                }
                ?>

            </div>
		</main>
        <?php
        include_once '../footer.php'
        ?>
	</body>
</html>
