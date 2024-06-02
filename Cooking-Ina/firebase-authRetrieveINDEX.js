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

document.addEventListener("DOMContentLoaded", function () {
    // Wait for Firebase authentication state changes
    onAuthStateChanged(auth, (user) => {
        if (user) {
            // User is signed in
            // Check if user data is already in localStorage
            const storedUserData = localStorage.getItem("userData");
            if (storedUserData) {
                const userData = JSON.parse(storedUserData);
                updateUIWithUserData(userData);
            } else {
                // Fetch user data from Firestore using user.uid
                const userRef = doc(db, "users", user.uid);
                onSnapshot(userRef, (doc) => {
                    if (doc.exists()) {
                        const userData = doc.data();
                        // Store user data in localStorage
                        localStorage.setItem("userData", JSON.stringify(userData));
                        updateUIWithUserData(userData);
                    } else {
                        console.log("No such document!");
                    }
                });
            }
        } else {
            // User is signed out
            console.log("User is signed out");
            // Display contact information
            const contactInfo = document.getElementById("contactInfo");
            if (contactInfo) {
                contactInfo.innerHTML = `Phone no: <span>+63 997 267 1584</span> or email us: <span>CookingIna@gmail.com</span>`;
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
                    <li><a href="#home" class="nav-links">HOME</a></li>
                    <li><a href="#about" class="nav-links">ABOUT</a></li>
                    <li><a href="recipes.php" class="nav-links">MAIN MENU</a></li>
                    <li><a href="recipes-list.php" class="nav-links">COURSES</a></li>
                    <li><a href="#reviews" class="nav-links">REVIEWS</a></li>
                    <li><a href="#gallery" class="nav-links">GALLERY</a></li>
                    <li><a href="#blogs" class="nav-links">SPECIALS</a></li>
                    <li><a href="#consect" class="nav-links">CONTACT</a></li>
                    <li><a id="logoutBtn" href="#" class="nav-links">LOGOUT</a></li>
                `;
            } else {
                // User is signed out
                navItems.innerHTML = `
                    <li><a href="#home" class="nav-links">HOME</a></li>
                    <li><a href="#about" class="nav-links">ABOUT</a></li>
                    <li><a href="recipes.php" class="nav-links">MAIN MENU</a></li>
                    <li><a href="#gallery" class="nav-links">GALLERY</a></li>
                    <li><a href="#team" class="nav-links">TEAM</a></li>
                    <li><a href="#reviews" class="nav-links">REVIEWS</a></li>
                    <li><a href="#blogs" class="nav-links">SPECIALS</a></li>
                    <li><a href="#consect" class="nav-links">CONTACT</a></li>
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
                // Sign-out successful, clear localStorage and redirect to index.php
                localStorage.removeItem("userData");
                window.location.href = "index.php";
            }).catch((error) => {
                console.error("Error signing out:", error);
            });
        }
    });
});

function updateUIWithUserData(userData) {
    const contactInfo = document.getElementById("contactInfo");
    if (contactInfo) {
        contactInfo.innerHTML = `User: <span id="loggedInUserName">${userData.firstName} ${userData.lastName}</span>`;
    }
}
