
//<---!zoekfunctie API code!--->
function api() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"
	var query = document.getElementById("query").value;
	if (query == "") {
		return;
	}
	var query = query.replace(/\s/g, '+');
	fetch('https://api.themoviedb.org/3/search/movie?api_key=' + apikey + '&query=' + query)
	.then((response) => response.json())
	.then((json) => display(json,"films"));
}
function display(json, elementId) {
    const element = document.getElementById(elementId);
    element.innerHTML=""
	for (let i = 0; i < json.results.length; i++) {
        if (json.results[i].poster_path == null) {
            moviePoster = `https://via.placeholder.com/300x450`
        }
        else {
            moviePoster = `https://image.tmdb.org/t/p/w300${json.results[i].poster_path}`
        }

		var film = (`<div class="card h-100 moviecard"><a href="./film/?id=${json.results[i].id}"><img src="${moviePoster}" class="card-img-top" alt="Poster ${json.results[i].title}"><div class="card-body"><h5 class="card-title">${json.results[i].title}</h5></div></a></div>`);
		element.insertAdjacentHTML('beforeend', film);
	}
    if (elementId == "films") {
        document.getElementById("zoek").style.display = "block"
        document.getElementById("zoek").scrollIntoView();
    }
}

function load() {
    document.getElementById("zoek").style.display = "none"
    populair()
}

function populair() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"
	fetch('https://api.themoviedb.org/3/movie/popular?api_key=' + apikey)
	.then((response) => response.json())
	.then((json) => display(json, "populair"));
}

//<---!rowslider arrays declaratie (inhoud)!--->
const AANTALROWSLIDERS = 4;
var rowSliderTitle = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));
var rowSliderReleaseDate = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));
var rowSliderImgSrc = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));
var rowSliderMovieId = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));

//<---!onload API code!--->
function apiSlider() {
    //link genres ids "https://api.themoviedb.org/3/genre/movie/list?api_key=000cfc8a44435ac1017a805bb5b2bbac&language=en-US"
    var DISCOVER = "discover/movie";
    var DISCOVER_BEGIN_URL = "&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_genres=";
    var FETCHDETAILS1 = ["movie/top_rated", DISCOVER, DISCOVER, DISCOVER, DISCOVER, DISCOVER, DISCOVER ];
    var FETCHDETAILS2 = ["&page=1", DISCOVER_BEGIN_URL + "12", DISCOVER_BEGIN_URL + "27", DISCOVER_BEGIN_URL + "16", DISCOVER_BEGIN_URL + "35", DISCOVER_BEGIN_URL + "18", DISCOVER_BEGIN_URL + "53"]
    var apikey = "000cfc8a44435ac1017a805bb5b2bbac";

    for (i = 0; i < FETCHDETAILS1.length; i++){
        apiGet(i);
    }

    //<---get json van API en geeft rang--->
    function apiGet(sliderNummer) {
        fetch('https://api.themoviedb.org/3/' + FETCHDETAILS1[i] + '?api_key=' + apikey + '&language=en-US' + FETCHDETAILS2[i])
            .then((response) => response.json())
            .then((json) => dataVerwerker(json, sliderNummer));
    }

    //<---API json naar slider array--->
    function dataVerwerker(json, sliderTeller) {
        for (i = 0; i < 10; i++) {
            rowSliderTitle[sliderTeller][i] = json.results[i].title;
            rowSliderReleaseDate[sliderTeller][i] = json.results[i].release_date;
            rowSliderImgSrc[sliderTeller][i] = "https://image.tmdb.org/t/p/w200" + json.results[i].poster_path;
            rowSliderMovieId[sliderTeller][i] = json.results[i].id;
        }

        for (i = 0; i < 10; i++) {
            document.getElementById("img" + (sliderTeller+1) + "." + (i+1)).src = rowSliderImgSrc[sliderTeller][i];
            document.getElementById("title" + (sliderTeller+1) + "." + (i+1)).innerHTML = rowSliderTitle[sliderTeller][i];
            document.getElementById("datum" + (sliderTeller+1) + "." + (i+1)).innerHTML = rowSliderReleaseDate[sliderTeller][i];
        }
    }
}

//<---!rowSlider doorschuif logica!--->
function slider(richtingLinks, sliderNummer){
    imgsrc = rowSliderImgSrc[sliderNummer];
    title = rowSliderTitle[sliderNummer];
    datum = rowSliderReleaseDate[sliderNummer];

    if (richtingLinks){
        imgsrc.push(imgsrc[0]);  //copier 1ste element naar vanachter
        imgsrc.shift();         //verwijder 1ste element
        title.push(title[0]);
        title.shift();
        datum.push(datum[0]);
        datum.shift();
    }else{
        imgsrc.unshift(imgsrc[imgsrc.length-1]);  //copier laatste element naar vanvoor
        imgsrc.pop();                             //verwijder laatste element
        title.unshift(title[title.length-1]);
        title.pop();
        datum.unshift(datum[datum.length-1]);
        datum.pop();
    }

    for (i = 0; i < 10; i++) {    //pas toe de doorgeschoven afbeelding src
        document.getElementById("img" + (sliderNummer+1) + "." + (i+1)).src = imgsrc[i];
        document.getElementById("title" + (sliderNummer+1) + "." + (i+1)).innerHTML = title[i];
        document.getElementById("datum" + (sliderNummer+1) + "." + (i+1)).innerHTML = datum[i];
    }
}