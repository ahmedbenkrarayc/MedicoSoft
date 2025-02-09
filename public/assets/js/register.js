function validateForm() {
    // Get the input elements
    const fnameInput = document.getElementById("fname");
    const lnameInput = document.getElementById("lname");
    const emailInput = document.getElementById("email");
    const phoneInput = document.getElementById("phone");
    const passwordInput = document.getElementById("password");
    const roleSelect = document.getElementById("role");

    // Reset previous errors
    fnameInput.style.border = 'initial';
    lnameInput.style.border = 'initial';
    emailInput.style.border = 'initial';
    phoneInput.style.border = 'initial';
    passwordInput.style.border = 'initial';
    roleSelect.style.border = 'initial';

    let isValid = true;

    // Validate first name
    if (fnameInput.value.trim() === "") {
        fnameInput.style.border = '2px solid red';
        isValid = false;
    }

    // Validate last name
    if (lnameInput.value.trim() === "") {
        lnameInput.style.border = '2px solid red';
        isValid = false;
    }

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(emailInput.value)) {
        emailInput.style.border = '2px solid red';
        isValid = false;
    }

    const phonePattern = /^\d{10,}$/;
    if (!phonePattern.test(phoneInput.value)) {
        phoneInput.style.border = '2px solid red';
        isValid = false;
    }

    if (passwordInput.value.length < 6) {
        passwordInput.style.border = '2px solid red';
        isValid = false;
    }

    if (roleSelect.value !== "patient" && roleSelect.value !== "doctor") {
        roleSelect.style.border = '2px solid red';
        isValid = false;
    }

    return isValid;
}

document.getElementById('register').addEventListener('submit', (e) => {
    e.preventDefault()

    if(validateForm()){
        document.getElementById('register').submit()
    }
})