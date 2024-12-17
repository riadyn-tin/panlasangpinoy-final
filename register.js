import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.2/firebase-auth.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyCGdxGvVC7S1syDQBl8oud6TJEhDKwsqhY",
  authDomain: "panlasang-noypi-3aeed.firebaseapp.com",
  projectId: "panlasang-noypi-3aeed",
  storageBucket: "panlasang-noypi-3aeed.firebasestorage.app",
  messagingSenderId: "752308349397",
  appId: "1:752308349397:web:b47b88be43295e412a755c"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

//inputs


// submit button

const submit = document.getElementById('submit');
const form = document.getElementById('registerForm');

form.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent the form from submitting

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    createUserWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            // Signed up
            const user = userCredential.user;
            showPopup("Account created successfully!");
            form.reset(); // Reset the form after successful registration
        })
        .catch((error) => {
            const errorCode = error.code;
            const errorMessage = error.message;
            showPopup(errorMessage);
        });
});

function showPopup(message) {
    // Create a popup element
    const popup = document.createElement('div');
    popup.className = 'popup';
    popup.innerText = message;

    // Style the popup
    popup.style.position = 'fixed';
    popup.style.top = '50%';
    popup.style.left = '50%';
    popup.style.transform = 'translate(-50%, -50%)';
    popup.style.backgroundColor = '#fff';
    popup.style.padding = '20px';
    popup.style.boxShadow = '0 0 10px rgba(0, 0, 0, 0.1)';
    popup.style.zIndex = '1000';

    // Append the popup to the body
    document.body.appendChild(popup);

    // Remove the popup after 3 seconds
    setTimeout(() => {
        document.body.removeChild(popup);
    }, 3000);
}