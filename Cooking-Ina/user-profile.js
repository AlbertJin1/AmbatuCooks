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

document.addEventListener('DOMContentLoaded', function () {
    onAuthStateChanged(auth, async (user) => {
        if (user) {
            const userProfile = await getUserProfile(user.uid);
            if (userProfile) {
                populateForm(userProfile);
            }
            document.getElementById('email').value = user.email || '';
        } else {
            Swal.fire({
                icon: 'error',
                title: 'User Not Logged In',
                text: 'Please log in to view and edit your profile.'
            }).then(() => {
                window.location.href = 'login.php';
            });
        }
    });

    document.getElementById('saveBtn').addEventListener('click', handleSaveProfile);
    document.getElementById('changePassBtn').addEventListener('click', handleChangePassword);
    document.getElementById('profileImageInput').addEventListener('change', handleFileUpload);
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
    document.getElementById('profilePicture').src = userProfile.profilePicture || 'https://bootdey.com/img/Content/avatar/avatar1.png';
}

async function handleSaveProfile() {
    const user = auth.currentUser;
    if (!user) {
        Swal.fire({
            icon: 'error',
            title: 'User Not Logged In',
            text: 'Please log in to save your profile changes.'
        });
        return;
    }

    const profileData = {
        firstName: document.getElementById('firstName').value.trim(),
        lastName: document.getElementById('lastName').value.trim(),
        phoneNumber: document.getElementById('phoneNumber').value.trim(),
        address: document.getElementById('address').value.trim(),
        bio: document.getElementById('bio').value.trim(),
        birthday: document.getElementById('birthday').value.trim(),
        country: document.getElementById('country').value.trim(),
        webTwitter: document.getElementById('webTwitter').value.trim(),
        webFB: document.getElementById('webFB').value.trim(),
        webGoogle: document.getElementById('webGoogle').value.trim(),
        webLinkedIn: document.getElementById('webLinkedIn').value.trim(),
        webInstagram: document.getElementById('webInstagram').value.trim()
    };

    try {
        await updateDoc(doc(db, 'users', user.uid), profileData);
        Swal.fire({
            icon: 'success',
            title: 'Profile saved successfully!'
        }).then(() => {
            location.reload(); // Refresh the page after a successful save
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

    if (!oldPassword || !newPassword || !confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Empty Fields',
            text: 'Please fill in all the fields.'
        });
        return;
    }

    if (!validatePassword(newPassword)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Password',
            text: 'Password must be 8-15 characters long and contain at least one digit, one lowercase letter, one uppercase letter, and one special character.'
        });
        return;
    }

    if (newPassword !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'Passwords Do Not Match',
            text: 'Please make sure the new passwords match.'
        });
        return;
    }

    try {
        const credential = EmailAuthProvider.credential(user.email, oldPassword);
        await reauthenticateWithCredential(user, credential);
        await updatePassword(user, newPassword);
        await signOut(auth);
        Swal.fire({
            icon: 'success',
            title: 'Password Changed Successfully!',
            text: 'Your password has been updated. You are now logged out.',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = 'login.php';
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

let cropper;
document.getElementById('profileImageInput').addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            const imageElement = document.getElementById('imageToCrop');
            imageElement.src = e.target.result; // Set the source of the image

            // Ensure previous cropper instance is destroyed
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }

            // Wait for modal to be shown
            $('#imageCropperModal').on('shown.bs.modal', function () {
                // Initialize Cropper
                cropper = new Cropper(imageElement, {
                    aspectRatio: 1,
                    viewMode: 1,
                    scalable: true,
                    cropBoxResizable: true,
                    dragMode: 'move'
                });
            });

            // Show the modal after setting image source
            $('#imageCropperModal').modal('show');
        };
        reader.readAsDataURL(file);
    }
});

$('#imageCropperModal').on('hidden.bs.modal', function () {
    if (cropper) {
        cropper.destroy();
        cropper = null;
        document.getElementById('imageToCrop').src = ''; // Clear the image source
    }
});