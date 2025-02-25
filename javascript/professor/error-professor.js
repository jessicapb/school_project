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
        
        // Error en el DNI
        if (errorMessage.includes("bad dni")) {
            const dniError = document.getElementById('error-dni');
            if (dniError) {
                dniError.textContent = "DNI no vàlid.";
                dniError.style.display = "block";
                dniError.classList.add("show"); 
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

    }
});
