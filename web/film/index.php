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
</head>
<body onload="loadMovie()">
<?php
    include_once '../headersub.php'
?>
<main class="container back">
    <img class="backdrop" id="Backdrop" src="" alt="backdrop" />
    <section class="movieInfo">
        <h1 id="Title"></h1>
        <p id="Year"></p>
        <p id="Rating"></p>
        <p id="Genre"></p>
        <p id="Runtime"></p>
        <p id="Plot"></p>
        <img src="" id="Poster" alt="Poster" />
    </section>
</main>
<footer></footer>
</body>
</html>
<?php
