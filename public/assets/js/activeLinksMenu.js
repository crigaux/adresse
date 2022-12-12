let links = document.querySelectorAll('.menuLinksDesktop .linkNav');

string = window.location.href;
let index = string.lastIndexOf('/');
let slug = string.substr(index + 1);

links.forEach(link => {
    if(link.textContent.trim().toLowerCase() == slug) {
        link.classList.add('active');
    }
});