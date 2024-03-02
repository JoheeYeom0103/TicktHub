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
        newMethodHeading.textContent = "Add New Method";
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

        // Add event listener for the save button
        saveButton.addEventListener("click", function() {
            // For demonstration purposes, you can simply log the input values
            var inputs = newMethodDiv.querySelectorAll("input");
            inputs.forEach(function(input) {
                console.log(input.previousSibling.textContent + ":", input.value);
            });
        });

        // Add event listener for the cancel button
        cancelButton.addEventListener("click", function() {
            // Remove the new method container
            newMethodDiv.remove();
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

    // Add event listeners for "Add a New Method" buttons for each payment method
    document.querySelector(".bank-transfer-method-container .add-method").addEventListener("click", function() {
        addNewMethod("bank-transfer");
    });

    document.querySelector(".credit-card-method-container .add-method").addEventListener("click", function() {
        addNewMethod("credit-card");
    });

    // Add event listener to allow only one checkbox to be checked
    var checkboxes = document.querySelectorAll("input[type='checkbox']");
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener("click", function() {
            checkboxes.forEach(function(cb) {
                if (cb !== checkbox) {
                    cb.checked = false;
                }
            });
        });
    });
});