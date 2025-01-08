document.addEventListener('DOMContentLoaded', () => {
    if (typeof serverError !== 'undefined' && serverError) {
        const errorMessage = serverError.toLowerCase();

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
            const descriptionError = document.getElementById('error-descripcio');
            if (descriptionError) {
                descriptionError.textContent = "Descripció no vàlida.";
                descriptionError.style.display = "block";
            }
        }

        // Error en el dia
        if (errorMessage.includes("bad day")) {
            const dayError = document.getElementById('error-dia');
            if (dayError) {
                dayError.textContent = "Dia no vàlid.";
                dayError.style.display = "block";
            }
        }
    }
});
