document.addEventListener("DOMContentLoaded", function () {


    var dropdownButton = document.getElementById("dropdownMenuButton");

    // Get the dropdown menu items
    var dropdownItems = document.querySelectorAll(".dropdown-item");

    // Add event listeners to dropdown items
    dropdownItems.forEach(function(item) {
        item.addEventListener("change", function() {
            // Set the text of the dropdown button to the selected language
            // event.preventDefault();
            dropdownButton.innerText = item.innerText;

        });
    });
});
