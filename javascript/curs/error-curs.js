document.addEventListener('DOMContentLoaded', () => {
    if (typeof serverError !== 'undefined' && serverError) {
        const errorMessage = serverError.toLowerCase();

        // Nom ja existent
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

        // Error en la descripció
        if (errorMessage.includes("bad description")) {
            const descriptionError = document.getElementById('error-description');
            if (descriptionError) {
                descriptionError.textContent = "Descripció no vàlida.";
                descriptionError.style.display = "block";
            }
        }

        // Error en el grau
        if (errorMessage.includes("bad degree")) {
            const descriptionError = document.getElementById('error-degree');
            if (descriptionError) {
                descriptionError.textContent = "Grau no vàlida.";
                descriptionError.style.display = "block";
            }
        }
    }
});
