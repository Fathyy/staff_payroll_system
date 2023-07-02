// Add event listeners to the sidebar links
const sidebarLinks = document.querySelectorAll('.nav li a');
sidebarLinks.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const pageUrl = link.getAttribute('href');
        loadPage(pageUrl);
    });
});

// Function to load the page content dynamically
function loadPage(pageUrl) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            document.querySelector('.content').innerHTML = this.responseText;
        }
    };
    xhttp.open('GET', pageUrl, true);
    xhttp.send();
 }
 