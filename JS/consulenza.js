document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".form-prenotazione");

    if (!form) {
        return;
    }

    const bottone = form.querySelector(".btn-primary");
    const campi = form.querySelectorAll("input, select, textarea");

    campi.forEach(function (campo) {
        campo.addEventListener("focus", function () {
            campo.parentElement.classList.add("campo-attivo");
        });

        campo.addEventListener("blur", function () {
            campo.parentElement.classList.remove("campo-attivo");
        });
    });

    form.addEventListener("submit", function (evento) {
        evento.preventDefault();

        bottone.textContent = "Richiesta inviata";
        bottone.classList.add("inviato");

        setTimeout(function () {
            bottone.textContent = "Invia richiesta di prenotazione";
            bottone.classList.remove("inviato");
            form.reset();
        }, 2500);
    });
});