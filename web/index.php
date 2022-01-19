<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./js/index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="shortcut icon" href="./img/logo.png" type="image/png">
</head>
<body onload="apiSlider()">
<?php
    include_once 'header.php';
?>
<Main class="home">
    <section>
        <h2>Populaire films</h2>
        <div class="rowSliderDiv">
            <div class="prevButton" id="prev0" onclick="slider(true, 0)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider0"></ul>
            <div class="nextButton" id="next0" onclick="slider(false, 0)">&#10095;</div>
        </div>
    </section>
    <section>
        <h2>Top 20 beste avontuur films</h2>

        <div class="rowSliderDiv">
            <div class="prevButton" id="prev1" onclick="slider(true, 1)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider1"></ul>
            <div class="nextButton" id="next1" onclick="slider(false, 1)">&#10095;</div>
        </div>
    </section>
    <section>
        <h2>Top 20 beste horror films</h2>
        <div class="rowSliderDiv">
            <div class="prevButton" id="prev2" onclick="slider(true, 2)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider2"></ul>
            <div class="nextButton" id="next2" onclick="slider(false, 2)">&#10095;</div>
        </div>
    </section>
    <section>
        <h2>Top 20 beste animatie films</h2>
        <div class="rowSliderDiv">
            <div class="prevButton" id="prev3" onclick="slider(true, 3)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider3"></ul>
            <div class="nextButton" id="next3" onclick="slider(false, 3)">&#10095;</div>
        </div>
    </section>
    <section>
        <h2>Top 20 beste komedie films</h2>
        <div class="rowSliderDiv">
            <div class="prevButton" id="prev4" onclick="slider(true, 4)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider4"></ul>
            <div class="nextButton" id="next4" onclick="slider(false, 4)">&#10095;</div>
        </div>
    </section>
    <section>
        <h2>Top 20 beste drama films</h2>
        <div class="rowSliderDiv">
            <div class="prevButton" id="prev5" onclick="slider(true, 5)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider5"></ul>
            <div class="nextButton" id="next5" onclick="slider(false, 5)">&#10095;</div>
        </div>
    </section>
    <section>
        <h2>Top 20 beste trillers</h2>
        <div class="rowSliderDiv">
            <div class="prevButton" id="prev6"  onclick="slider(true, 6)">&#10094;</div>
            <ul class="rowSliderFlex" id="slider6"></ul>
            <div class="nextButton" id="next6" onclick="slider(false, 6)">&#10095;</div>
        </div>
    </section>
</Main>
<?php
    include_once './footer.php'
?>
</body>
</html>
