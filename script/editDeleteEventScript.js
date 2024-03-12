function editData(button) { 
    // Get the parent row of the clicked button 
    let row = button.parentNode.parentNode; 
    
    // Get the cells within the row 
    let eventNameCell = row.cells[0]; 
    let eventLocationCell = row.cells[1]; 
    let eventDateTimeCell = row.cells[2]; 
    let eventQuantityCell = row.cells[3]; 
    let eventCostCell = row.cells[4]; 
    
    // Get the input fields within the cells 
    let eventNameInput = eventNameCell.querySelector('.edit-event-name'); 
    let eventLocationInput = eventLocationCell.querySelector('.edit-event-location'); 
    let eventDateTimeInput = eventDateTimeCell.querySelector('.edit-event-date-time'); 
    let eventQuantityInput = eventQuantityCell.querySelector('.edit-event-quantity'); 
    let eventCostInput = eventCostCell.querySelector('.edit-event-cost'); 
    
    // Populate the input fields with the current values
    // This way, the user can maintain current details if they would like
    eventNameInput.value = eventNameCell.querySelector('.event-name').textContent; 
    eventLocationInput.value = eventLocationCell.querySelector('.event-location').textContent; 
    eventDateTimeInput.value = eventDateTimeCell.querySelector('.event-date-time').textContent; 
    eventQuantityInput.value = eventQuantityCell.querySelector('.ticket-quantity').textContent; 
    eventCostInput.value = eventCostCell.querySelector('.ticket-cost').textContent; 
    
    // Validate input 
    function validateInput(input, promptMessage) {
        // Remove the invalid-input class before validating
        input.classList.remove('invalid-input');

        // Prompt the user to enter a new value
        let newValue = prompt(promptMessage, input.value); 

        // If the user clicks on cancel, exit the function
        if (newValue === null) {
            return null;
        }

        // If the input is empty, add invalid class and re-prompt
        if (!newValue.trim()) {
            input.classList.add('invalid-input');
            return validateInput(input, promptMessage); 
        }

        // If the input is the event date and time
        if (input === eventDateTimeInput) {
            let dateTimeRegex = /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/;
            let selectedDateTime = new Date(newValue.trim()).getTime();
            let currentDateTime = new Date().getTime();

            // Check if the date time format is invalid or if it's a past date time
            if (!dateTimeRegex.test(newValue.trim()) || selectedDateTime < currentDateTime) {
                input.classList.add('invalid-input');
                return validateInput(input, promptMessage); 
            }
        }

        // If the input is the event quantity and not in valid number, add invalid class and re-prompt
        if (input === eventQuantityInput && parseInt(newValue) <= 0) {
            input.classList.add('invalid-input');
            return validateInput(input, promptMessage); 
        }

        // If the input is not empty and valid, return the new value
        return newValue;
    }

    
    // Validate and update the event name
    let eventName = validateInput(eventNameInput, "Enter the updated event name or press Cancel to leave it the same:");
    if (eventName === null) return; // Cancelled, exit function
    eventNameInput.value = eventName;
    
    // Validate and update the event location
    let eventLocation = validateInput(eventLocationInput, "Enter the updated event location or press Cancel to leave it the same:");
    if (eventLocation === null) return; // Cancelled, exit function
    eventLocationInput.value = eventLocation;
    
    // Validate and update the event date and time
    let eventDateTime = validateInput(eventDateTimeInput, "Enter the updated event date and time (YYYY-MM-DD HH:MM) or press Cancel to leave it the same:");
    if (eventDateTime === null) return; // Cancelled, exit function
    eventDateTimeInput.value = eventDateTime;
    
    // Validate and update the quantity
    let eventQuantity = validateInput(eventQuantityInput, "Enter the updated quantity or press Cancel to leave it the same:");
    if (eventQuantity === null) return; // Cancelled, exit function
    eventQuantityInput.value = eventQuantity;
    
    // Validate and update the cost
    let eventCost = validateInput(eventCostInput, "Enter the updated cost or press Cancel to leave it the same:");
    if (eventCost === null) return; // Cancelled, exit function
    eventCostInput.value = eventCost;
}

function deleteData(button) { 
    // Get the parent row of the clicked button 
    let row = button.parentNode.parentNode; 
    // Remove the row from the table 
    row.parentNode.removeChild(row); 
} 
