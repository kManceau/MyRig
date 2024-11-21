const button = document.getElementById("select-user-button");
const selector = document.getElementById("user-select");

button.addEventListener("click", (e) => {
    e.preventDefault();
    document.location.href = '/admin/user/' + selector.value;
})