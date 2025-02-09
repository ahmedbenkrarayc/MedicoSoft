const validateForm = () => {
    const emailInput = document.getElementById("email");
    const passwordInput = document.getElementById("password");

    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    
    const passwordPattern = /^[A-Za-z\d]{8,}$/;

    emailInput.style.border = 'initial';
    passwordInput.style.border = 'initial';

    let isValid = true;

    if (!emailPattern.test(emailInput.value)) {
        emailInput.style.border = '2px solid red';
        isValid = false;
    }

    
    if (!passwordPattern.test(passwordInput.value)) {
        passwordInput.style.border = '2px solid red';
        isValid = false;
    }

    return isValid;
}

document.getElementById('login').addEventListener('submit', (e) => {
    e.preventDefault()

    if(validateForm()){
        document.getElementById('login').submit()
    }
})