function api() {
	var apikey = "a1610a3d"

	let params = new URLSearchParams(location.search);
	idIMDB = params.get('i')
	fetch('http://www.omdbapi.com/?i=' + idIMDB + '&apikey=' + apikey)
	.then((response) => response.json())
	.then((json) => display(json));
}
function display(json) {
	document.getElementById("Title").innerHTML = json.Title
	document.getElementById("Year").innerHTML = json.Year
	document.getElementById("Poster").src = json.Poster
	document.getElementById("Poster").style.display = "block";
	document.getElementById("Genre").innerHTML = json.Genre
	document.getElementById("Runtime").innerHTML = json.Runtime
	document.getElementById("Plot").innerHTML = json.Plot
}