<script>
document.getElementById('registration-form').addEventListener('submit', function(event) {
    event.preventDefault();

    let login = document.getElementById('login').value;

    fetch('check_user.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'login=' + encodeURIComponent(login)
    })
    .then(response => response.json())
    .then(data => {
        if (data.exists) {
            alert('Пользователь с таким логином уже существует.');
        } else {
            document.getElementById('registration-form').submit();
        }
    })
    .catch(error => console.error('Error:', error));
});
</script>