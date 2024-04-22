
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import { getFirestore, onSnapshot, doc } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";
import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";

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
const db = getFirestore(app);
const auth = getAuth(app);

// Wait for the DOM content to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
    // Wait for Firebase authentication state changes
    onAuthStateChanged(auth, (user) => {
        if (user) {
            // User is signed in
            // Fetch user data from Firestore using user.uid
            const userRef = doc(db, "users", user.uid);
            onSnapshot(userRef, (doc) => {
                if (doc.exists()) {
                    // Update UI with user data
                    const userData = doc.data();
                    const contactInfo = document.getElementById("contactInfo");
                    if (contactInfo) {
                        contactInfo.innerHTML = `User: <span id="loggedInUserName">${userData.firstName} ${userData.lastName}</span>`;
                    }
                } else {
                    console.log("No such document!");
                }
            });
        } else {
            // User is signed out
            console.log("User is signed out");
            // Display contact information
            const contactInfo = document.getElementById("contactInfo");
            if (contactInfo) {
                contactInfo.innerHTML = `Phone no: <span>+63 997 267 1584</span> or email us: <span>CookingIna@gmail.com</span>`;
            }
            // Redirect users if they try to access recipes-list.php
            if (window.location.pathname.includes("recipes-list.php")) {
                // Display SweetAlert2
                Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'You need to log in first!',
                    timer: 2000, // Timer in milliseconds (3 seconds)
                    timerProgressBar: true, // Show progress bar
                    allowOutsideClick: false, // Prevent outside click from closing
                    showConfirmButton: false // Hide confirm button
                }).then(() => {
                    // Redirect to login page
                    window.location.href = "login.php";
                });
            }
        }
    });

    onAuthStateChanged(auth, (user) => {
        const userIcon = document.getElementById("userIcon");
        if (user) {
            // User is signed in
            // Show the user icon
            userIcon.style.display = "inline-block";
            userIcon.addEventListener('click', () => {
                // Navigate to user-profile.php
                window.location.href = "user-profile.php";
            });
        } else {
            // User is signed out
            // Hide the user icon
            userIcon.style.display = "none";
        }
    });

    // Update navigation links based on authentication state
    const navItems = document.getElementById("nav-items");
    if (navItems) {
        onAuthStateChanged(auth, (user) => {
            if (user) {
                // User is signed in
                navItems.innerHTML = `
                    <li><a href="index.php#home" class="nav-links">HOME</a></li>
                    <li><a href="recipes.php" class="nav-links">MAIN MENU</a></li>
                    <li><a href="#recipes-main" class="nav-links">MAIN DISH</a></li>
                    <li><a href="#recipes-appe" class="nav-links">APPETIZER</a></li>
                    <li><a href="#recipes-dessert" class="nav-links">DESSERT</a></li>
                    <li><a href="#recipes-beve" class="nav-links">BEVERAGE</a></li>
                    <li><a id="logoutBtn" href="#" class="nav-links">LOGOUT</a></li>
                `;
            } else {
                // User is signed out
                navItems.innerHTML = `
                    <li><a href="index.php#home" class="nav-links">HOME</a></li>
                    <li><a href="login.php" class="nav-links">LOGIN</a></li>
                    <li><a href="register.php" class="nav-links">SIGNUP</a></li>
                `;
            }
        });
    }

    // Logout Functionality
    document.addEventListener("click", (event) => {
        const logoutBtn = event.target.closest("#logoutBtn");
        if (logoutBtn) {
            auth.signOut().then(() => {
                // Sign-out successful, redirect to index.php
                window.location.href = "index.php";
            }).catch((error) => {
                console.error("Error signing out:", error);
            });
        }
    });
});