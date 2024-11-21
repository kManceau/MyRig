const button = document.getElementById('delete-account-button');

button.addEventListener('click', (e) => {
    e.preventDefault();
    if(confirm("Are you sure you want to delete your account ?")){
        document.location.href = button.href;
    }
});