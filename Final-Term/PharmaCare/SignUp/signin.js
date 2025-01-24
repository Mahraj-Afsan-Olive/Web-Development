const form = document.getElementById('signup-form');
const nameInput = document.getElementById('name');
const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const nameErrorMessage = document.querySelector('#name + .error-message');
const emailErrorMessage = document.querySelector('#email + .error-message');
const passwordErrorMessage = document.querySelector('#password + .error-message');
const popup = document.getElementById('popup');
const closePopupButton = document.getElementById('close-popup');

form.addEventListener('submit', (event) => {
    event.preventDefault(); 

    // Clear previous error messages
    nameErrorMessage.textContent = '';
    emailErrorMessage.textContent = '';
    passwordErrorMessage.textContent = '';

    // Validate name (only letters allowed)
    const nameRegex = /^[a-zA-Z ]+$/;
    if (!nameRegex.test(nameInput.value)) {
        nameErrorMessage.textContent = 'Name can only contain letters.';
        return;
    }

    // Validate email format
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value)) {
        emailErrorMessage.textContent = 'Invalid email format.';
        return;
    }

    // If validation passes, display the popup
    popup.classList.remove('hidden'); 
});

closePopupButton.addEventListener('click', () => {
    popup.classList.add('hidden');
});