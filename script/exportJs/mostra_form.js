export function toggleFormulario(visibleFormId, mostrarFormularioId) {
    const mostrarFormulario = document.getElementById(mostrarFormularioId);
    const visibleForm = document.getElementById(visibleFormId);
    
    if (!mostrarFormulario || !visibleForm) {
        console.error("Error: Elementos no encontrados con IDs:", mostrarFormularioId, visibleFormId);
        return;
    }
    mostrarFormulario.addEventListener('click', function () {
        console.log('Botón clickeado:', mostrarFormularioId);      
        if (!visibleForm.classList.contains('visible')) {
            visibleForm.style.display = (visibleForm.style.display === 'none' || visibleForm.style.display === '') ? 'block' : 'none';
        }
    });
}
export function passwordVisibility(checkboxId, inputId) {
    const checkbox = document.getElementById(checkboxId);
    const input = document.getElementById(inputId);
    if (checkbox && input) {
        checkbox.addEventListener('change', function () {
            input.type = this.checked ? 'text' : 'password';
        });
    }
}



