function api() {
	var apikey = "a1610a3d"
	var query = document.getElementById("query").value;
	fetch('http://www.omdbapi.com/?s=' + query + '&apikey=' + apikey)
	.then((response) => response.json())
	.then((json) => display(json));
}
function display(json) {
	for (let i = 0; i < json.Search.length; i++) {
		const element = document.getElementById("films");
		var film = (`<section id="${json.Search[i].imdbID}"><h1><a href="./film/?i=${json.Search[i].imdbID}">${json.Search[i].Title}</a></h1><p>${json.Search[i].Year}</p><img src="${json.Search[i].Poster}" width="200" alt="Poster"></img></section>`);
		element.insertAdjacentHTML('beforeend', film);
	}
}