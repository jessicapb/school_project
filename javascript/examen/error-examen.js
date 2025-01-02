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
            const nameError = document.getElementById('error-descripcio');
            if (nameError) {
                nameError.textContent = "Descripció no vàlida.";
                nameError.style.display = "block";
            }
        }

        // Error en el dia
        if (errorMessage.includes("bad day")) {
            const nameError = document.getElementById('error-dia');
            if (nameError) {
                nameError.textContent = "Dia no vàlid.";
                nameError.style.display = "block";
            }
        }
    }
});
