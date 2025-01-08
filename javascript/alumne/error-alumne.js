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
            const surnameError = document.getElementById('error-surname');
            if (surnameError) {
                surnameError.textContent = "Cognom no vàlid.";
                surnameError.style.display = "block";
            }
        }

        // Error en la contrasenya
        if (errorMessage.includes("bad password")) {
            const passwordError = document.getElementById('error-password');
            if (passwordError) {
                passwordError.textContent = "Contrasenya no vàlida.";
                passwordError.style.display = "block";
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
            const emailError = document.getElementById('error-email');
            if (emailError) {
                emailError.textContent = "Correu electrònic no vàlid.";
                emailError.style.display = "block";
            }
        }

        // Error en la identificació
        if (errorMessage.includes("bad ident")) {
            const identError = document.getElementById('error-ident');
            if (identError) {
                identError.textContent = "RALC no vàlid.";
                identError.style.display = "block";
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
            const subjectError = document.getElementById('error-subject');
            if (subjectError) {
                subjectError.textContent = "Assignatura no vàlida.";
                subjectError.style.display = "block";
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
