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
    onAuthStateChanged(auth, (user) => {
        if (user) {
            // Check if user data is already in localStorage
            const storedUserData = localStorage.getItem("userData");
            if (storedUserData) {
                const userData = JSON.parse(storedUserData);
                updateUIWithUserData(userData);
            } else {
                // Fetch user data from Firestore
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
            console.log("User is signed out");
            // Display contact information
            const contactInfo = document.getElementById("contactInfo");
            if (contactInfo) {
                contactInfo.innerHTML = `Phone no: <span>+63 997 267 1584</span> or email us: <span>CookingIna@gmail.com</span>`;
            }
            // Redirect users if they try to access recipes-list.php
            if (window.location.pathname.includes("recipes-list.php")) {
                Swal.fire({
                    icon: 'info',
                    title: 'Oops...',
                    text: 'You need to log in first!',
                    timer: 2000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "login.php";
                });
            }
        }
    });

    onAuthStateChanged(auth, (user) => {
        const userIcon = document.getElementById("userIcon");
        if (user) {
            // Show the user icon
            addRecipe.style.display = "inline-block";
            addRecipe.addEventListener('click', () => {
                window.location.href = "add-recipe.php";
            });
            userIcon.style.display = "inline-block";
            userIcon.addEventListener('click', () => {
                window.location.href = "user-profile.php";
            });
        } else {
            // Hide the user icon
            userIcon.style.display = "none";
        }
    });

    const navItems = document.getElementById("nav-items");
    if (navItems) {
        onAuthStateChanged(auth, (user) => {
            if (user) {
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
                navItems.innerHTML = `
                    <li><a href="index.php#home" class="nav-links">HOME</a></li>
                    <li><a href="login.php" class="nav-links">LOGIN</a></li>
                    <li><a href="register.php" class="nav-links">SIGNUP</a></li>
                `;
            }
        });
    }

    document.addEventListener("click", (event) => {
        const logoutBtn = event.target.closest("#logoutBtn");
        if (logoutBtn) {
            auth.signOut().then(() => {
                // Clear localStorage on sign-out
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
