<?php
session_start();

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'luna.temmerman');
define('DB_PASSWORD', '@zerty123!');
define('DB_NAME', 'coproject');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($link === false) {
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$username = $_SESSION['username'];
$id = $_SESSION['id'];

$sql = "SELECT `mail`, `movie_id` FROM `users` WHERE `username`='$username'";
$result = mysqli_query($link, $sql);

if(!$result) {
    die('Kon data niet ophalen: ' . mysqli_error($link));
} else {

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $mail=$row['mail'];
        $movie_id=$row['movie_id'];
    }
}

$link->close();
?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css">
    <title>Film Review - Profiel Pagina</title>
    <link rel="shortcut icon" href="./img/logo.png" type="image/png">
</head>
<body onload="bekekenFilms()">
    <?php
    include_once "header.php";
    ?>
    <main class="marginLeft">
        <h1>Profiel</h1>
        <section>
            <p>Username: <?php echo $username ?></p>
            <p>ID: <?php echo $id ?></p>
            <p>Email: <?php echo $mail ?></p>
            <p id="bekekenFilmId"><?php echo $movie_id ?></p>
        </section>
        <section>
            <h2>Bekeken films</h2>

            <div class="rowSliderDiv profielSlider">
                <div class="prevButton" id="prev7" onclick="slider(true, 7)">&#10094;</div>
                <ul class="rowSliderFlex" id="slider7">
                </ul>
                <div class="nextButton" id="next7" onclick="slider(false, 7)">&#10095;</div>
            </div>
        </section>
    </main>
    <?php
    include_once './footer.php'
    ?>
</body>
</html>


