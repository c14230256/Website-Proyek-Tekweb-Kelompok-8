document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    fetch('pageLogin.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, password: password })
    })
    .then(response => response.json())
    .then(data => {
        const responseMessage = document.getElementById('responseMessage');
        if (data.success) {
            responseMessage.innerHTML = '<div class="alert alert-success">Login successful! Redirecting...</div>';
            setTimeout(() => {
                window.location.href = data.redirect;
            }, 2000);
        } else {
            responseMessage.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});
