function api() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"

	let params = new URLSearchParams(location.search);
	id = params.get('id')
	fetch('https://api.themoviedb.org/3/movie/' + id + '?api_key=' + apikey)
	.then((response) => response.json())
	.then((json) => display(json));
}
function display(json) {
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
}