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

    getCurrentProfileData().then(userData =>{
        formInputs[0].value = userData.username;
        formInputs[1].value = userData.firstname;
        formInputs[2].value = userData.middlename;
        formInputs[3].value = userData.lastname;
        formInputs[4].value = userData.email;
        formInputs[5].value = userData.phone;
    });

    // Add input event listener for each field in the inputs array
    formInputs.forEach(input => {
        input.addEventListener('input', function(){
            if(this.value.trim() !== ''){
                this.style.borderWidth = "0px";
                this.style.backgroundColor = "#444444";
            }
        });
    });

    // -----------------------------------------------------------------------------------
    // Validation and styling for incorrect fields --> empty or bad form 

    const editAccountForm = document.getElementById("editAccountForm");
    editAccountForm.addEventListener('submit', function(event){
       
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

        if(errorCount >= 1){
            alert("Please correct highlighted fields");
            event.preventDefault();
        }else{
            const newUserData = {
                username: formInputs[0].value.trim(),
                firstname: formInputs[1].value.trim(),
                middlename: formInputs[2].value.trim(),
                lastname: formInputs[3].value.trim(),
                email: formInputs[4].value.trim(),
                phone: formInputs[5].value.trim(),
            };
        }

    });

    // In Case the User Wants to Cancel the Edit...
    const cancelButton = document.getElementById('cancel-button');
    cancelButton.addEventListener('click', function(event){
        event.preventDefault();
        getCurrentProfileData().then(userData =>{
            formInputs[0].value = userData.username;
            formInputs[1].value = userData.firstname;
            formInputs[2].value = userData.middlename;
            formInputs[3].value = userData.lastname;
            formInputs[4].value = userData.email;
            formInputs[5].value = userData.phone;
        });
    });

    function validateEmail(email){
        //creates pattern: something@something.something
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }


    function validatePhoneNum(phoneNumber){
        // create pattern XXX-XXX-XXXX
        const phonePattern = /^\d{3}-\d{3}-\d{4}$/;
        return phonePattern.test(phoneNumber);
    }

    function getCurrentProfileData(){
        // simulates getting user data from the DB (which we have not implemented yet)
        return Promise.resolve({
            username: "siGuy12",
            firstname: "Simon",
            middlename: "Jenkins",
            lastname: "Smith",
            email: "simon@simonsays.com",
            phone: "555-555-5555"
        });
    }

});
