document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("post-request-button").addEventListener("click", function(event) {
        // Prevent the form from submitting
        event.preventDefault();
        
        // Get all input fields
        var inputs = document.querySelectorAll("input, textarea");
        
        // Flag to track if all fields are valid
        var allFieldsValid = true;
        
        // Check if all input fields are valid
        inputs.forEach(function(input) {
            if (!input.checkValidity()) {
                // Mark the field as invalid
                input.classList.add("invalid-input");
                // Set flag to false since at least one field is invalid
                allFieldsValid = false;
            } else {
                // Remove the invalid class if the field is valid
                input.classList.remove("invalid-input");
            }

            // Custom validation based on input type
            if (input.type === 'datetime-local') {
                // Check if the date is later than today
                var today = new Date();
                var inputDate = new Date(input.value.trim());
                if (inputDate < today) {
                    input.classList.add("invalid-input");
                    allFieldsValid = false;
                }
            }

            if (input.type === 'number') {
                // Check if the quantity is equal to or less than 0
                if (parseInt(input.value) <= 0) {
                    input.classList.add("invalid-input");
                    allFieldsValid = false;
                }
            }
        });
        
        // If any field is not valid, display an alert message
        if (!allFieldsValid) {
            alert("Please correct the highlighted fields");
        } else {
            // All fields are valid, you can proceed with form submission or other actions
            document.getElementById("event-form").submit();
        }
    });
});
