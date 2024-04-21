import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import { getFirestore, setDoc, doc } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";
import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";

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



const submit = document.getElementById('loginButton');
submit.addEventListener("click", function (event) {
    event.preventDefault();

    // Retrieve input values
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Function to validate email using regex
    function isEmailValid(email) {
        const regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        return regex.test(email);
    }

    // Error handling
    if (!email || !password) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Please fill in all the required input fields.'
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

    // Perform login
    signInWithEmailAndPassword(auth, email, password)
        .then((userCredential) => {
            const user = userCredential.user;
            if (user.emailVerified) {
                console.log("User signed in:", user);
                Swal.fire({
                    icon: 'success',
                    title: 'Login Successful',
                    text: 'You have successfully logged in.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Clear input fields
                    document.getElementById('email').value = '';
                    document.getElementById('password').value = '';
                    // Redirect to home page
                    window.location.href = "recipes-list.php";
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Email Not Verified',
                    text: 'Please verify your email to log in.'
                });
            }
        })
        .catch((error) => {
            console.error("Login failed:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Wrong credentials.'
            });
        });
});
