document.addEventListener("DOMContentLoaded", function() {
    function addNewMethod(paymentType) {
        // Get the container where the user clicked the "Add Method" button
        var methodContainer = document.querySelector("." + paymentType + "-method-container");

        // Determine the payment type based on the class of the method container
        var paymentType = methodContainer.classList.contains("bank-transfer-method-container") ? "bank-transfer" : "credit-card";

        // Create a new form element
        var form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "php/addNewMethod_payment.php");

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
        var buttonRow = document.createElement("tr");
        buttonRow.innerHTML =   `<td colspan="2">
                                    <input type="submit" name="submit" class="save-button" value="Submit" />
                                    <input type="submit" name="cancel" class="cancel-button" value="Cancel" />
                                </td>`;
        newTable.appendChild(buttonRow);

        // Append the new table inside the form
        form.appendChild(newTable);

        // Append the form inside the clicked method container
        methodContainer.appendChild(form);

        // Add event listeners to save and cancel buttons
        var saveButton = newTable.querySelector(".save-button");
        var cancelButton = newTable.querySelector(".cancel-button");

        saveButton.addEventListener("click", function() {
            // Your validation logic here
            // ...
        });
        
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
