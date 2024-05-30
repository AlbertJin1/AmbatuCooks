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
    getStorage, ref, uploadBytes, getDownloadURL, deleteObject
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
    // Parse URL parameters to extract recipeId
    const urlParams = new URLSearchParams(window.location.search);
    const recipeId = urlParams.get('recipeId');

    const recipeData = {};
    let hasError = false;
    let currentUser = null;

    onAuthStateChanged(auth, async (user) => {
        if (user) {
            currentUser = user;
            const userDoc = await getDoc(doc(db, 'users', user.uid));
            const userData = userDoc.data();
            if (userData) {
                const fullName = userData.firstName + ' ' + userData.lastName;
                document.getElementById('displayName').textContent = fullName;
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Authentication Required',
                text: 'You need to sign in to access this page.',
                showConfirmButton: false,
                timer: 2000,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
            }).then(() => {
                window.location.href = 'login.php';
            });
        }
    });

    let cropper;

    document.getElementById('updateRecipeImage').addEventListener('change', function () {
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
                if (cropper) {
                    cropper.destroy();
                }

                const imageElement = document.getElementById('imagePreview');
                imageElement.src = e.target.result;
                $('#cropModal').modal('show');
                cropper = new Cropper(imageElement, {
                    aspectRatio: 1.62,
                    viewMode: 2,
                });
            };
        };
        reader.readAsDataURL(input.files[0]);
    });

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

        const croppedImageDataURL = croppedCanvas.toDataURL();

        const croppedImageContainer = document.getElementById('croppedImageContainer');
        croppedImageContainer.innerHTML = `<img src="${croppedImageDataURL}" alt="Cropped Image" style="max-width: 100%;">`;

        $('#cropModal').modal('hide');
    });


    document.getElementById('updateAddIngredient').addEventListener('click', function (event) {
        setTimeout(() => {
            event.target.blur();
        }, 10);
        const ingredientTableBody = document.querySelector('#updateIngredientTable tbody');
        const newRow = ingredientTableBody.insertRow();
        newRow.classList.add('updateIngredientInput');
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="updateIngredientName[]"
                    placeholder="Ingredient Name" required></td>
            <td><input type="text" class="form-control" name="updateIngredientQuantity[]"
                    placeholder="Quantity" required></td>
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

    document.getElementById('updateAddDirection').addEventListener('click', function (event) {
        setTimeout(() => {
            event.target.blur();
        }, 10);
        const directionsList = document.getElementById('updateDirectionsList');
        const newStep = document.createElement('li');
        newStep.innerHTML = `
            <div class="direction-item input-group">
                <input id="updateDirectInput" type="text" class="form-control directionInput"
                    name="updateDirections[]" placeholder="Next Step" required>
                <div class="input-group-append">
                    <button id="updateDirectRemove" type="button" class="btn btn-danger removeDirection"><i class="fas fa-times"></i></button>
                </div>
            </div>
        `;
        directionsList.appendChild(newStep);
    });

    // For removing ingredients
    document.querySelector('#updateIngredientTable tbody').addEventListener('click', function (event) {
        if (event.target.classList.contains('removeIngredient')) {
            const row = event.target.closest('tr');
            if (row) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to remove this ingredient?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it',
                    cancelButtonText: 'No, keep it',
                }).then((result) => {
                    if (result.isConfirmed) {
                        row.remove();
                    }
                });
            }
        }
    });

    // For removing directions
    document.getElementById('updateDirectionsList').addEventListener('click', function (event) {
        if (event.target.classList.contains('removeDirection')) {
            const step = event.target.closest('li');
            if (step) {
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to remove this direction?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, remove it',
                    cancelButtonText: 'No, keep it',
                }).then((result) => {
                    if (result.isConfirmed) {
                        step.remove();
                    }
                });
            }
        }
    });

    document.getElementById('updateRecipeSubmit').addEventListener('click', async function () {
        const recipeData = {};
        let hasError = false;

        const recipeName = document.getElementById('updateRecipeName').value.trim();
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

        const recipeCategory = document.getElementById('updateRecipeCategory').value.trim();
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

        const recipeDescription = document.getElementById('updateRecipeDescription').value.trim();
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

        const ingredientNames = document.getElementsByName('updateIngredientName[]');
        const ingredientQuantities = document.getElementsByName('updateIngredientQuantity[]');
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
                break;
            }
            ingredients.push({ name, quantity });
        }
        recipeData['ingredients'] = ingredients;

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
                return;
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

        // Check if there is a cropped photo
        const croppedImageContainer = document.getElementById('croppedImageContainer');
        if (croppedImageContainer.innerHTML.trim() !== '') {
            // There is a cropped photo, upload it to Firebase Storage
            const croppedCanvas = cropper.getCroppedCanvas();
            const blob = await new Promise(resolve => croppedCanvas.toBlob(resolve, 'image/png'));
            const storageRef = ref(storage, 'recipe_images/' + recipeId + '.png'); // Use the same filename
            const existingImageRef = ref(storage, 'recipe_images/' + recipeId + '.png');

            // Delete existing image if it exists
            try {
                await deleteObject(existingImageRef);
                console.log("Existing image deleted successfully");
            } catch (error) {
                console.error('Error deleting existing image: ', error);
            }

            // Upload new image
            const snapshot = await uploadBytes(storageRef, blob);
            const imageURL = await getDownloadURL(snapshot.ref);
            recipeData['imageURL'] = imageURL;
        }

        if (!hasError) {
            try {
                // Get the current user's display name
                const modifiedBy = document.getElementById('displayName').textContent;

                // Construct the data object to update
                const updatedData = {
                    ...recipeData,
                    modifiedBy: modifiedBy,
                    modifiedAt: new Date().toISOString() // Current datetime
                };

                // Update the document with the updated data
                await updateDoc(doc(db, "recipes", recipeId), updatedData);
                console.log("Document updated successfully");
                Swal.fire({
                    icon: 'success',
                    title: 'Recipe Updated!',
                    text: 'Your recipe has been successfully updated.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'recipes-list.php'; // Redirect after updating
                });
            } catch (error) {
                console.error('Error updating document: ', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'An error occurred while updating your recipe. Please try again later.',
                });
            }
        }
    });

    // Existing script
    $('#cropModal').on('shown.bs.modal', function () {
        $('.modal-body').css('min-height', '500px');
    });

    // Fetch and populate existing recipe data
    const recipeRef = doc(db, 'recipes', recipeId);
    try {
        const recipeSnapshot = await getDoc(recipeRef);
        if (recipeSnapshot.exists()) {
            const recipeData = recipeSnapshot.data();
            // Populate recipe name, category, and description
            document.getElementById('updateRecipeName').value = recipeData.recipeName;
            document.getElementById('updateRecipeCategory').value = recipeData.recipeCategory;
            document.getElementById('updateRecipeDescription').value = recipeData.recipeDescription;

            // Populate ingredients
            const ingredientTableBody = document.querySelector('#updateIngredientTable tbody');
            ingredientTableBody.innerHTML = ''; // Clear existing ingredients
            if (recipeData.ingredients && recipeData.ingredients.length > 0) {
                recipeData.ingredients.forEach(ingredient => {
                    const newRow = ingredientTableBody.insertRow();
                    newRow.classList.add('updateIngredientInput');
                    newRow.innerHTML = `
            <td><input type="text" class="form-control" name="updateIngredientName[]"
                    placeholder="Ingredient Name" required value="${ingredient.name}"></td>
            <td><input type="text" class="form-control" name="updateIngredientQuantity[]"
                    placeholder="Quantity" required value="${ingredient.quantity}"></td>
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
            }


            // Populate directions
            const directionsList = document.getElementById('updateDirectionsList');
            directionsList.innerHTML = ''; // Clear existing directions
            recipeData.directions.forEach((direction, index) => {
                const newStep = document.createElement('li');
                newStep.innerHTML = `
                    <div class="direction-item input-group">
                        <input id="updateDirectInput" type="text" class="form-control directionInput"
                            name="updateDirections[]" placeholder="Next Step" required value="${direction}">
                        <div class="input-group-append">
                            <button id="updateDirectRemove" type="button" class="btn btn-danger removeDirection"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                `;
                directionsList.appendChild(newStep);
                newStep.querySelector('.removeDirection').addEventListener('click', function () {
                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Are you sure you want to remove this direction?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, remove it',
                        cancelButtonText: 'No, keep it',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            newStep.parentNode.removeChild(newStep);
                        }
                    });
                });
            });
        } else {
            console.log('No such recipe found!');
        }
    } catch (error) {
        console.error('Error fetching document: ', error);
    }


});