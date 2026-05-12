document.addEventListener("DOMContentLoaded", function () {
    const elementiAnimati = document.querySelectorAll(
        ".hero-content, .hero-text, .contenutoHero, .intro-costi, .intro-risultati, .intro-contatti, .intro-prenotazione, .intro-aree, .services-intro, .sezione-presentazione, .sezioneProfessione, .card, .service-card, .card-valore, .card-prezzo, .success-card, .stat-card, .info-box, .info-item, .method-item, .payment-methods, .method-section, .sezione-supporto, .sezioneFiducia, .form-card"
    );

    elementiAnimati.forEach(function (elemento) {
        elemento.classList.add("fade-element");
    });

    const osservatore = new IntersectionObserver(function (elementi) {
        elementi.forEach(function (elemento) {
            if (elemento.isIntersecting) {
                elemento.target.classList.add("visible");
            }
        });
    }, {
        threshold: 0.15
    });

    elementiAnimati.forEach(function (elemento) {
        osservatore.observe(elemento);
    });

    const navbar = document.querySelector(".nav");

    if (navbar) {
        window.addEventListener("scroll", function () {
            if (window.scrollY > 40) {
                navbar.classList.add("nav-scroll");
            } else {
                navbar.classList.remove("nav-scroll");
            }
        });
    }

    const cards = document.querySelectorAll(
        ".card, .service-card, .card-valore, .card-prezzo, .success-card, .stat-card"
    );

    cards.forEach(function (card) {
        card.addEventListener("mouseenter", function () {
            card.classList.add("card-attiva");
        });

        card.addEventListener("mouseleave", function () {
            card.classList.remove("card-attiva");
        });
    });
});