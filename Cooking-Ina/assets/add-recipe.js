document.addEventListener('DOMContentLoaded', function () {
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

    document.getElementById('submitRecipe').addEventListener('click', function () {
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

        if (!hasError) {
            // Send recipeData to your server to save the recipe in your database
            // You can use fetch() or another method to send the data
            // Example: fetch('/api/add-recipe', { method: 'POST', body: JSON.stringify(recipeData) })

            // Here's a mock example of using SweetAlert2 for success message
            Swal.fire({
                icon: 'success',
                title: 'Recipe Submitted!',
                text: 'Your recipe has been successfully submitted.',
            });
        }
    });
});
