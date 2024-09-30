console.log("script loaded");

document.querySelector('#contact').addEventListener('submit', function (event) {
    event.preventDefault();

    const form = event.target;
    const contactForm = new FormData(form);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/formvalidate.php', true);
    xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                const response = JSON.parse(xhr.responseText);
                console.log(response);
                window.location.href = 'success.php';
            } catch (e) {
                console.error('Invalid JSON response:', xhr.responseText);
            }
        } else if (xhr.readyState === 4) {
            console.log('Server error');
        }
    };

    xhr.send(contactForm);
});