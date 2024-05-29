import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";
import {
    getFirestore,
    collection,
    addDoc,
    doc,
    updateDoc,
    getDoc,
    getDocs,
    query,
    where,
    deleteDoc,
    onSnapshot
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
    try {
        // Define categories and corresponding section IDs
        const categories = {
            'Main Dish': 'recipes-main',
            'Appetizer': 'recipes-appe',
            'Dessert': 'recipes-dessert',
            'Beverage': 'recipes-beve'
        };

        // Fetch existing recipes from HTML
        const existingRecipes = document.querySelectorAll('.food-items');
        const existingRecipeIds = new Set();
        existingRecipes.forEach(recipe => {
            existingRecipeIds.add(recipe.dataset.id);
        });

        // Listen for real-time changes in Firestore
        Object.entries(categories).forEach(([category, sectionId]) => {
            const recipesRef = collection(db, 'recipes');
            const categoryQuery = query(recipesRef, where('recipeCategory', '==', category));

            onSnapshot(categoryQuery, (snapshot) => {
                snapshot.docChanges().forEach((change) => {
                    const recipeData = change.doc.data();
                    const recipeId = change.doc.id;

                    if (!existingRecipeIds.has(recipeId)) {
                        // Append new recipe if it doesn't exist in the HTML
                        const section = document.getElementById(sectionId);
                        const menuDiv = section.querySelector('.menu');
                        const recipeHTML = createRecipeHTML({ id: recipeId, ...recipeData });
                        menuDiv.insertAdjacentHTML('beforeend', recipeHTML);
                    } else if (change.type === 'removed') {
                        // Remove recipe if it was deleted
                        const recipeToRemove = document.querySelector(`.food-items[data-id="${recipeId}"]`);
                        recipeToRemove.remove();
                    }
                });
            });
        });
    } catch (error) {
        console.error('Error fetching and appending recipes:', error);
    }
});

// Function to fetch recipes by category from Firestore
async function getRecipesByCategory(db, category) {
    const recipesRef = collection(db, 'recipes');
    const querySnapshot = await getDocs(query(recipesRef, where('recipeCategory', '==', category)));
    const recipes = [];
    querySnapshot.forEach(doc => {
        recipes.push({ id: doc.id, ...doc.data() });
    });
    return recipes;
}

// Function to listen for real-time updates to recipes
function listenForRecipeChanges(db, categories) {
    // Listen for changes to the 'recipes' collection
    const recipesRef = collection(db, 'recipes');
    onSnapshot(recipesRef, async (snapshot) => {
        for (const [category, sectionId] of Object.entries(categories)) {
            // Fetch recipes for the current category
            const recipes = await getRecipesByCategory(db, category);

            // Find the section where recipes are located
            const section = document.getElementById(sectionId);
            const menuDiv = section.querySelector('.menu');

            // Clear existing recipes in the section
            menuDiv.innerHTML = '';

            // Append new recipes after existing ones
            recipes.forEach(recipe => {
                const recipeHTML = createRecipeHTML(recipe);
                menuDiv.insertAdjacentHTML('beforeend', recipeHTML);
            });
        }
    });
}

// Function to show error message and reload the website after a delay
function showErrorAndReload(errorMessage) {
    // Show error message
    alert(errorMessage);
    // Reload the website after 3 seconds
    setTimeout(() => {
        location.reload();
    }, 3000);
}

// Event listener for delete button
document.addEventListener('click', async function (event) {
    if (event.target.classList.contains('delete-btn')) {
        const recipeId = event.target.dataset.id;
        const imageURL = event.target.dataset.image;

        // Show confirmation dialog
        const isConfirmed = await Swal.fire({
            title: 'Are you sure?',
            text: 'Once deleted, you will not be able to recover this recipe!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        });

        if (isConfirmed.isConfirmed) {
            try {
                // Delete document from Firestore
                await deleteRecipeFromFirestore(recipeId);

                // Update UI
                const deletedRecipe = event.target.closest('.food-items');
                deletedRecipe.remove();

                // Show success message
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Your recipe has been deleted.',
                    icon: 'success',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });

                // Reload the page after a delay to reflect changes
                setTimeout(() => {
                    location.reload();
                }, 2000); // Reload after 2 seconds to display the success message
            } catch (error) {
                console.error('Error deleting recipe:', error);
                // Show error message
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to delete recipe. Please try again later.',
                    icon: 'error',
                    timer: 2000,
                    timerProgressBar: true,
                    showConfirmButton: false
                });
            }
        }
    }
});

// Function to delete recipe document from Firestore
async function deleteRecipeFromFirestore(recipeId) {
    if (recipeId) {
        const recipeRef = doc(db, 'recipes', recipeId);
        await deleteDoc(recipeRef);
    } else {
        throw new Error('Recipe ID is undefined');
    }
}


// Function to create HTML for a recipe
function createRecipeHTML(recipe) {
    return `
        <div class="food-items">
            <img src="${recipe.imageURL}">
            <div class="details">
                <div class="details-sub">
                    <h2>${recipe.recipeName}</h2>
                </div>
                <p>${recipe.recipeDescription}</p>
                <a href="#popup1-${recipe.id}" class="btn">View Recipe</a>
                <div id="popup1-${recipe.id}" class="popup">
                    <a href="#recipes-${recipe.recipeCategory}" class="close">&times;</a>
                    <h2>${recipe.recipeName}</h2>
                    <div class="containers">
                        <div class="top">
                            <h2>Ingredients</h2>
                            <table>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                </tr>
                                ${recipe.ingredients.map(ingredient => `
                                    <tr>
                                        <td>${ingredient.name}</td>
                                        <td>${ingredient.quantity}</td>
                                    </tr>
                                `).join('')}
                            </table>
                        </div>
                        <div class="bottom">
                            <h2>Directions</h2>
                            <ol>
                                ${recipe.directions.map(direction => `
                                    <li>${direction}</li>
                                `).join('')}
                            </ol>
                            <h6>Added by: ${recipe.addedBy}</h6> <!-- Display addedBy here -->
                            <div class="buttons">
                                <button class="update-btn">Update</button>
                                <button class="delete-btn" data-id="${recipe.id}" data-image="${recipe.imageURL}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#recipes-${recipe.recipeCategory}" class="close-popup"></a>
            </div>
        </div>
    `;
}