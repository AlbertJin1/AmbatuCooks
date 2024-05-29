import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import { getFirestore, setDoc, doc } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";
import { getAuth, sendPasswordResetEmail } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyCW7W43zrdrBrF50yG2S6szorhMiWU2060",
    authDomain: "cooking-ina-mo.firebaseapp.com",
    projectId: "cooking-ina-mo",
    storageBucket: "cooking-ina-mo.appspot.com",
    messagingSenderId: "151249945282",
    appId: "1:151249945282:web:f5f7031dc3e1261489315b"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

const submit = document.getElementById('forgotPasswordButton');
const emailInput = document.getElementById('email');

// Listen for keypress event on email input
emailInput.addEventListener('keypress', function (event) {
    if (event.key === 'Enter') {
        submit.click(); // Trigger click event on submit button
    }
});
submit.addEventListener("click", function (event) {
    event.preventDefault();

    // Retrieve input value
    const email = document.getElementById('email').value;

    // Function to validate email using regex
    function isEmailValid(email) {
        const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return regex.test(email);
    }

    // Error handling
    if (!email) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter your email address.'
        });
        return;
    }

    if (!isEmailValid(email)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Email',
            text: 'Please enter a valid email address.'
        });
        return;
    }

    // Perform password reset
    const auth = getAuth();
    sendPasswordResetEmail(auth, email)
        .then(() => {
            // Password reset email sent successfully
            Swal.fire({
                icon: 'success',
                title: 'Password Reset Email Sent',
                text: 'Please check your email for the password reset link.'
            }).then(() => {
                // Clear input field
                document.getElementById('email').value = '';
                // Redirect to login page
                window.location.href = "login.php";
            });
        })
        .catch((error) => {
            console.error("Password reset error:", error);
            Swal.fire({
                icon: 'error',
                title: 'Password Reset Error',
                text: 'Unable to send a password reset email. Please check the email address.'
            });
        });
});
