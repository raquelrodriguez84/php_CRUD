

export function visibleNews() {
    const verMasBtns = document.querySelectorAll('.ver-mas-btn');
    console.log("Botones encontrados: ", verMasBtns.length);

    verMasBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const texto = this.parentElement;
            console.log("Texto actual: ", texto.textContent);
            console.log("Clases actuales: ", texto.classList);
            if (texto.classList.contains('texto-completo')) {
                texto.textContent = texto.dataset.fullText.substring(0, 100) + '...';
                texto.classList.remove('texto-completo');
                console.log("Texto cambiado a corto: ", texto.textContent);
            } else {
                texto.textContent = texto.dataset.fullText;
                texto.classList.add('texto-completo');
                console.log("Texto cambiado a completo: ", texto.textContent);
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', function() {
    visibleNews();
});
