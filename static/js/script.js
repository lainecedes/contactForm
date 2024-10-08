console.log("script loaded");

let form = document.querySelector('#contact');

const toggleFieldError = (field, error, message = false) => {
    console.log(field, error, message);

    if (error === true) {
        field.classList.remove('valid');
        field.classList.add('invalid');
        field.querySelector('span.error').textContent = message;
    } else {
        field.classList.add('valid');
        field.classList.remove('invalid');
        field.querySelector('span.error').textContent = '';
    }
}


form.addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission
    const contactForm = new FormData(this);

    fetch('includes/form.php', {
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

                form.querySelectorAll('input, textarea').forEach((input) => {
                    const field = input.closest('label');
                    if (input.name in data.errors) {
                        toggleFieldError(field, true, data.errors[input.name]);
                    } else {
                        toggleFieldError(field, false);
                    }
                });

            } else {
                window.location.href = 'success.php';
            }
        })
        .catch(error => console.error('Error:', error));
});
