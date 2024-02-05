document.addEventListener('DOMContentLoaded', function () {
    // Fonction pour rediriger l'utilisateur vers l'accueil
    function redirectToHome() {
        window.location.href = 'http://localhost/netfloux/site.html';
    }

    // Fonction pour ajouter une classe 'animate' à un élément
    function animateElement(element) {
        element.classList.add('animate');
    }

    // Fonction pour déterminer si un élément est visible à l'écran
    function isElementInViewport(el) {
        var rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    // Sélectionnez tous les éléments à animer
    var elementsToAnimate = document.querySelectorAll('.input, h1, select');

    // Ajoutez une classe d'animation aux éléments visibles au chargement initial
    elementsToAnimate.forEach(function (element) {
        if (isElementInViewport(element)) {
            animateElement(element);
        }
    });

    // Ajoutez un gestionnaire d'événements au formulaire d'ajout de film ou de série
    var addForm = document.getElementById('add-form');
    if (addForm) {
        addForm.addEventListener('submit', function (event) {
            event.preventDefault();

            // Récupérez les données du formulaire
            var formData = new FormData(addForm);

            // Envoyez les données au serveur via une requête XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'add_movie.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    alert(xhr.responseText); // Affichez un message ou effectuez d'autres actions en fonction de la réponse du serveur
                    redirectToHome(); // Redirigez l'utilisateur vers l'accueil après l'ajout
                } else {
                    console.error('Erreur:', xhr.status, xhr.statusText);
                }
            };
            xhr.send(formData);
        });
    }

    // Ajoutez un gestionnaire d'événements au bouton "Revenir à l'accueil"
    var backButton = document.getElementById('add-movie-button');
    if (backButton) {
        backButton.addEventListener('click', redirectToHome);
    }
});
