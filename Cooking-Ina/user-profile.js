import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import {
    getFirestore,
    doc,
    updateDoc,
    getDoc
} from "https://www.gstatic.com/firebasejs/10.11.0/firebase-firestore.js";
import {
    getAuth,
    onAuthStateChanged,
    reauthenticateWithCredential,
    updatePassword,
    signOut,
    EmailAuthProvider
} from "https://www.gstatic.com/firebasejs/10.11.0/firebase-auth.js";
import {
    getStorage, ref, uploadBytes, getDownloadURL
} from "https://www.gstatic.com/firebasejs/10.11.0/firebase-storage.js";



// Firebase configuration
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
const storage = getStorage(app);

document.addEventListener('DOMContentLoaded', async function () {
    await new Promise((resolve) => {
        const unsubscribe = onAuthStateChanged(auth, (user) => {
            unsubscribe(); // Stop listening for further changes
            resolve(user); // Resolve the promise with the user
        });
    }).then(async (user) => {
        if (user) {
            const userProfile = await getUserProfile(user.uid);
            if (userProfile) {
                populateForm(userProfile);
            }

            // Display email in the email field
            const userEmail = user.email;
            document.getElementById('email').value = userEmail || '';
        } else {
            Swal.fire({
                icon: 'error',
                title: 'User Not Logged In',
                text: 'Please log in to view and edit your profile.'
            }).then(() => {
                window.location.href = 'login.php'; // Redirect to login.php
            });
        }
    });

    const saveBtn = document.getElementById('saveBtn');
    saveBtn.addEventListener('click', handleSaveProfile);

    const changePasswordBtn = document.getElementById('changePassBtn');
    changePasswordBtn.addEventListener('click', handleChangePassword);

    const fileInput = document.querySelector('.account-settings-fileinput');
    fileInput.addEventListener('change', handleFileUpload);
});

async function getUserProfile(userId) {
    const userDocRef = doc(db, 'users', userId);

    try {
        const docSnap = await getDoc(userDocRef);
        if (docSnap.exists()) {
            return docSnap.data();
        } else {
            return null;
        }
    } catch (error) {
        console.error('Error getting user profile:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error retrieving user profile. Please try again.'
        });
        return null;
    }
}

function populateForm(userProfile) {
    document.getElementById('firstName').value = userProfile.firstName || '';
    document.getElementById('lastName').value = userProfile.lastName || '';
    document.getElementById('phoneNumber').value = userProfile.phoneNumber || '';
    document.getElementById('address').value = userProfile.address || '';
    document.getElementById('bio').value = userProfile.bio || '';
    document.getElementById('birthday').value = userProfile.birthday || '';
    document.getElementById('country').value = userProfile.country || '';
    document.getElementById('webTwitter').value = userProfile.webTwitter || '';
    document.getElementById('webFB').value = userProfile.webFB || '';
    document.getElementById('webGoogle').value = userProfile.webGoogle || '';
    document.getElementById('webLinkedIn').value = userProfile.webLinkedIn || '';
    document.getElementById('webInstagram').value = userProfile.webInstagram || '';

    // Display profile picture
    const profilePicture = document.getElementById('profilePicture');
    profilePicture.src = userProfile.profilePicture || 'https://bootdey.com/img/Content/avatar/avatar1.png';

    // Display email in the email field if it exists
    const userEmail = auth.currentUser.email;
    if (userEmail) {
        document.getElementById('email').value = userEmail;
    }
}

async function handleSaveProfile() {
    const firstName = document.getElementById('firstName').value.trim();
    const lastName = document.getElementById('lastName').value.trim();
    const phoneNumber = document.getElementById('phoneNumber').value.trim();
    const address = document.getElementById('address').value.trim();
    const bio = document.getElementById('bio').value.trim();
    const birthday = document.getElementById('birthday').value.trim();
    const country = document.getElementById('country').value.trim();
    const webTwitter = document.getElementById('webTwitter').value.trim();
    const webFB = document.getElementById('webFB').value.trim();
    const webGoogle = document.getElementById('webGoogle').value.trim();
    const webLinkedIn = document.getElementById('webLinkedIn').value.trim();
    const webInstagram = document.getElementById('webInstagram').value.trim();

    const user = auth.currentUser;

    if (!user) {
        Swal.fire({
            icon: 'error',
            title: 'User Not Logged In',
            text: 'Please log in to save your profile changes.'
        });
        return;
    }

    try {
        await saveProfile(user.uid, { firstName, lastName, phoneNumber, address, bio, birthday, country, webTwitter, webFB, webGoogle, webLinkedIn, webInstagram });
        Swal.fire({
            icon: 'success',
            title: 'Profile saved successfully!'
        });
    } catch (error) {
        console.error('Error saving profile:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error saving profile. Please try again.'
        });
    }
}

async function saveProfile(userId, profileData) {
    const userDocRef = doc(db, 'users', userId);

    try {
        await updateDoc(userDocRef, profileData);
    } catch (error) {
        console.error('Error updating profile:', error);
        throw error;
    }
}

async function handleChangePassword() {
    const user = auth.currentUser;

    if (!user) {
        Swal.fire({
            icon: 'error',
            title: 'User Not Logged In',
            text: 'Please log in to change your password.'
        });
        return;
    }

    const oldPassword = document.getElementById('oldPassword').value.trim();
    const newPassword = document.getElementById('newPassword').value.trim();
    const confirmPassword = document.getElementById('confirmPassword').value.trim();

    // Check if any of the fields are empty
    if (!oldPassword || !newPassword || !confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Empty Fields',
            text: 'Please fill in all the fields.'
        });
        return;
    }

    // Validate the new password format
    if (!validatePassword(newPassword)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Password',
            text: 'Password must be 8-15 characters long and contain at least one digit, one lowercase letter, one uppercase letter, and one special character.'
        });
        return;
    }

    // Check if the new passwords match
    if (newPassword !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Passwords Do Not Match',
            text: 'Please make sure the new passwords match.'
        });
        return;
    }

    try {
        // Reauthenticate the user with their current password before changing it
        const credential = EmailAuthProvider.credential(user.email, oldPassword);
        await reauthenticateWithCredential(user, credential);

        // Change the password
        await updatePassword(user, newPassword);

        // Logout and redirect to login page
        await signOut(auth);
        Swal.fire({
            icon: 'success',
            title: 'Password Changed Successfully!',
            text: 'Your password has been updated. You are now logged out.',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'login.php'; // Redirect to login.php
        });
    } catch (error) {
        console.error('Error changing password:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error changing password. Please try again.'
        });
    }
}

function validatePassword(password) {
    const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
    return regex.test(password);
}

async function handleFileUpload(event) {
    const file = event.target.files[0];
    const userId = auth.currentUser.uid;

    try {
        // Upload file to Firebase Storage
        const storageRef = ref(storage, `profilePictures/${userId}/${file.name}`);
        const uploadTask = uploadBytes(storageRef, file);
        const snapshot = await uploadTask;

        // Get download URL of uploaded file
        const downloadURL = await getDownloadURL(snapshot.ref);

        // Update user's profile picture URL in Firestore
        await updateProfilePicture(userId, downloadURL);

        // Update profile picture in UI
        const profilePicture = document.getElementById('profilePicture');
        profilePicture.src = downloadURL;

        // Show success message
        Swal.fire({
            icon: 'success',
            title: 'Profile Picture Updated',
            text: 'Your profile picture has been updated successfully.'
        });
    } catch (error) {
        console.error('Error uploading profile picture:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while uploading your profile picture. Please try again.'
        });
    }
}

async function updateProfilePicture(userId, downloadURL) {
    const userDocRef = doc(db, 'users', userId);

    try {
        await updateDoc(userDocRef, { profilePicture: downloadURL });
    } catch (error) {
        console.error('Error updating profile picture URL:', error);
        throw error;
    }
}

const backBtn = document.getElementById('backBtn');
backBtn.addEventListener('click', function () {
    window.history.back();
});

const resetButton = document.getElementById("resetPhoto");

// Add click event listener to the reset button
resetButton.addEventListener("click", function () {
    // Get the profile picture element
    const profilePicture = document.getElementById("profilePicture");

    // Set the source of the profile picture to the default image URL
    profilePicture.src = "https://bootdey.com/img/Content/avatar/avatar1.png";
});