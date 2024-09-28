const container = document.querySelector(" .container"),
    signUp = document.querySelector(" .signup-link"),
    logIn = document.querySelector(" .login-link");

signUp.addEventListener("click", () => {
    container.classList.add("active")
})
logIn.addEventListener("click", () => {
    container.classList.remove("active")
})