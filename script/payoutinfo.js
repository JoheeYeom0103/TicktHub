document.addEventListener("DOMContentLoaded", function() {

    // Function to create HTML elements for adding new payment method details
    function addNewMethod(paymentType) {
        // Get the container where the user clicked the "Add Method" button
        var methodContainer = document.querySelector("." + paymentType + "-method-container");

        // Create a div element to contain the input fields
        var newMethodDiv = document.createElement("div");
        newMethodDiv.classList.add("new-method-container");

        // Create a heading for "Add New Method"
        var newMethodHeading = document.createElement("h3");
        newMethodHeading.textContent = "Add A New Method";
        newMethodDiv.appendChild(newMethodHeading);

        // Create a div container for "Set As Default Method" checkbox and input fields
        var defaultMethodContainer = document.createElement("div");

        // Create checkbox for "Set As Default Method"
        var defaultCheckbox = document.createElement("input");
        defaultCheckbox.type = "checkbox";
        var defaultLabel = document.createElement("label");
        defaultLabel.textContent = "Set As Default Method";
        defaultMethodContainer.appendChild(defaultCheckbox);
        defaultMethodContainer.appendChild(defaultLabel);
        defaultMethodContainer.appendChild(document.createElement("br")); // Line break after the checkbox

        // Append the default method container to the new method container
        newMethodDiv.appendChild(defaultMethodContainer);

        // Create input fields based on the payment type
        if (paymentType === "bank-transfer") {
            var bankNameInput = createInputField("text", "Bank Name", "Enter bank name");
            var accountHolderInput = createInputField("text", "Account Holder Name", "Enter account holder name");
            var accountNumberInput = createInputField("text", "Account Number", "Enter account number");

            newMethodDiv.appendChild(bankNameInput);
            newMethodDiv.appendChild(document.createElement("br"));
            newMethodDiv.appendChild(accountHolderInput);
            newMethodDiv.appendChild(document.createElement("br"));
            newMethodDiv.appendChild(accountNumberInput);
            newMethodDiv.appendChild(document.createElement("br"));
        } else if (paymentType === "credit-card") {
            var cardNumberInput = createInputField("text", "Card Number", "Enter card number");
            var expirationDateInput = createInputField("text", "Expiration Date", "Enter expiration date (MM/YY)");
            var cardHolderInput = createInputField("text", "Card Holder Name", "Enter card holder name");
            var securityCodeInput = createInputField("text", "Security Code (CVC)", "Enter security code");

            newMethodDiv.appendChild(cardNumberInput);
            newMethodDiv.appendChild(document.createElement("br"));
            newMethodDiv.appendChild(expirationDateInput);
            newMethodDiv.appendChild(document.createElement("br"));
            newMethodDiv.appendChild(cardHolderInput);
            newMethodDiv.appendChild(document.createElement("br"));
            newMethodDiv.appendChild(securityCodeInput);
            newMethodDiv.appendChild(document.createElement("br"));
        }

        // Create a save button
        var saveButton = document.createElement("button");
        saveButton.textContent = "Save";
        saveButton.classList.add("add-method-button");

        // Create a cancel button
        var cancelButton = document.createElement("button");
        cancelButton.textContent = "Cancel";
        cancelButton.classList.add("add-method-button");

        // Append buttons to the new method container
        newMethodDiv.appendChild(saveButton);
        newMethodDiv.appendChild(cancelButton);

        // Append the new method container inside the clicked method container
        methodContainer.appendChild(newMethodDiv);

        /* Form validation */
        // When save button is clicked
        saveButton.addEventListener("click", function() {
            var inputs = newMethodDiv.querySelectorAll("input");
            var allValid = true;
            // Iterate over every input fields
            inputs.forEach(function(input) {
                // Check if the trimmed value of the input field is falsey (empty)
                if (!input.value.trim()) {
                    input.classList.add("error-input");
                    allValid = false;
                // Check digit requirements if applicable * Must have passed 'if empty' to be validated for digits *
                } else {
                    /* Parent element of <input> is <label> whcih has text content */
                    /* DOMelement.parentElement.textContent.trim() - parent element's trimed text content */
                    switch (input.parentElement.textContent.trim()) {
                        case "Card Number:":
                            /* 
                                // Regular expression pattern //
                                ^ asserts the start of the string
                                * \d represents any digit character (equivalent to [0-9])
                                * {16} specifies that exactly 16 occurrences of the preceding (\d are required)
                                * $ asserts the end of the string
                            
                                * (RE).text(input.value.trim()): returns true if the input matches the RE, otherwise, returns false
                            */
                            if (!(/^\d{16}$/).test(input.value.trim())) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        case "Expiration Date:":
                            var today = new Date();
                            var inputDate = new Date(input.value.trim() + "/01");
                            if (inputDate < today) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        case "Security Code (CVC):":
                            if (!(/^\d{3}$/).test(input.value.trim())) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        case "Account Number:":
                            if (!(/^\d{7,12}$/).test(input.value.trim())) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        default:
                            input.classList.remove("error-input");
                            break;
                    }
                }
            });

            if (allValid) {
                // Proceed with further actions such as saving the data
                // SaveMethod(...);
                inputs.forEach(function(input) {
                    input.value = ""; // Clear input field
                });
            } else {
                alert("Please correct the highlighted fields");
            }
        });
    }

    // Function to create an input field with specified type, label, and placeholder
    function createInputField(type, label, placeholder) {
        var input = document.createElement("input");
        input.setAttribute("type", type);
        input.setAttribute("placeholder", placeholder);
        var labelElement = document.createElement("label");
        labelElement.textContent = label + ": ";
        labelElement.appendChild(input);
        return labelElement;
    }

    // If add method button in bank transfer is clicked, execute addMethod() function with 'bank-transfer' as a parameter value
    document.querySelector(".bank-transfer-method-container .add-method").addEventListener("click", function() {
        addNewMethod("bank-transfer");
    });

    // If add method button in credit card is clicked, execute addMethod() function with 'credit-card' as a parameter value
    document.querySelector(".credit-card-method-container .add-method").addEventListener("click", function() {
        addNewMethod("credit-card");
    });

    /* Only 1 checkbox box to be checked */
    // Add a click event listener to every checkbox
    var checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("click", function() {
            // If a checkbox is clicked, all the other checkboxes are unchecked
            checkboxes.forEach(function(cb) {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
        });
    });
});
