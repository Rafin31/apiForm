

document.getElementById("generate_password").addEventListener('click', (event) => {

    const randomPassword = Math.random().toString(36).slice(-8);
    document.getElementById("password").value = randomPassword;
    event.preventDefault();
})
