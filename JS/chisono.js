document.addEventListener("DOMContentLoaded", function () {
    const immagineProfilo = document.querySelector(".immagine-profilo img");

    if (!immagineProfilo) {
        return;
    }

    immagineProfilo.classList.add("profilo-entrata");

    setTimeout(function () {
        immagineProfilo.classList.add("profilo-visibile");
    }, 200);
});