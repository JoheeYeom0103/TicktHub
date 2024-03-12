/* check if any box is checked */

/* Ensure that JavaScript runs after the DOM is fully loaded */
document.addEventListener("DOMContentLoaded", function() {
    // If order-selected button is clicked, 
    document.getElementById("order-selected").addEventListener("click", function(event) {
        
        var checkboxes = document.querySelectorAll(".cart-item input[type='checkbox']");
        var checked = false;

        // Check if any checkbox is checked
        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                checked = true;
            }
        });

        // If no checkbox is checked, prevent the default action and show an alert
        if (!checked) {
            alert("You have no item selected.");
            event.preventDefault();
        }
    });
});
