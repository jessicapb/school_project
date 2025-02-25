document.addEventListener('DOMContentLoaded', () => {
    if (typeof serverError !== 'undefined' && serverError) {
        const errorMessage = serverError.toLowerCase();

        // DNI ja existent
        if (errorMessage.includes("ja existeix")) {
            const dniError = document.getElementById('error-dni');
            if (dniError) {
                dniError.textContent = "El DNI ja està registrat.";
                dniError.style.display = "block";
                dniError.classList.add("show");  
            }
        }

        // Error en el nom
        if (errorMessage.includes("bad name")) {
            const nameError = document.getElementById('error-name');
            if (nameError) {
                nameError.textContent = "Nom no vàlid.";
                nameError.style.display = "block";
                nameError.classList.add("show");  
            }
        }

        // Error en el cognom
        if (errorMessage.includes("bad surname")) {
            const surnameError = document.getElementById('error-surname');
            if (surnameError) {
                surnameError.textContent = "Cognom no vàlid.";
                surnameError.style.display = "block";
                surnameError.classList.add("show"); 
            }
        }

        // Error en la contrasenya
        if (errorMessage.includes("bad password")) {
            const passwordError = document.getElementById('error-password');
            if (passwordError) {
                passwordError.textContent = "Contrasenya no vàlida.";
                passwordError.style.display = "block";
                passwordError.classList.add("show");  
            }
        }

        // Error en el número de telèfon
        if (errorMessage.includes("bad phonenumber")) {
            const phonenumberError = document.getElementById('error-phonenumber');
            if (phonenumberError) {
                phonenumberError.textContent = "Número de telèfon no vàlid. El fomat vàlid es: 34 XXX XX XX XX";
                phonenumberError.style.display = "block";
                phonenumberError.classList.add("show"); 
            }
        }

        // Error en el correu electrònic
        if (errorMessage.includes("bad email")) {
            const emailError = document.getElementById('error-email');
            if (emailError) {
                emailError.textContent = "Correu electrònic no vàlid.";
                emailError.style.display = "block";
                emailError.classList.add("show"); 
            }
        }

        // Error en la identificació
        if (errorMessage.includes("bad ident")) {
            const identError = document.getElementById('error-ident');
            if (identError) {
                identError.textContent = "RALC no vàlid.";
                identError.style.display = "block";
                identError.classList.add("show");  
            }
        }

        // Error en la inscripció
        if (errorMessage.includes("bad enrollment")) {
            const enrollmentError = document.getElementById('error-enrollment');
            if (enrollmentError) {
                enrollmentError.textContent = "Error en la data d'inscripció.";
                enrollmentError.style.display = "block";
                enrollmentError.classList.add("show");  
            }
        }

        // Error en el DNI
        if (errorMessage.includes("bad dni")) {
            const dniError = document.getElementById('error-dni');
            if (dniError) {
                dniError.textContent = "DNI no vàlid.";
                dniError.style.display = "block";
                dniError.classList.add("show"); 
            }
        }
    }
});
