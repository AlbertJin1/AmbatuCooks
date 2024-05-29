import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import {
    getFirestore,
    collection,
    addDoc,
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
    const recipeData = {};
    let hasError = false;
    let currentUser = null; // Variable to store current user

    onAuthStateChanged(auth, async (user) => {
        if (user) {
            currentUser = user;
            // Fetch user's first name and last name from Firestore
            const userDoc = await getDoc(doc(db, 'users', user.uid));
            const userData = userDoc.data();
            if (userData) {
                const fullName = userData.firstName + ' ' + userData.lastName;
                // Update HTML to display user's full name
                document.getElementById('displayName').textContent = fullName;
            }
        } else {
            // No user is signed in, redirect to login page after 2 seconds
            Swal.fire({
                icon: 'error',
                title: 'Authentication Required',
                text: 'You need to sign in to access this page.',
                showConfirmButton: false,
                timer: 2000, // 2 seconds timeout
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            }).then(() => {
                // Redirect to login page
                window.location.href = 'login.php'; // Change to your login page URL
            });
        }
    });

    // Listen for Enter key press on form fields to trigger form submission
    document.querySelectorAll('input, textarea').forEach(element => {
        element.addEventListener('keypress', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Prevent default form submission behavior
                document.getElementById('submitRecipe').click(); // Simulate click on submit button
            }
        });
    });

    // Initialize Cropper
    let cropper;

    // Handle File Input Change
    document.getElementById('recipeImage').addEventListener('change', function () {
        const input = this;
        if (!input.files || !input.files[0]) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select an image first!',
            });
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            const image = new Image();
            image.src = e.target.result;
            image.onload = function () {
                // Destroy previous cropper instance
                if (cropper) {
                    cropper.destroy();
                }

                // Initialize new cropper instance
                const imageElement = document.getElementById('imagePreview');
                imageElement.src = e.target.result;
                $('#cropModal').modal('show'); // Show modal
                cropper = new Cropper(imageElement, {
                    aspectRatio: 1.62, // Aspect ratio of 1.62:1
                    viewMode: 2, // Display in "cropper" mode
                });
            };
        };
        reader.readAsDataURL(input.files[0]);
    });

    // Handle Crop Image Button Click
    document.getElementById('cropImage').addEventListener('click', function () {
        const croppedCanvas = cropper.getCroppedCanvas();
        if (!croppedCanvas) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please crop the image first!',
            });
            return;
        }

        // Get cropped image as data URL
        const croppedImageDataURL = croppedCanvas.toDataURL();

        // Display cropped image in the container
        const croppedImageContainer = document.getElementById('croppedImageContainer');
        croppedImageContainer.innerHTML = `<img src="${croppedImageDataURL}" alt="Cropped Image" style="max-width: 100%;">`;

        // Close modal
        $('#cropModal').modal('hide');
    });


    document.getElementById('addIngredient').addEventListener('click', function (event) {
        setTimeout(() => {
            event.target.blur(); // Remove focus from the clicked button
        }, 10);
        const ingredientTableBody = document.querySelector('#ingredientTable tbody');
        const newRow = ingredientTableBody.insertRow();
        newRow.classList.add('ingredientInput');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="ingredientName[]" placeholder="Ingredient Name" required></td>
            <td><input type="text" class="form-control" name="ingredientQuantity[]" placeholder="Quantity" required></td>
            <td><button type="button" class="btn btn-link removeIngredient"><i class="fas fa-times"></i></button></td>
        `;
        newRow.querySelector('.removeIngredient').addEventListener('click', function () {
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to remove this ingredient?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'No, keep it',
            }).then((result) => {
                if (result.isConfirmed) {
                    newRow.parentNode.removeChild(newRow);
                }
            });
        });
    });

    document.getElementById('addDirection').addEventListener('click', function (event) {
        setTimeout(() => {
            event.target.blur(); // Remove focus from the clicked button
        }, 10);
        const directionsList = document.getElementById('directionsList');
        const newStep = document.createElement('li');
        newStep.innerHTML = `
            <div class="direction-item input-group">
                <input id="directInput" type="text" class="form-control directionInput" name="directions[]" placeholder="Next Step" required>
                <div class="input-group-append">
                    <button id="directRemove" type="button" class="btn btn-danger removeDirection"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `;
        directionsList.appendChild(newStep);

        // Hide remove button for the first step
        if (directionsList.children.length === 1) {
            newStep.querySelector('.removeDirection').style.display = 'none';
        }
    });

    document.getElementById('addRecipeForm').addEventListener('click', function (event) {
        if (event.target.classList.contains('removeDirection')) {
            const step = event.target.closest('li');
            Swal.fire({
                title: 'Confirmation',
                text: 'Are you sure you want to remove this direction?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'No, keep it',
            }).then((result) => {
                if (result.isConfirmed) {
                    step.parentNode.removeChild(step);
                }
            });
        }
    });

    document.getElementById('submitRecipe').addEventListener('click', async function () {
        // Fetch user's full name from Firestore
        const userDoc = await getDoc(doc(db, 'users', currentUser.uid));
        const userData = userDoc.data();
        const fullName = userData.firstName + ' ' + userData.lastName;

        const recipeData = {};
        let hasError = false;

        // Check if recipeName field is empty
        const recipeName = document.getElementById('recipeName').value.trim();
        if (recipeName === '') {
            hasError = true;
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please enter a recipe name!',
            });
        } else {
            recipeData['recipeName'] = recipeName;
        }

        // Check if a category is selected
        const recipeCategory = document.getElementById('recipeCategory').value.trim();
        if (recipeCategory === '') {
            hasError = true;
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please select a category!',
            });
        } else {
            recipeData['recipeCategory'] = recipeCategory;
        }

        // Check if a short description is provided
        const recipeDescription = document.getElementById('recipeDescription').value.trim();
        if (recipeDescription === '') {
            hasError = true;
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please provide a short description!',
            });
        } else {
            recipeData['recipeDescription'] = recipeDescription;
        }

        // Check if any ingredient field is empty
        const ingredientNames = document.getElementsByName('ingredientName[]');
        const ingredientQuantities = document.getElementsByName('ingredientQuantity[]');
        const ingredients = [];

        for (let i = 0; i < ingredientNames.length; i++) {
            const name = ingredientNames[i].value.trim();
            const quantity = ingredientQuantities[i].value.trim();
            if (name === '' || quantity === '') {
                hasError = true;
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields in the Ingredients section!',
                });
                break; // Exit loop on first empty field
            }
            ingredients.push({ name, quantity });
        }
        recipeData['ingredients'] = ingredients;

        // Check if any direction field is empty
        const directionInputs = document.querySelectorAll('.directionInput');
        const directions = [];
        directionInputs.forEach(input => {
            const direction = input.value.trim();
            if (direction === '') {
                hasError = true;
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Please fill in all fields in the Directions section!',
                });
                return; // Exit loop if any direction is empty
            }
            directions.push(direction);
        });

        if (directions.length === 0) {
            hasError = true;
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please add at least one direction!',
            });
        } else {
            recipeData['directions'] = directions;
        }

        if (!cropper || !cropper.getCroppedCanvas()) {
            hasError = true;
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please crop the image first!',
            });
        } else {
            // Get cropped canvas as a Blob
            const croppedCanvas = cropper.getCroppedCanvas();
            croppedCanvas.toBlob(async function (blob) {
                try {
                    // Upload cropped image to Firebase Storage
                    const storageRef = ref(storage, 'recipe_images/' + Date.now() + '.png');
                    const snapshot = await uploadBytes(storageRef, blob);

                    // Get download URL of the uploaded image
                    const imageURL = await getDownloadURL(snapshot.ref);

                    // Add imageURL and addedBy to recipeData
                    recipeData['imageURL'] = imageURL;
                    recipeData['addedBy'] = fullName;

                    if (!hasError) {
                        // Save recipeData to Firestore
                        const docRef = await addDoc(collection(db, "recipes"), recipeData);
                        console.log("Document written with ID: ", docRef.id);

                        // Show success message with a timeout
                        Swal.fire({
                            icon: 'success',
                            title: 'Recipe Submitted!',
                            text: 'Your recipe has been successfully submitted.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            // Reload the page
                            location.reload();
                        });
                    }
                } catch (error) {
                    console.error('Error adding document: ', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while submitting your recipe. Please try again later.',
                    });
                }
            }, 'image/png');
        }
    });

});


$(document).ready(function () {
    $('#cropModal').on('shown.bs.modal', function () {
        // Set a minimum height for the modal body
        $('.modal-body').css('min-height', '500px'); // Adjust as needed
    });
});
