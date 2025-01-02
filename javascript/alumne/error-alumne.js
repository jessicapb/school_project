document.addEventListener('DOMContentLoaded', () => {
    if (typeof serverError !== 'undefined' && serverError) {
        const errorMessage = serverError.toLowerCase();

        // DNI ja existent
        if (errorMessage.includes("ja existeix")) {
            const dniError = document.getElementById('error-dni');
            if (dniError) {
                dniError.textContent = "El DNI ja està registrat.";
                dniError.style.display = "block";
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

        // Error en el cognom
        if (errorMessage.includes("bad surname")) {
            const nameError = document.getElementById('error-surname');
            if (nameError) {
                nameError.textContent = "Cognom no vàlid.";
                nameError.style.display = "block";
            }
        }

        // Error en la contrasenya
        if (errorMessage.includes("bad password")) {
            const nameError = document.getElementById('error-password');
            if (nameError) {
                nameError.textContent = "Contrasenya no vàlida.";
                nameError.style.display = "block";
            }
        }

        // Error en el número de telèfon
        if (errorMessage.includes("bad phonenumber")) {
            const phonenumberError = document.getElementById('error-phonenumber');
            if (phonenumberError) {
                phonenumberError.textContent = "Número de telèfon no vàlid. El fomat vàlid es: 34 XXX XX XX XX";
                phonenumberError.style.display = "block";
            }
        }

        // Error en el correu electrònic
        if (errorMessage.includes("bad email")) {
            const phonenumberError = document.getElementById('error-email');
            if (phonenumberError) {
                phonenumberError.textContent = "Correu electrònic no vàlid.";
                phonenumberError.style.display = "block";
            }
        }

        // Error en la identificació
        if (errorMessage.includes("bad ident")) {
            const phonenumberError = document.getElementById('error-ident');
            if (phonenumberError) {
                phonenumberError.textContent = "RALC no vàlid.";
                phonenumberError.style.display = "block";
                }
        }

        // Error en el curs
        if (errorMessage.includes("bad course")) {
            const phonenumberError = document.getElementById('error-course');
            if (phonenumberError) {
                phonenumberError.textContent = "Curs no vàlid.";
                phonenumberError.style.display = "block";
            }
        }

        // Error en l'assignatura
        if (errorMessage.includes("bad subject")) {
            const phonenumberError = document.getElementById('error-subject');
            if (phonenumberError) {
                phonenumberError.textContent = "Assignatura no vàlida.";
                phonenumberError.style.display = "block";
            }
        }

        // Error en la inscripció
        if (errorMessage.includes("bad enrollment")) {
            const enrollmentError = document.getElementById('error-enrollment');
            if (enrollmentError) {
                enrollmentError.textContent = "Error en la data d'inscripció.";
                enrollmentError.style.display = "block";
            }
        }
        
        // Error en el DNI
        if (errorMessage.includes("bad dni")) {
            const dniError = document.getElementById('error-dni');
            if (dniError) {
                dniError.textContent = "DNI no vàlid.";
                dniError.style.display = "block";
                }
        }
    }
});
