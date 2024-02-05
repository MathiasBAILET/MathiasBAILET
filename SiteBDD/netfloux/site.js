function changeTab(tabName) {
    var tabs = document.querySelectorAll('.tab-content');
    tabs.forEach(tab => {
        tab.style.display = 'none';
    });

    var selectedTab = document.getElementById(tabName);
    if (selectedTab) {
        selectedTab.style.display = 'block';
    }



    // Rafraîchir la page
    window.location.reload();
}


function loadMovies() {
    var genre = document.getElementById('genre').value;
    var titre = document.getElementById('titre').value;
    var tri = document.getElementById('tri').value;
    var ordre = document.getElementById('ordre').value;

    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById('resultats-films').innerHTML = xhr.responseText;
            } else {
                console.error('Error:', xhr.status, xhr.statusText);
            }
        }
    };

    // Modifiez la requête pour prendre en compte les options de tri
    xhr.open('POST', 'connexion.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('genre=' + encodeURIComponent(genre) + '&titre=' + encodeURIComponent(titre) + '&tri=' + tri + '&ordre=' + ordre);
}



function redirectToAjoutFilm() {
    window.location.href = 'http://localhost/AjoutFilm/site.html';
}
function redirectToSeries() {
    window.location.href = 'http://localhost/serie/site.html';
}