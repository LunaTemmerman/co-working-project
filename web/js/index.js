
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
	for (let i = 0; i < json.results.length; i++) {
		const element = document.getElementById(elementId);
		var film = (`<section id="${json.results[i].id}"><h1><a href="./film/?id=${json.results[i].id}">${json.results[i].title}</a></h1><p>${json.results[i].release_date.slice(0, 4)}</p><img src="https://image.tmdb.org/t/p/w200${json.results[i].poster_path}" alt="Poster"></img></section>`);
		element.insertAdjacentHTML('beforeend', film);
	}
}
function populair() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"
	fetch('https://api.themoviedb.org/3/movie/popular?api_key=' + apikey)
	.then((response) => response.json())
	.then((json) => display(json, "populair"));
}



//<---!onload API code!--->
function apiSlider() {
var fetchDetials = ["","" /*"&sort_by=revenue.asc&with_genres=horror&with_watch_monetization_types=flatrat"*/];
    var apikey = "000cfc8a44435ac1017a805bb5b2bbac";

    for (i = 0; i < fetchDetials.length; i++){
        fetch('https://api.themoviedb.org/3/movie/top_rated?api_key=' + apikey + '&language=en-US&page=1' + fetchDetials)
            .then((response) => response.json())
            .then((json) => dataVerwerker(json, i));
			console.log("i =" + i);
    }
}

//<---!rowslider arrays declaratie (inhoud)!--->
const AANTALROWSLIDERS = 4;
var rowSliderTitle = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));
var rowSliderReleaseDate = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));
var rowSliderImgSrc = Array.from(Array(10), () => new Array(AANTALROWSLIDERS));

//<---!API json naar slider array!--->
function dataVerwerker(json, sliderNummer) {

	console.log(sliderNummer);
    for (i = 0; i < 10; i++) {
        rowSliderTitle[sliderNummer][i] = json.results[i].title;
        rowSliderReleaseDate[sliderNummer][i] = json.results[i].release_date;
        rowSliderImgSrc[sliderNummer][i] = "https://image.tmdb.org/t/p/w200" + json.results[i].poster_path;
    }
	console.log(rowSliderTitle[sliderNummer][i]);

    for (i = 0; i < rowSliderTitle[0].length; i++) {
        document.getElementById("img" + (sliderNummer+1) + "." + (i+1)).src = rowSliderImgSrc[sliderNummer][i];
        document.getElementById("title" + (sliderNummer+1) + "." + (i+1)).innerHTML = rowSliderTitle[sliderNummer][i];
        document.getElementById("datum" + (sliderNummer+1) + "." + (i+1)).innerHTML = rowSliderReleaseDate[sliderNummer][i];
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

    for (i = 0; i < rowSliderTitle[0].length; i++) {    //pas toe de doorgeschoven afbeelding src
        document.getElementById("img1." + (i+1)).src = imgsrc[i];
        document.getElementById("title1." + (i+1)).innerHTML = title[i];
        document.getElementById("datum1." + (i+1)).innerHTML = datum[i];
    }
}