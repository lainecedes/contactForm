console.log("script loaded");

document.querySelector('#contact').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission
    const contactForm = new FormData(this);

    fetch('includes/formvalidate.php', {
        method: 'POST',
        body: contactForm
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.status === 'error') {
                // JSON error output as a console error
                console.error('Validation errors:', data.errors);
                // toggle error message with a .hidden class
                const toggleError = (inputElement, errorElement) => {
                    if (inputElement.value.trim() !== '') {
                        errorElement.classList.add('hidden'); // Hide error if input is filled
                    } else {
                        errorElement.classList.remove('hidden'); // Show error if input is empty
                    }
                };

                for (const field in data.errors) {
                    const errorElement = document.getElementById(`${field}-error`);
                    const inputElement = document.getElementById(field);

                    if (errorElement && inputElement) {
                        errorElement.textContent = data.errors[field] || '';
                        errorElement.classList.remove('hidden');

                        // check if it's being dynamically changed
                        inputElement.addEventListener('input', () => toggleError(inputElement, errorElement));
                    }
                }
            } else {
                window.location.href = 'success.php';
            }
        })
        .catch(error => console.error('Error:', error));
});
