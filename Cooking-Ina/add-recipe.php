<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/add-recipe.css">
</head>

<body id="bodyNig" class="justify-content-center align-items-center">
    <div class="container">
        <h1 class="text-center" id="titleNig">Add Recipe</h1>
        <div id="addRecipeForm">
            <div class="form-group">
                <label for="recipeName">Recipe Name:</label>
                <input type="text" class="form-control" id="recipeName" name="recipeName" required>
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
                            <input type="text" class="form-control directionInput" name="directions[]"
                                placeholder="Step 1" required>
                        </div>
                    </li>
                </ol>
                <button type="button" class="btn btn-danger" id="addDirection">Add Direction</button>
            </div>
            <button type="button" id="submitRecipe" class="btn btn-primary">Submit Recipe</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="assets/add-recipe.js"></script>
</body>

</html>