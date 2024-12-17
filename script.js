const burger = document.querySelector('.burger');
const nav = document.querySelector('.nav-links');

burger.addEventListener('click', () => {
    nav.classList.toggle('nav-active');
    burger.classList.toggle('toggle');
});
// scripts.js

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('contact-form');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const message = document.getElementById('message').value;

        // Basic validation
        if (name === '' || email === '' || message === '') {
            alert('Please fill in all fields.');
            return;
        }

        // Simulate a successful submission (you can replace this with an actual AJAX request)
        alert('Thank you for contacting us, ' + name + '! We will get back to you soon.');

        // Reset the form
        form.reset();
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const showContributorsButton = document.getElementById('show-contributors');
    const contributorsSection = document.getElementById('contributors');

    showContributorsButton.addEventListener('click', () => {
        // Toggle display of contributors section
        if (contributorsSection.style.display === 'none' || contributorsSection.style.display === '') {
            contributorsSection.style.display = 'block'; // Show contributors
            showContributorsButton.textContent = 'Hide Contributors'; // Change button text
        } else {
            contributorsSection.style.display = 'none'; // Hide contributors
            showContributorsButton.textContent = 'Show Contributors'; // Reset button text
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    // Fade-in effect for all fade-in elements
    const fadeElements = document.querySelectorAll('.fade-in');

    // Use a timeout to trigger the fade-in effect after the content loads
    setTimeout(() => {
        fadeElements.forEach(el => {
            el.classList.add('show');
        });
    }, 100); // Adjust the delay as necessary
});

document.addEventListener("DOMContentLoaded", function() {
    // Get the sign-in and register links
    const signInLink = document.querySelector('a[href="sign-in.html"]');
    const registerLink = document.querySelector('a[href="create-account.html"]');
    
    // Function to show loading spinner
    function showLoadingSpinner() {
        document.getElementById('loading-spinner').style.display = 'flex';
    }

    // Attach click event listeners to the links
    signInLink.addEventListener('click', function() {
        showLoadingSpinner();
    });

    registerLink.addEventListener('click', function() {
        showLoadingSpinner();
    });
});
