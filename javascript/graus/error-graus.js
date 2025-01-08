document.addEventListener('DOMContentLoaded', () => {
    if (typeof serverError !== 'undefined' && serverError) {
        const errorMessage = serverError.toLowerCase();

        // DNI ja existent
        if (errorMessage.includes("ja existeix")) {
            const nameError = document.getElementById('error-name');
            if (nameError) {
                nameError.textContent = "El nom ja està registrat.";
                nameError.style.display = "block";
            }
        }

        // Error en el nom
        if (errorMessage.includes("bad name")) {
            const nameError = document.getElementById('error-name');
            if (nameError) {
                nameError.textContent = "Nom no vàlid.";
                nameError.style.display = "block";
            }
        }

        // Error en la duració d'anys
        if (errorMessage.includes("bad duration years")) {
            const nameError = document.getElementById('error-duration');
            if (nameError) {
                nameError.textContent = "Duració d'anys no vàlid.";
                nameError.style.display = "block";
            }
        }
    }
});
