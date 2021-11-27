function api() {
	var apikey = "a1610a3d"
	var query = document.getElementById("query").value;
	fetch('http://www.omdbapi.com/?t=' + query + '&apikey=' + apikey)
	.then((response) => response.json())
	.then((json) => display(json));
}
function display(json) {
	document.getElementById("Title").innerHTML = json.Title
	document.getElementById("Title").href = "./film/?i=" + json.imdbID
	document.getElementById("Year").innerHTML = json.Year
	document.getElementById("Poster").src = json.Poster
	document.getElementById("Poster").style.display = "block";
}