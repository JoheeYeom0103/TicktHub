

// function for the tabbed layout on the admin page
function showTab(tabId) {
    // Select all tabs and put in node list where the class is "tab"  
    let tabs = document.querySelectorAll('.tab');
    // get the information displayed under each tab (tab-content class)
    let tabContents = document.querySelectorAll('.tab-content');
    //iterate over each element in tabs list and remove content from view
    tabs.forEach(function(tab) {
        tab.classList.remove('active');
    });
    //iterate over each element in tabcontent list and remove content from view
    tabContents.forEach(function(content) {
        content.classList.remove('active');
    });
    document.getElementById(tabId).classList.add('active');
}