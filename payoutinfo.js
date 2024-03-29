document.addEventListener("DOMContentLoaded", function() {
    function addNewMethod(paymentType) {
        // Get the container where the user clicked the "Add Method" button
        var methodContainer = document.querySelector("." + paymentType + "-method-container");

        // Determine the payment type based on the class of the method container
        var paymentType = methodContainer.classList.contains("bank-transfer-method-container") ? "bank-transfer" : "credit-card";

        // Create a new form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
                form.setAttribute("action", "addNewMethod_payout.php");

        // Hidden input field for payment method type
        var paymentTypeInput = document.createElement("input");
        paymentTypeInput.setAttribute("type", "hidden");
        paymentTypeInput.setAttribute("name", "paymentType");
        paymentTypeInput.setAttribute("value", paymentType);
        form.appendChild(paymentTypeInput);

        // Create a new table element
        var newTable = document.createElement("table");
        newTable.classList.add("payment-table");

        // Define input fields configuration based on payment type
        var rowsConfig = paymentType === 'credit-card' ? [
            { label: "CardNumber", placeholder: "Enter card number" },
            { label: "ExpirationDate", placeholder: "Enter expiration date (MM/YY)" },
            { label: "CardHolderName", placeholder: "Enter card holder name" },
            { label: "CVC", placeholder: "Enter security code (CVC)" }
        ] : [
            { label: "BankName", placeholder: "Enter bank name" },
            { label: "AccountHolderName", placeholder: "Enter account holder name" },
            { label: "AccountNumber", placeholder: "Enter account number" }
        ];

        // Create and append table rows with input fields based on configuration
        rowsConfig.forEach(function(row) {
            var newRow = document.createElement("tr");
            newRow.innerHTML = `<th>${row.label}</th><td><input type="text" name="${row.label}" placeholder="${row.placeholder}"></td>`;
            newTable.appendChild(newRow);
        });

        // Create a table row for buttons
        /* Ensure that there's no conflict with the built-in submit method of the form, resolving the "Uncaught TypeError: form.submit is not a function" error. */
        var buttonRow = document.createElement("tr");
        buttonRow.innerHTML =   `<td colspan="2">
                                    <input type="submit" name="submitBtn" class="save-button" value="Submit" />
                                    <input type="submit" name="cancel" class="cancel-button" value="Cancel" />
                                </td>`;
        newTable.appendChild(buttonRow);


        // Append the new table inside the form
        form.appendChild(newTable);

        // Append the form inside the clicked method container
        methodContainer.appendChild(form);

        // Add event listener to form submit event
        form.addEventListener("submit", function(event) {

            event.preventDefault(); // Prevent default form submission

            var inputs = form.querySelectorAll("input[type='text']");
            // Initialise allValid to be true
            var allValid = true;
            // Iterate over every input fields
            inputs.forEach(function(input) {
                // Check if the trimmed value of the input field is falsey (empty)
                if (!input.value.trim()) {
                    input.classList.add("error-input");
                    allValid = false;
                // Check digit requirements if applicable * Must have passed 'if empty' to be validated for digits *
                } else {
                    switch (input.name) {
                        case "CardNumber":
                            if (!(/^\d{16}$/).test(input.value.trim())) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        case "ExpirationDate":
                            var today = new Date();
                            var inputDate = new Date(input.value.trim() + "/01");
                            if (inputDate < today) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        case "CVC":
                            if (!(/^\d{3}$/).test(input.value.trim())) {
                                input.classList.add("error-input");
                                allValid = false;
                            } else {
                                input.classList.remove("error-input");
                            }
                            break;
                        case "AccountNumber":
                            if (!(/^\d{16}$/).test(input.value.trim())) {
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

            // Inside the form submission event listener
            if (allValid) {
                console.log("Form is about to be submitted...");
                form.submit();
                console.log("Form submitted."); // Add this line
            } else {
                alert("Please correct the highlighted fields");
            }

        });

        // Add event listener to cancel button
        var cancelButton = form.querySelector(".cancel-button");
        cancelButton.addEventListener("click", function() {
            // Remove the newly added form
            methodContainer.removeChild(form);
        });
    }
        
    // If add method button in bank transfer is clicked, execute addMethod() function with 'bank-transfer' as a parameter value
    document.querySelector(".bank-transfer-method-container .add-method-button").addEventListener("click", function() {
        addNewMethod("bank-transfer");
    });

    // If add method button in credit card is clicked, execute addMethod() function with 'credit-card' as a parameter value
    document.querySelector(".credit-card-method-container .add-method-button").addEventListener("click", function() {
        addNewMethod("credit-card");
    });
});
