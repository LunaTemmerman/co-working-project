
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

function searchBox(page) {
    if (page == "zoekIn") {
        var query =  document.getElementById("zoekbalk").value        
    }
    else {
        var query =  document.getElementById("query").value
    }
    window.location.replace("/zoek/?querry=" + query)
}

//<---!rowslider arrays declaratie (inhoud)!--->
const AANTALROWSLIDERS = 7;
const AANTALELEMENTEN = 20;
var rowSliderTitle = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));
var rowSliderScore = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));
var rowSliderImgSrc = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));
var rowSliderMovieId = Array.from(Array(AANTALELEMENTEN), () => new Array(AANTALROWSLIDERS));

//<---!onload API code!--->
const APIKEY = "000cfc8a44435ac1017a805bb5b2bbac";
function apiSlider() {
    for (let i = 0; i < AANTALROWSLIDERS; i++) {
        let slider_doc = document.getElementById("slider" + i);
        let htmlCode = "";
        for (let x = 0; x < AANTALELEMENTEN; x++){
            let rowId = i;
            let elementId = x;
            let imgId = "img"+ i +"."+ x;
            let titleId = "title"+ i +"."+ x;
            let scoreId = "score"+ i +"."+ x;
            htmlCode += `<li onclick="elementClick(${rowId}, ${elementId})"><img id=${imgId} src="http://placehold.it/200x300"/><p>
                            <span id=${titleId}>Placeholder</span></p>
                            <div id=${scoreId} class="sterSvgFlex"></div></li>`;
        }
        slider_doc.innerHTML = htmlCode;
    }

    //link genres ids "https://api.themoviedb.org/3/genre/movie/list?api_key=000cfc8a44435ac1017a805bb5b2bbac&language=en-US"
    var DISCOVER = "discover/movie";
    var DISCOVER_BEGIN_URL = "&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_genres=";
    var FETCHDETAILS1 = ["movie/top_rated", DISCOVER, DISCOVER, DISCOVER, DISCOVER, DISCOVER, DISCOVER ];
    var FETCHDETAILS2 = ["&page=1", DISCOVER_BEGIN_URL + "12", DISCOVER_BEGIN_URL + "27", DISCOVER_BEGIN_URL + "16", DISCOVER_BEGIN_URL + "35", DISCOVER_BEGIN_URL + "18", DISCOVER_BEGIN_URL + "53"]

    for (i = 0; i < FETCHDETAILS1.length; i++){
        apiGet(i);
    }

    //<---get json van API en geeft rang--->
    function apiGet(sliderNummer) {
        fetch('https://api.themoviedb.org/3/' + FETCHDETAILS1[i] + '?api_key=' + APIKEY + '&language=en-US' + FETCHDETAILS2[i])
            .then((response) => response.json())
            .then((json) => dataVerwerker(json, sliderNummer));
    }

    //<---API json naar slider array--->
    function dataVerwerker(json, sliderTeller) {

        for (i = 0; i < AANTALELEMENTEN; i++) {
            rowSliderTitle[sliderTeller][i] = json.results[i].title;
            rowSliderScore[sliderTeller][i] = json.results[i].vote_average;
            rowSliderImgSrc[sliderTeller][i] = "https://image.tmdb.org/t/p/w200" + json.results[i].poster_path;
            rowSliderMovieId[sliderTeller][i] = json.results[i].id;
        }

        for (i = 0; i < AANTALELEMENTEN; i++) {
            document.getElementById("img" + sliderTeller + "." + i).src = rowSliderImgSrc[sliderTeller][i];
            document.getElementById("title" + sliderTeller + "." + i).innerHTML = rowSliderTitle[sliderTeller][i];
            sterrenToevoeger(sliderTeller, i);
        }
    }

}

//<---sterren toeveoger--->
function sterrenToevoeger(sliderNummer, elementNumer){
    const STERSVG = '<svg class="sterSvg" x="0px" y="0px" viewBox="0 0 172 172" ><g transform="translate(4.3,4.3) scale(0.95,0.95)"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="none" stroke-linecap="butt" stroke-linejoin="none" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g id="original-icon 1" fill="#1F1F1F" stroke="#ff9a3c" stroke-width="9" stroke-linejoin="round"><path d="M35.088,167.184c-0.688,0 -1.376,-0.344 -2.064,-0.688c-1.032,-0.688 -1.72,-2.408 -1.376,-3.784l15.136,-56.416l-45.408,-36.808c-1.376,-0.688 -1.72,-2.408 -1.376,-3.784c0.344,-1.376 1.72,-2.408 3.096,-2.408l58.48,-3.096l20.984,-54.696c0.688,-1.032 2.064,-2.064 3.44,-2.064c1.376,0 2.752,1.032 3.096,2.064l20.984,54.696l58.48,3.096c1.376,0 2.752,1.032 3.096,2.408c0.344,1.376 0,2.752 -1.032,3.784l-45.408,36.808l15.136,56.416c0.344,1.376 0,2.752 -1.376,3.784c-1.032,0.688 -2.752,1.032 -3.784,0l-49.192,-31.648l-49.192,31.648c-0.688,0.688 -1.032,0.688 -1.72,0.688z"></path></g><path d="M0,172v-172h172v172z" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path><g id="original-icon" fill="#ffbb3c" stroke="none" stroke-width="1" stroke-linejoin="miter"><path d="M35.088,167.184c-0.688,0 -1.376,-0.344 -2.064,-0.688c-1.032,-0.688 -1.72,-2.408 -1.376,-3.784l15.136,-56.416l-45.408,-36.808c-1.376,-0.688 -1.72,-2.408 -1.376,-3.784c0.344,-1.376 1.72,-2.408 3.096,-2.408l58.48,-3.096l20.984,-54.696c0.688,-1.032 2.064,-2.064 3.44,-2.064c1.376,0 2.752,1.032 3.096,2.064l20.984,54.696l58.48,3.096c1.376,0 2.752,1.032 3.096,2.408c0.344,1.376 0,2.752 -1.032,3.784l-45.408,36.808l15.136,56.416c0.344,1.376 0,2.752 -1.376,3.784c-1.032,0.688 -2.752,1.032 -3.784,0l-49.192,-31.648l-49.192,31.648c-0.688,0.688 -1.032,0.688 -1.72,0.688z"></path></g><path d="" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path><path d="" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path></g></g></svg>';
    const HALVESTERSVG = '<svg class="sterSvg" x="0px" y="0px" viewBox="0 0 172 172"><g transform="translate(4.73,4.73) scale(0.945,0.945)"><g fill="none" fill-rule="nonzero" stroke="none" stroke-width="none" stroke-linecap="butt" stroke-linejoin="none" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g fill="#1F1F1F" stroke="#ff9a3c" stroke-width="10" stroke-linejoin="round"><path d="M136.912,167.184c-0.688,0 -1.376,-0.344 -1.72,-0.688l-49.192,-31.304l-49.192,31.648c-1.032,0.688 -2.752,0.688 -3.784,0c-1.032,-0.688 -1.72,-2.408 -1.376,-3.784l15.136,-56.416l-45.408,-37.152c-1.376,-1.032 -1.72,-2.408 -1.376,-3.784c0.344,-1.376 1.72,-2.408 3.096,-2.408l58.48,-3.096l21.328,-54.696c0.344,-1.032 1.72,-2.064 3.096,-2.064c1.376,0 2.752,1.032 3.096,2.064l21.328,54.696l58.48,3.096c1.376,0 2.752,1.032 3.096,2.408c0.344,1.376 0,2.752 -1.032,3.784l-45.752,37.152l14.792,56.416c0.344,1.376 0,2.752 -1.376,3.784c-0.344,0 -1.032,0.344 -1.72,0.344zM86,127.624c0,0 1.376,0.344 1.72,0.688l43.344,27.864l-13.072,-49.88c-0.344,-1.376 0,-2.752 1.032,-3.44l40.248,-33.024l-51.6,-2.752c-1.376,0 -2.408,-1.032 -3.096,-2.064l-18.576,-48.504z"></path></g><path d="M0,172v-172h172v172z" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path><g fill="#ffbb3c" stroke="none" stroke-width="1" stroke-linejoin="miter"><path d="M136.912,167.184c-0.688,0 -1.376,-0.344 -1.72,-0.688l-49.192,-31.304l-49.192,31.648c-1.032,0.688 -2.752,0.688 -3.784,0c-1.032,-0.688 -1.72,-2.408 -1.376,-3.784l15.136,-56.416l-45.408,-37.152c-1.376,-1.032 -1.72,-2.408 -1.376,-3.784c0.344,-1.376 1.72,-2.408 3.096,-2.408l58.48,-3.096l21.328,-54.696c0.344,-1.032 1.72,-2.064 3.096,-2.064c1.376,0 2.752,1.032 3.096,2.064l21.328,54.696l58.48,3.096c1.376,0 2.752,1.032 3.096,2.408c0.344,1.376 0,2.752 -1.032,3.784l-45.752,37.152l14.792,56.416c0.344,1.376 0,2.752 -1.376,3.784c-0.344,0 -1.032,0.344 -1.72,0.344zM86,127.624c0,0 1.376,0.344 1.72,0.688l43.344,27.864l-13.072,-49.88c-0.344,-1.376 0,-2.752 1.032,-3.44l40.248,-33.024l-51.6,-2.752c-1.376,0 -2.408,-1.032 -3.096,-2.064l-18.576,-48.504z"></path></g><path d="" fill="none" stroke="none" stroke-width="1" stroke-linejoin="miter"></path></g></g></svg>'

    let elementId = document.getElementById("score"+ sliderNummer +"."+ elementNumer);
    let score = Math.round(rowSliderScore[sliderNummer][elementNumer]);
    let starString = "";

    for (let x = 0; x < (Math.floor(score/2)); x++){
        starString += STERSVG;
    }
    if (score % 2 !== 0){
        starString += HALVESTERSVG;
    }
    elementId.innerHTML = starString;
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

//<---!onclick function--->
function elementClick(rowId, elementId){
    let filmId = rowSliderMovieId[rowId][elementId];
    window.location.href = "film/?id=" + filmId;
}

function bekekenFilms() {
    //PHP string to js array
	var bekekenFilms = document.getElementById('bekekenFilmId').innerHTML
	const bekekenFilmsArray = bekekenFilms.split(",");

    //--- button hidder
    bekekenFilmsArray.length < 6 ? document.getElementById("next7").style.display = "none" : "";

    //--- lege element plaatser
    const SLIDER_DOC = document.getElementById("slider7");
    let htmlCode = "";
    const SLIDERNUMMER = 7;
    for (let x = 0; x < bekekenFilmsArray.length -1 ; x++){
        let imgId = "img"+ SLIDERNUMMER +"."+ x;
        let titleId = "title"+ SLIDERNUMMER +"."+ x;
        htmlCode += `<li><img id=${imgId} src="http://placehold.it/200x300"/><p>
                            <span id=${titleId}>Placeholder</span></p></li>`;
    }
    SLIDER_DOC.innerHTML = htmlCode;

    //API fetch
    for (let i = 0; i < bekekenFilmsArray.length - 1; i++){
        apiGet2(bekekenFilmsArray[i], i);
    }

    function apiGet2(filmId, elementNummer){
        fetch('https://api.themoviedb.org/3/movie/' + filmId + '?api_key=' + APIKEY + '&language=en-US')
            .then((response) => response.json())
            .then((json) => dataVerwerker2(json, elementNummer));
    }

    //JSON to HTML
    function dataVerwerker2 (json, elementNummer){
        console.log("json = " + json);
        let movieImgSrc = "https://image.tmdb.org/t/p/w200" + json.poster_path;
        let movieTitle = json.title;
        console.log("movie title = " + movieTitle);
        console.log("movie img = " + movieImgSrc);

        document.getElementById("img" + SLIDERNUMMER + "." + elementNummer).src = movieImgSrc;
        document.getElementById("title" + SLIDERNUMMER + "." + elementNummer).innerHTML = movieTitle;
    }
    document.getElementById('bekekenFilmId').innerHTML = ""
}