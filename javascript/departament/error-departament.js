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

        // Error en el número d'integrants
        if (errorMessage.includes("bad number of people")) {
            const peopleError = document.getElementById('error-people');
            if (peopleError) {
                peopleError.textContent = "Número d'integrants no vàlid.";
                peopleError.style.display = "block";
            }
        }
    }
});
