
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
const AANTALROWSLIDERS = 7;
const AANTALELEMENTEN = 20;
var rowSliderTitle = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));
var rowSliderScore = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));
var rowSliderImgSrc = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));
var rowSliderMovieId = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));

//<---!onload API code!--->
function apiSlider() {
    for (let i = 0; i < AANTALROWSLIDERS; i++) {
        let slider_doc = document.getElementById("slider" + i);
        let htmlCode = "";
        for (let x = 0; x < AANTALELEMENTEN; x++){
            let imgId = "img"+ i +"."+ x;
            let titleId = "title"+ i +"."+ x;
            let scoreId = "score"+ i +"."+ x;
            htmlCode += `<li><img id=${imgId} src="http://placehold.it/200x300"/><p>
                            <span id=${titleId}>Placeholder</span>     
                            <span class="vet-font" id=${scoreId}></span></p></li>`;
        }
        slider_doc.innerHTML = htmlCode;
    }

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
        for (i = 0; i < AANTALELEMENTEN; i++) {
            rowSliderTitle[sliderTeller][i] = json.results[i].title;
            rowSliderScore[sliderTeller][i] = (json.results[i].vote_average)*10+'%';
            rowSliderImgSrc[sliderTeller][i] = "https://image.tmdb.org/t/p/w200" + json.results[i].poster_path;
            rowSliderMovieId[sliderTeller][i] = json.results[i].id;
        }

        for (i = 0; i < AANTALELEMENTEN; i++) {
            document.getElementById("img" + sliderTeller + "." + i).src = rowSliderImgSrc[sliderTeller][i];
            document.getElementById("title" + sliderTeller + "." + i).innerHTML = rowSliderTitle[sliderTeller][i];
            document.getElementById("score" + sliderTeller + "." + i).innerHTML = rowSliderScore[sliderTeller][i];
        }
    }
}

//<---!rowSlider doorschuif logica!--->
var sliderId = new Array(20).fill(0);
function slider(richtingLinks, sliderNummer){

    sliderId[sliderNummer] = richtingLinks ? sliderId[sliderNummer]+1 : sliderId[sliderNummer]-1;

    var hidderPrev;
    sliderId[sliderNummer] >= 0 ? hidderPrev = "hidden" : hidderPrev = "visible";
    document.getElementById("prev" + sliderNummer).style.visibility= hidderPrev;

    var hidderNext;
    sliderId[sliderNummer] <= -AANTALELEMENTEN+6 ? hidderNext = "hidden" : hidderNext = "visible";
    document.getElementById("next" + sliderNummer).style.visibility= hidderNext;

    let slider_doc = document.getElementById("slider" + sliderNummer);
    slider_doc.style.marginLeft = (sliderId[sliderNummer]*226) +"px";
}



