document.addEventListener('DOMContentLoaded', function() {
    const formInputs = [
        document.querySelector('.username-input'),
        document.querySelector('.firstname-input'),
        document.querySelector('.middlename-input'),
        document.querySelector('.lastname-input'),
        document.querySelector('.email-input'),
        document.querySelector('.phone-input'),
        document.querySelector('.password-input'),
        document.querySelector('.confirm-password-input')
    ];

    // Add input event listener for each field in the inputs array
    formInputs.forEach(input => {
        input.addEventListener('input', function(){
            const buyerChecked = document.getElementById('buyer').checked;
            const sellerChecked = document.getElementById('seller').checked;
            if(this.value.trim() !== '' || buyerChecked || sellerChecked){
                this.style.borderWidth = "0px";
                this.style.backgroundColor = "#444444";
            }
        });
    });

    // -----------------------------------------------------------------------------------
    // Validation and styling for incorrect fields --> empty or bad form 

    const signupForm = document.getElementById("signupForm");
    signupForm.addEventListener('submit', function(event){
       
        // check for empty inputs also initialize an error counter so that 
        //we can make sure only one error message is displayed at a time
        let errorCount = 0;
        formInputs.forEach(input => {
            if (input.value.trim() === '') {
                errorCount++;
                input.style.borderWidth = "1px";
                input.style.borderColor = "#c90e02"; 
                input.style.backgroundColor = "#e8b0b0";
            }
        });

        //username 4-16chars
        const username = formInputs[0].value.trim();
        // firstname
        const firstname = formInputs[1].value.trim();
        // middlename
        const middlename = formInputs[2].value.trim();
        // lastname
        const lastname = formInputs[3].value.trim();
        //email is correct format
        const email = formInputs[4].value.trim();
        //phone number is correct format
        const phonenum = formInputs[5].value.trim();
        //pass matches confirm pass
        const password = formInputs[6].value.trim();
        const confirmPassword = formInputs[7].value.trim();        
        //user type is selected
        const buyerChecked = document.getElementById('buyer').checked;
        const sellerChecked = document.getElementById('seller').checked;

        if(username.length < 4 || username.length > 16){
            errorCount++;
            formInputs[0].style.borderWidth = "1px";
            formInputs[0].style.borderColor = "#c90e02";
            formInputs[0].style.backgroundColor = "#e8b0b0";
        }

        // make sure first, middle, and last names are between 2 and 16 chars
        for (let i = 1; i <= 3; i++) {
            let input = formInputs[i];
            if (input.value.trim() < 2 || input.value.trim() > 16) {
                errorCount++;
                input.style.borderWidth = "1px";
                input.style.borderColor = "#c90e02"; 
                input.style.backgroundColor = "#e8b0b0";
            }
        }

        if(!validateEmail(email)){
            errorCount++;
            formInputs[4].style.borderWidth = "1px";
            formInputs[4].style.borderColor = "#c90e02";
            formInputs[4].style.backgroundColor = "#e8b0b0";
        }

        if(!validatePhoneNum(phonenum)){
            errorCount++;
            formInputs[5].style.borderWidth = "1px";
            formInputs[5].style.borderColor = "#c90e02";
            formInputs[5].style.backgroundColor = "#e8b0b0";
        }

        if(password.length < 12 || password.length > 14){
            errorCount++;
            formInputs[6].style.borderWidth = "1px";
            formInputs[6].style.borderColor = "#c90e02";
            formInputs[6].style.backgroundColor = "#e8b0b0";
        }

        if(confirmPassword != password){
            errorCount++;
            formInputs[7].style.borderWidth = "1px";
            formInputs[7].style.borderColor = "#c90e02";
            formInputs[7].style.backgroundColor = "#e8b0b0";

        }

        if(!buyerChecked && !sellerChecked){
            alert("Please select a user type (e.g., buyer or seller)");
            event.preventDefault();
        }

        if(errorCount >= 1){
            alert("Please correct highlighted fields");
            event.preventDefault();
        }

    });

    function validateEmail(email){
        //creates pattern: something@something.something
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    function validatePhoneNum(phoneNumber){
        const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        return phonePattern.test(phoneNumber);
    }

});
