<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/cropperjs/dist/cropper.css">
    <link rel="stylesheet" href="assets/add-update-recipe.css">
    <script type="module" src="assets/add-recipe.js" defer></script>

</head>

<body id="bodyNig" class="justify-content-center align-items-center">
    <div class="loader">
    </div>
    <div id="userInfo">
        <p>Welcome, <span id="displayName"></span>!</p>
    </div>
    <div class="container">
        <h1 class="text-center" id="titleNig">Add Recipe</h1>

        <!-- Add Picture Feature -->
        <div class="form-group">
            <label for="recipeImage">Add Picture:</label>
            <input type="file" class="form-control-file" id="recipeImage">
            <!-- Modal -->
            <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img id="imagePreview" src="#" alt="Preview" style="max-width: 100%;">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="cropImage">Crop Image</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Div for displaying cropped image -->
        <div id="croppedImageContainer"></div>


        <div id="addRecipeForm">
            <div class="form-group">
                <label for="recipeName">Recipe Name:</label>
                <input type="text" class="form-control" id="recipeName" name="recipeName" placeholder="Recipe Name"
                    required>
            </div>

            <!-- Category Dropdown -->
            <div class="form-group">
                <label for="recipeCategory">Category:</label>
                <select class="form-control" id="recipeCategory">
                    <option value="" disabled selected>Select Category</option>
                    <option value="Main Dish">Main Dish</option>
                    <option value="Appetizer">Appetizer</option>
                    <option value="Dessert">Dessert</option>
                    <option value="Beverage">Beverage</option>
                </select>
            </div>

            <div class="form-group">
                <label for="recipeDescription">Short Description:</label>
                <textarea class="form-control" id="recipeDescription" name="recipeDescription" rows="3"
                    placeholder="Enter a short description"></textarea>
            </div>

            <div class="form-group">
                <h2>Ingredients:</h2>
                <table id="ingredientTable" class="table">
                    <thead>
                        <tr>
                            <th>Ingredient Name</th>
                            <th>Quantity</th>
                            <th></th> <!-- Empty header for remove button column -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="ingredientInput">
                            <td><input type="text" class="form-control" name="ingredientName[]"
                                    placeholder="Ingredient Name" required></td>
                            <td><input type="text" class="form-control" name="ingredientQuantity[]"
                                    placeholder="Quantity" required></td>
                            <td></td> <!-- Placeholder column for remove button -->
                        </tr>
                    </tbody>
                </table>
                <button type="button" id="addIngredient" class="btn btn-primary">Add Ingredient</button>
            </div>

            <div class="form-group">
                <h2>Directions:</h2>
                <ol id="directionsList">
                    <li>
                        <div class="direction-item input-group">
                            <input id="directInput" type="text" class="form-control directionInput" name="directions[]"
                                placeholder="Step 1" required>
                        </div>
                    </li>
                </ol>
                <button type="button" class="btn btn-danger" id="addDirection">Add Direction</button>
            </div>
            <button type="button" id="submitRecipe" class="btn btn-primary">Submit Recipe</button>
            <a href="javascript:history.back()" class="btn btn-secondary ml-2">Back</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://unpkg.com/cropperjs/dist/cropper.js"></script>
    <script>
        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            if (loader) { // Check if loader element exists
                loader.classList.add("loader--hidden");

                loader.addEventListener("transitionend", () => {
                    // Delay the removal of the loader by a short interval
                    setTimeout(() => {
                        if (loader.parentNode) { // Check if loader has a parent node
                            loader.parentNode.removeChild(loader);
                        }
                    }, 500); // Adjust the delay time as needed
                });
            }
        });
    </script>
    <script type="text/javascript">


</body >

</html >