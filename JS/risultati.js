document.addEventListener("DOMContentLoaded", function () {
    const numeri = document.querySelectorAll(".stat-number");

    if (numeri.length === 0) {
        return;
    }

    const osservatore = new IntersectionObserver(function (elementi) {
        elementi.forEach(function (elemento) {
            if (elemento.isIntersecting) {
                animaNumero(elemento.target);
                osservatore.unobserve(elemento.target);
            }
        });
    }, {
        threshold: 0.5
    });

    numeri.forEach(function (numero) {
        osservatore.observe(numero);
    });

    function animaNumero(numero) {
        const target = parseInt(numero.getAttribute("data-target"));
        const suffix = numero.getAttribute("data-suffix") || "";

        let valore = 0;
        const durata = 1200;
        const intervallo = 25;
        const incremento = target / (durata / intervallo);

        const timer = setInterval(function () {
            valore += incremento;

            if (valore >= target) {
                numero.textContent = target + suffix;
                clearInterval(timer);
            } else {
                numero.textContent = Math.floor(valore) + suffix;
            }
        }, intervallo);
    }
});