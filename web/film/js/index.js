function loadMovie() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"
	
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	var id = urlParams.get('id')
	console.log(id)
	fetch('https://api.themoviedb.org/3/movie/' + id + '?api_key=' + apikey)
	.then((response) => response.json())
	.then((json) => showMovieDetail(json));
	
	fetch('https://api.themoviedb.org/3/movie/' + id + '/videos' +'?api_key=' + apikey)
	.then((response) => response.json())
	.then((json) => display2(json));
}
function showMovieDetail(json) {
	var genres = ""

	document.getElementById("Title").innerHTML = json.title
	document.getElementById("Year").innerHTML = json.release_date.slice(0, 4)
	document.getElementById("Poster").src = "https://image.tmdb.org/t/p/w500" + json.poster_path
	document.getElementById("Poster").style.display = "block";
	for (const genre_nr in json.genres) {
		genres = genres + json.genres[genre_nr].name + ", "
	}
	document.getElementById("Genre").innerHTML = genres.slice(0, -2)
	document.getElementById("Runtime").innerHTML = json.runtime + " min."
	document.getElementById("Plot").innerHTML = json.overview
	document.getElementById("Rating").innerHTML = "★ " + json.vote_average + "/10"
	document.getElementById("Backdrop").src = "https://image.tmdb.org/t/p/original" + json.backdrop_path
}
function display2(json){
	var key=""
	var vidType=""
	var Trailer = document.getElementById("Trailer");
	
	for (const results_nr in json.results) {
		vidType = json.results[results_nr].type
		if(vidType == "Trailer"){
			key = json.results[results_nr].key
			var URL = "https://www.youtube.com/embed/" + key ;
			Trailer.src = URL;
		}
	}
}
