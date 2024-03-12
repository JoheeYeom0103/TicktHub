document.addEventListener('DOMContentLoaded', function() {
    const usernameInput = document.querySelector('.username-input');
    const passwordInput = document.querySelector('.password-input');

    // Add input event listener for username
    usernameInput.addEventListener('input', function(){
        if(this.value.trim() !== ''){
            this.style.borderWidth = "0px";
            this.style.backgroundColor = "#444444"

        }
    });

    // Add input event listener for password
    passwordInput.addEventListener('input', function(){
        if(this.value.trim() !== ''){
            this.style.borderWidth = "0px";
            this.style.backgroundColor = "#444444"
        }
    });

    //get the login form element
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function(event){

        const username = usernameInput.value.trim();
        const pass = passwordInput.value.trim();

        if(username === '' || pass === ''){
            alert("Please fill in highlighted fields!");
            event.preventDefault();
            if (username === '') {
                //when username is empty, make the border and bkg colour red
                usernameInput.style.backgroundColor = "#e8b0b0";
                usernameInput.style.borderWidth = "1px";
                usernameInput.style.borderColor = "#c90e02";            }
            if (pass === '') {
                //when password is empty, make the border  and bkg colour red
                passwordInput.style.backgroundColor = "#e8b0b0";
                passwordInput.style.borderWidth = "1px";
                passwordInput.style.borderColor = "#c90e02"; 
            }
        }
    });
});
