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

let cropper; // Define cropper globally

document.addEventListener('DOMContentLoaded', function () {
    const loader = document.querySelector(".loader");
    let profilePictureLoaded = false;

    // Function to check if all data and profile picture are loaded
    function checkAllLoaded() {
        if (loader && profilePictureLoaded) {
            loader.classList.add("loader--hidden");
            loader.addEventListener("transitionend", () => {
                setTimeout(() => {
                    if (loader.parentNode) {
                        loader.parentNode.removeChild(loader);
                    }
                }, 500);
            });
        }
    }

    // Load user profile and set profile picture
    onAuthStateChanged(auth, async (user) => {
        if (user) {
            const userProfile = await getUserProfile(user.uid);
            if (userProfile) {
                populateForm(userProfile);
                // Save user profile to localStorage
                localStorage.setItem('userProfile', JSON.stringify(userProfile));
            }
            document.getElementById('email').value = user.email || '';
            profilePictureLoaded = true; // Set profile picture as loaded
            checkAllLoaded(); // Check if all data and profile picture are loaded
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

    // Event listener for the profile picture
    document.getElementById('profilePicture').addEventListener('load', function () {
        profilePictureLoaded = true; // Set profile picture as loaded
        checkAllLoaded(); // Check if all data and profile picture are loaded
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

// Define global variable for default profile picture URL
const defaultProfilePictureURL = 'https://bootdey.com/img/Content/avatar/avatar1.png';

// Event listener for the reset button
document.getElementById('resetPhoto').addEventListener('click', async function () {
    // Set the profile picture back to the default one
    document.getElementById('profilePicture').src = defaultProfilePictureURL;

    // Save the default profile picture URL to the database
    await updateProfilePicture(defaultProfilePictureURL);
});

// Function to update profile picture in the database
async function updateProfilePicture(profilePictureURL) {
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
        // Update user profile in Firestore
        await updateDoc(doc(db, 'users', user.uid), { profilePicture: profilePictureURL });

        Swal.fire({
            icon: 'success',
            title: 'Profile picture reset successfully!'
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
        webInstagram: document.getElementById('webInstagram').value.trim(),
        profilePicture: document.getElementById('profilePicture').src // Get current profile picture URL
    };

    try {
        // Update user profile in Firestore
        await updateDoc(doc(db, 'users', user.uid), profileData);

        // Update user profile in localStorage
        localStorage.setItem('userProfile', JSON.stringify(profileData));

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

// Function to compress the image blob
async function compressImage(blob, maxSize) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = (event) => {
            const img = new Image();
            img.src = event.target.result;
            img.onload = () => {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                const maxWidth = 1024; // Max width for the compressed image
                const maxHeight = 1024; // Max height for the compressed image

                let width = img.width;
                let height = img.height;

                if (width > height) {
                    if (width > maxWidth) {
                        height *= maxWidth / width;
                        width = maxWidth;
                    }
                } else {
                    if (height > maxHeight) {
                        width *= maxHeight / height;
                        height = maxHeight;
                    }
                }

                canvas.width = width;
                canvas.height = height;

                ctx.drawImage(img, 0, 0, width, height);

                canvas.toBlob((compressedBlob) => {
                    if (compressedBlob.size > maxSize) {
                        reject(new Error('Compressed image exceeds maximum size'));
                    } else {
                        resolve(compressedBlob);
                    }
                }, 'image/jpeg', 0.7); // Adjust compression quality as needed
            };
        };
        reader.readAsDataURL(blob);
    });
}


// Event listener for the crop image button
document.getElementById('cropImage').addEventListener('click', async function () {
    if (cropper) {
        try {
            // Retrieve cropped data as Blob
            const croppedBlob = await new Promise((resolve) => {
                cropper.getCroppedCanvas().toBlob((blob) => {
                    resolve(blob);
                });
            });

            // Upload cropped photo to Firebase Storage
            const storageRef = ref(storage, 'profilePictures/' + auth.currentUser.uid);
            const uploadTaskSnapshot = await uploadBytes(storageRef, croppedBlob);

            // Get download URL of the uploaded cropped photo
            const croppedImageUrl = await getDownloadURL(uploadTaskSnapshot.ref);

            // Set the cropped image as the source of the profile picture
            document.getElementById('profilePicture').src = croppedImageUrl;

            // Close the modal
            $('#imageCropperModal').modal('hide');
        } catch (error) {
            console.error('Error cropping and uploading image:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error cropping and uploading image. Please try again.'
            });
        }
    }
});

// Function to convert dataURL to Blob
function dataURLtoBlob(dataURL) {
    const parts = dataURL.split(';base64,');
    const contentType = parts[0].split(':')[1];
    const raw = window.atob(parts[1]);
    const rawLength = raw.length;
    const uInt8Array = new Uint8Array(rawLength);
    for (let i = 0; i < rawLength; ++i) {
        uInt8Array[i] = raw.charCodeAt(i);
    }
    return new Blob([uInt8Array], { type: contentType });
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

// Define handleFileUpload function
function handleFileUpload(event) {
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
}

$('#imageCropperModal').on('hidden.bs.modal', function () {
    if (cropper) {
        cropper.destroy();
        cropper = null;
        document.getElementById('imageToCrop').src = ''; // Clear the image source
    }
});
