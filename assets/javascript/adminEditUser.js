// DELETE USER AVATAR
if(document.getElementById("delete-user-avatar-button")){
    const avatarButton = document.getElementById("delete-user-avatar-button");
    avatarButton.addEventListener("click", () => {
       document.location.href = avatarButton.href;
    });
}

// CHANGE USER ROLE
const roleButton = document.getElementById("change-user-role");
roleButton.addEventListener("click", () => {
    document.location.href = button.href;
})