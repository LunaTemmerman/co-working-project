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
    <title>Home</title>
    <link rel="shortcut icon" href="../img/logo.png" type="image/png">
</head>
<body onload="loadSearch()">

<?php
include_once './headersub.php';
?>

<main class="container mt-5">
    <h1>Zoek naar je favoriete film</h1>
    <section class="d-flex justify-content-center">
        <form action="javascript:searchBox('zoekIn')" method="post">
            <div class="row">
                <div class="col-sm-7">
                    <input
                        class="form-control form-control-lg"
                        type="search"
                        name="zoekbalk"
                        id="zoekbalk"
                    />
                </div>
                <div class="col-sm">
                    <input
                        class="btn btn-lg btn-outline-dark"
                        type="submit"
                        value="Zoek 🔎︎"
                    />
                </div>
            </div>
        </form>
    </section>
    <section class="mt-5" id="zoek">
        <h2>Zoekresultaaten</h2>
        <div id="films">
            <!-- Deze kaart wortd per zoekresultaat weergegeven
        <div class="card h-100 moviecard">
            <a href="./film/?id=${json.results[i].id}">
                <img id="img1.${i+1}" src="https://image.tmdb.org/t/p/w300${json.results[i].poster_path}" class="card-img-top" alt="Poster ${json.results[i].title}">
                <div class="card-body">
                    <h5 id="title1.${i+1}" class="card-title">${json.results[i].title}</h5>
                </div>
            </a>
        </div>
        -->
        </div>
    </section>
</main>
<footer></footer>
</body>
</html>
