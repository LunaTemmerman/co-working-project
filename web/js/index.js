function api() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"
	var query = document.getElementById("query").value.replace(/\s/g, '+');
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