function hideSearch() {
    document.getElementById("zoek").style.display = "none"
	let params = new URLSearchParams(location.search);
	document.getElementById("zoekbalk").value = params.get('query')
	search()
}

function search() {
	var apikey = "000cfc8a44435ac1017a805bb5b2bbac"
	var query = document.getElementById("zoekbalk").value;
	if (query == "") {
		return;
	}
	var query = query.replace(/\s/g, '+');
	fetch('https://api.themoviedb.org/3/search/movie?api_key=' + apikey + '&query=' + query)
	.then((response) => response.json())
	.then((json) => showSearch(json,"films"));
}

function showSearch(json, elementId) {
    const element = document.getElementById(elementId);
    element.innerHTML=""
	for (let i = 0; i < json.results.length; i++) {
        if (json.results[i].poster_path == null) {
            moviePoster = `https://via.placeholder.com/300x450`
        }
        else {
            moviePoster = `https://image.tmdb.org/t/p/w300${json.results[i].poster_path}`
        }

		var film = (`<div class="card h-100 moviecard search"><a href="../film/?id=${json.results[i].id}"><img src="${moviePoster}" class="card-img-top" alt="Poster ${json.results[i].title}"><div class="card-body"><h5 class="card-title">${json.results[i].title}</h5></div></a></div>`);
		element.insertAdjacentHTML('beforeend', film);
	}
    if (elementId == "films") {
        document.getElementById("zoek").style.display = "block"
        document.getElementById("zoek").scrollIntoView();
    }
}

function loadSearch() {
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	var querry = urlParams.get('querry')
	if (querry != "") {
		document.getElementById("zoekbalk").value = querry
		search()
	}
}