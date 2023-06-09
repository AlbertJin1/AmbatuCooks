<?php

@include 'config.php';

session_start();

// IF USER IS NOT LOGGED IN IT WILL REDIRECT BACK TO LOGIN FORM
if(!isset($_SESSION['usermail'])){
    header('location:login_form.php');
}

// TO DISPLAY USER'S NAME
$email = $_SESSION['usermail'];
$select = "SELECT firstName, lastName FROM user_form WHERE email = '$email'";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$firstName = $row['firstName'];
$lastName = $row['lastName'];

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- AFTER LOG OUT NO CACHED DATA WOULD BE SAVED -->
    <meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="expires" content="0">

    <!-- AUTO LOGOUT AFTER INACTIVITY 2MINS -->
    <meta http-equiv="refresh" content="120; url=./logout.php">

    <link rel="icon" href="./img/ICON/ambatuicon.png" type="image/x-icon">

    <!-- STYLESHEETS LOCAL MEOW -->
    <link rel="stylesheet" href="./assets/style-recipe-list.css">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>

    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.4.0/css/lightgallery.min.css"/>

    <title>Courses - Ambatu Cooks</title>

</head>

<body>

    <div class="loader">
        <!-- <video autoplay muted loop>
            <source src="./vid/background-load.mp4" type="video/mp4">
        </video> -->
        <!-- <h1>Loading...</h1> -->
        <img src="./img/loader/loading-loader.gif" alt="loader gif">
    </div>

    <div id="progress">
        <span id="progress-value">▲</span>
    </div>

    <audio id="bg-ambatu" autoplay>
        <source src="./music/ogg/AMBATUKAM.ogg">
    </audio>
    
    <div id="music">
        <audio id="bg-music" volume="0.5" autoplay loop>
            <source src="./music/ogg/signal flags (from up on poppy hill lofi).ogg" type="audio/ogg">
        </audio>
    </div>

    <header>
        
        <!-- PRENAV FIRST -->
        <div id="prenav-text">
            <div class="flex-row">
                <div class="contact-info">
                    <!-- Phone no: <span>+63 997 267 1584</span> or email us: <span>ambatucooks@gmail.com</span> -->
                    User: <span><?php echo $firstName . ' ' . $lastName; ?></span>
                </div>
                <div class="opening-times flex-row">
                    <ul class="social-links flex-row">
                        <li><a href="https://facebook.com/ambatucooks69" target="_blank"><i class="bx bxl-facebook"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="bx bxl-instagram"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="bx bxl-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="bx bxl-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- PRENAV END -->




        <!-- NAVBAR START -->

        <nav id="navbar" class="navbar flex-row">

            <div class="nav-icon menu-btn-wrapper">
                <div id="menu-btn" class="menu-btn bx bx-menu"></div>
            </div>

            <div class="logo">
                <h5>
                    <img href ="index.php" src="./img/Logo/AMBATU.png" alt="">
                </h5>
            </div>

            <ul id="nav-items" class="nav-items">
                <li><a href="index.php#home" class="nav-links">HOME</a></li>
                <li><a href="index.php#about" class="nav-links">ABOUT</a></li>
                <li><a href="recipes.php" class="nav-links">MAIN MENU</a></li>
                <li><a href="#recipes-main" class="nav-links">MAIN DISH</a></li>
                <li><a href="#recipes-appe" class="nav-links">APPETIZER</a></li>
                <li><a href="#recipes-dessert" class="nav-links">DESSERT</a></li>
                <li><a href="#recipes-beve" class="nav-links">BEVERAGE</a></li>
                <li><a href="recipe-app.php" target="_blank" class="nav-links">APP</a></li>
                <li><a href="index.php#reviews" class="nav-links">REVIEWS</a></li>
                <li><a href="index.php#gallery" class="nav-links">GALLERY</a></li>
                <li><a href="recipes.php#blogs" class="nav-links">SPECIALS</a></li>
                <li><a href="#footer" class="nav-links">CONTACT</a></li>
                <li><a href="logout.php" class="nav-links">LOGOUT</a></li>
            </ul>

            <ul class="nav-btns">

                <div class="nav-icon">
                    <i class="darkbtn bx bx-moon"></i>
                </div>

            </ul>

        </nav>

        <!-- NAVBAR END -->
        
    </header>

    <!-- <section class="space"></section> -->

    <section class="video">
        <h2>Cooking is like love</h2>
        <h1>it should be entered into with abandon or not at all</h1>
        <div class="video-wrapper">
            <video autoplay loop muted>
                <source src="./vid/1-cooking-anime.mp4">
            </video>
            
            <div class="video-gradient-overlay"></div>
        </div>
    </section>

    <!-- #RECIPE MENU -->

    <section id="recipes-main">

        <div class="section-heading">
            <h3>Main Dish</h3>
            <h1>Hearty Main Course Recipes That Will Satisfy Your Hunger</h1>
            <div class="square-wrapper flex-row">
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
            </div>
        </div>
        <div class="toggle-button-container">
            <button class="toggle-button-main">Show More</button>
        </div>

        <div class="menu">
            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/1-Miso-Ramen.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Miso Ramen</h2>
                    </div>
                    <p>Flavored with pork and chicken broth with a mix of toppings such as chashu and ramen egg, this bowl of Miso Ramen is going to satisfy your craving. You can make delicious ramen with authentic broth in less than 30 minutes!</p>
                    <a href="#popup1-main" class="btn">View Recipe</a>
                    <div id="popup1-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Miso Ramen Recipe 味噌ラーメン</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> For the Ramen Soup </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Garlic </td>
                                        <td> 2 cloves </td>
                                    </tr>
                    
                                    <tr>
                                        <td> ginger </td>
                                        <td> 1 knob </td>
                                    </tr>
                    
                                    <tr>
                                        <td> toasted white sesame seeds</td>
                                        <td> 1 Tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> roasted sesame oil </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> ground pork </td>
                                        <td> 1 lb </td>
                                    </tr>
                    
                                    <tr>
                                        <td> doubanjiang (spicy chili bean sauce/broad bean paste) </td>
                                        <td> 2 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> miso </td>
                                        <td> 3 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> sugar </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> sake </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken Stock/Broth </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> kosher salt </td>
                                        <td> 6 cloves </td>
                                    </tr>
                    
                                    <tr>
                                        <td> white pepper powder </td>
                                        <td> ¼ tsp </td>
                                    </tr>
                                </table>
                                <table>
                                    <tr> 
                                        <th> For the Ramen and Optional Toppings </th>
                                    </tr>
                    
                                    <tr>
                                        <td> 2 servings of fresh ramen noodles (10-12 oz) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Spicy Bean Sprout Salad (or blanched bean sprouts) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Ramen Egg (Ajitsuke Tamago) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> frozen or canned corn (drained)</td>
                                    </tr>
                    
                                    <tr>
                                        <td> nori (dried laver seaweed) (cut a sheet into quarters) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> green onion/scallion (chopped)</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shiraga Negi (julienned long green onions) </td>
                                    </tr>
                    
                                </table>
                                <table>
                                    <tr> 
                                        <th> For the Table (Optional) </th>
                                    </tr>
                    
                                    <tr>
                                        <td> la-yu (Japanese chili oil) (store bought or make my Homemade La-yu) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> pickled red ginger (beni shoga or kizami beni shoga) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> white pepper powder </td>
                                    </tr>
                    
                                </table>
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                <h2>To Prepare the Ramen Soup</h2>
                                <ol>
                                    <li>Mince the garlic and ginger.</li>
                                    <li>Mince the shallot. Set these three prepared ingredients aside.</li>
                                    <li>Grind the sesame seeds, leaving some seeds unground for texture.</li>
                                    <li>In a medium pot, heat the sesame oil over medium-low heat and add the minced garlic, ginger, and shallot.</li>
                                    <li>With a wooden spatula, stir fry until fragrant.</li>
                                    <li>Add the meat and increase heat to medium. Cook the meat until no longer pink.</li>
                                    <li>Add the spicy bean paste (la doubanjiang) or non-spicy bean paste (doubanjiang) and miso. Quickly blend well with the meat before they get burnt.</li>
                                    <li>Add the ground sesame seeds and sugar and mix well.</li>
                                    <li>Add the sake and chicken stock and bring the mixture to a simmer.</li>
                                    <li>Taste your soup and add salt (if necessary) and white pepper. Each brand of chicken stock varies in saltiness, so you will have to taste your soup to decide how much salt to add.</li>
                                    <li>Cover with the lid and keep the ramen soup simmering while you cook the noodles.</li>
                                </ol>
                                <h2>To Prepare the Toppings and Ramen Noodles</h2>
                                <ol>
                                    <li>Bring a large pot of unsalted water to a boil (ramen noodles already include salt in the dough). When the water is boiling, ladle some hot water into the serving bowls to warm them up. Meanwhile, gently shake the fresh noodles with your hand to separate and loosen them up.</li>
                                    <li>Important: Prepare the toppings ahead of time so you can serve the hot ramen immediately. For toppings, I use chashu, ramen egg, blanched bean sprout (or spicy bean sprouts), corn kernels, shiraga negi, chopped green onion, and a sheet of nori. Prepare a small dish of red pickled ginger, a bottle of la-yu (chili oil), and some white pepper powder on the table.</li>
                                    <li>Cook the noodles according to the package instructions. I usually cook the noodles al dente (about 15 seconds less than the suggested cooking time). Before your noodles are done cooking, empty the hot water from the warmed ramen bowls.</li>
                                    <li>When the noodles are done, quickly pick them up with a mesh sieve and shake out the excess water. You don`t want to dilute your soup, so make sure to drain the water well. Serve the noodles into the warmed bowls.</li>
                                    <li>Add the ramen soup and top with the various toppings you`ve prepared.</li>
                                    <li>Place the toppings of your choice on top of the noodles and serve immediately.</li>
                                </ol>
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/homemade-chashu-miso-ramen/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/2-Japanese-Curry.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Japanese Chicken Curry</h2>
                    </div>
                    <p>Delicious Japanese chicken curry recipe for a weeknight dinner! Tender pieces of chicken, carrots, and potatoes cooked in a rich savory curry sauce, this Japanese version of curry is a must-have for your family meal. </p>
                    <a href="#popup2-main" class="btn">View Recipe</a>
                    <div id="popup2-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Japanese Chicken Curry</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken thighs, boneless and skinless </td>
                                        <td> 1 lb (450 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt and freshly ground black pepper </td>
                                        <td> To taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> All-purpose flour</td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Onion, sliced </td>
                                        <td> 1 medium </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Carrot, peeled and sliced </td>
                                        <td> 1 large </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Russet potato, peeled and cubed </td>
                                        <td> 1 large </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Garlic, minced </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Curry powder </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Garam masala </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Tomato paste </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken stock </td>
                                        <td> 2 cups </td>
                                    </tr>
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                                    <tr>
                                        <td> Honey </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                                    <tr>
                                        <td> Bay leaf </td>
                                        <td> 1 </td>
                                    </tr>
                                    <tr>
                                        <td> Japanese short-grain rice </td>
                                        <td> To serve </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                <ol>
                                    <li>Season the chicken thighs with salt and black pepper, and then coat them in flour.</li>
                                    <li>Heat the vegetable oil in a large pot over medium-high heat. Add the chicken thighs and cook until browned on both sides. Remove the chicken from the pot and set it aside.</li>
                                    <li>In the same pot, add the sliced onion, carrot, potato, and garlic. Sauté for about 5 minutes or until the vegetables are slightly softened.</li>
                                    <li>Add the curry powder and garam masala to the pot, and sauté for another minute.</li>
                                    <li>Add the tomato paste, chicken stock, soy sauce, honey, and bay leaf to the pot. Stir to combine.</li>
                                    <li>Return the chicken to the pot and bring the mixture to a boil. Reduce the heat to low, cover the pot, and simmer for about 30 minutes or until the vegetables are tender and the chicken is cooked through.</li>
                                    <li>Serve the Japanese chicken curry over a bed of cooked Japanese short-grain rice.</li>
                                </ol>
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/simple-chicken-curry/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/3-Tonkatsu.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Tonkatsu (Japanese Pork Cutlet)</h2>
                    </div>
                    <p>Tonkatsu (Japanese Pork Cutlet) is one of the simplest meals you can make at home. Every bite is perfectly crunchy on the outside and juicy on the inside with the added flavor from Tonkatsu Sauce!</p>
                    <a href="#popup3-main" class="btn">View Recipe</a>
                    <div id="popup3-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Tonkatsu (Japanese Pork Cutlet)</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Boneless pork loin chops </td>
                                        <td> 4 (6 oz / 170 g each) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt and freshly ground black pepper </td>
                                        <td> To taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> All-purpose flour</td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Eggs, beaten </td>
                                        <td> 2 large </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Panko (Japanese breadcrumbs) </td>
                                        <td> 2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> For deep frying </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Tonkatsu sauce </td>
                                        <td> For serving </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, thinly sliced </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon wedges </td>
                                        <td> For serving </td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                <ol>
                                    <li>Season the pork loin chops with salt and black pepper on both sides.</li>
                                    <li>Place the flour, beaten eggs, and panko in three separate shallow dishes.</li>
                                    <li>Coat each pork loin chop in the flour, shaking off any excess. Dip the pork in the beaten eggs, and then coat it in the panko, pressing the breadcrumbs into the pork to help them adhere.</li>
                                    <li>Heat the vegetable oil in a large pot or deep fryer to 350°F (180°C). Add the pork chops one at a time, and fry until golden brown and cooked through, about 5-6 minutes.</li>
                                    <li>Remove the pork chops from the oil with a slotted spoon, and drain them on a wire rack or paper towel.</li>
                                    <li>Slice the tonkatsu into ½ inch (1.3 cm) strips and serve with tonkatsu sauce, sliced green onion, and lemon wedges on the side.</li>
                                </ol>
                    
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/tonkatsu/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/4-Oyakodon.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Oyakodon</h2>
                    </div>
                    <p>Oyakodon is a classic comfort food of Japanese home cooking. Tender pieces of chicken, onions, and eggs are simmered in an umami-rich sauce and then poured over a bowl of fluffy steamed rice.</p>
                    <a href="#popup4-main" class="btn">View Recipe</a>
                    <div id="popup4-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Oyakodon</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken thighs, boneless and skinless </td>
                                        <td> 2 (12 oz / 340 g total) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Onion, sliced </td>
                                        <td> 1 medium </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi stock</td>
                                        <td> 1 1/2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 3 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin </td>
                                        <td> 3 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td> 2 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Eggs, beaten </td>
                                        <td> 4 large </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Steamed Japanese short-grain rice </td>
                                        <td> 4 servings </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, thinly sliced </td>
                                        <td> For garnish</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shichimi togarashi (Japanese seven spice) </td>
                                        <td> For garnish</td>
                                    </tr>
                    
                                </table>
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                <ol>
                                    <li>Cut the chicken thighs into bite-sized pieces.</li>
                                    <li>In a large pan, heat the dashi stock, soy sauce, mirin, and sugar over medium heat. Add the sliced onion and chicken to the pan, and bring the mixture to a boil.</li>
                                    <li>Reduce the heat to low, and let the chicken and onion simmer for about 10 minutes or until the chicken is cooked through.</li>
                                    <li>Pour the beaten eggs over the chicken and onion, and cover the pan. Cook until the eggs are set, about 2-3 minutes.</li>
                                    <li>Divide the steamed rice into four bowls, and spoon the oyakodon over the rice.</li>
                                    <li>Garnish with sliced green onion and shichimi togarashi, and serve hot.</li>
                                </ol>
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/oyakodon/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/5-Okonomiyaki.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Okonomiyaki</h2>
                    </div>
                    <p>Popular street food from Osaka, Japan, Okonomiyaki is a savory version of Japanese pancake, made with flour, eggs, shredded cabbage, and your choice of protein, and topped with a variety of condiments.</p>
                    <a href="#popup5-main" class="btn">View Recipe</a>
                    <div id="popup5-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Okonomiyaki</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> All-purpose flour </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td>Baking powder </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt</td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi powder </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 3/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Eggs, beaten </td>
                                        <td> 2 large </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cabbage, shredded</td>
                                        <td> 4 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, chopped </td>
                                        <td> 2 stalks </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Tenkasu (tempura crumbs) </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Beni shoga (pickled red ginger) </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Thinly sliced pork belly or bacon </td>
                                        <td> 8-12 slices</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> For cooking </td>
                                    </tr>
                                    <tr>
                                        <td> Okonomiyaki sauce </td>
                                        <td> For serving </td>
                                    </tr>
                                    <tr>
                                        <td> Japanese mayonnaise </td>
                                        <td> For serving </td>
                                    </tr>
                                    <tr>
                                        <td> Aonori (dried green seaweed flakes) </td>
                                        <td> For garnish </td>
                                    </tr>
                                    <tr>
                                        <td> Katsuobushi (dried bonito flakes) </td>
                                        <td> For garnish </td>
                                    </tr>
                                </table>
                    
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large mixing bowl, whisk together the all-purpose flour, baking powder, salt, and dashi powder.</li>
                                    <li>Gradually add the water to the dry ingredients, stirring to form a smooth batter. Add the beaten eggs to the batter, and mix well.</li>
                                    <li>Add the shredded cabbage, chopped green onion, tenkasu, and beni shoga to the batter, and mix well to combine.</li>
                                    <li>Heat a large non-stick pan or griddle over medium heat, and add a small amount of vegetable oil.</li>
                                    <li>Pour 1/4 of the batter into the pan, and spread it into a circular shape about 6-8 inches (15-20 cm) in diameter.</li>
                                    <li>Place 2-3 slices of thinly sliced pork belly or bacon on top of the batter, and press them into the batter slightly.</li>
                                    <li>Cook the okonomiyaki for 3-4 minutes on each side or until golden brown and crispy.</li>
                                    <li>Drizzle okonomiyaki sauce and Japanese mayonnaise over the top of the okonomiyaki, and sprinkle aonori and katsuobushi on top as desired.</li>
                                    <li>Repeat steps 5-8 with the remaining batter and pork belly/bacon slices.</li>
                                    <li>Cut the okonomiyaki into wedges, and serve hot.</li>
                                </ol>
                    
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/okonomiyaki/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/6-Teriyaki Salmon.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Teriyaki Salmon</h2>
                    </div>
                    <p>Use this quick and easy Teriyaki Salmon recipe to make a light and savory meal any night of the week. Salmon fillets are pan-grilled to tender perfection in the traditional method and finished with an authentic homemade teriyaki sauce.</p>
                    <a href="#popup6-main" class="btn">View Recipe</a>
                    <div id="popup6-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Teriyaki Salmon </h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Salmon fillets </td>
                                        <td>4 (6 oz / 170 g each) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Black pepper</td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cornstarch </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sake </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, thinly sliced </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Season the salmon fillets with salt and black pepper, and dust them with cornstarch.</li>
                                    <li>Heat a large non-stick pan over medium-high heat, and add the vegetable oil.</li>
                                    <li>Add the salmon fillets to the pan, skin side down, and cook for about 3-4 minutes or until the skin is crispy and golden brown.</li>
                                    <li>Flip the salmon fillets over, and cook for another 2-3 minutes or until the flesh is just cooked through.</li>
                                    <li>Remove the salmon fillets from the pan and set them aside.</li>
                                    <li>In a small saucepan, whisk together the soy sauce, mirin, sake, and granulated sugar over medium heat.</li>
                                    <li>Bring the sauce to a boil, and cook for about 2-3 minutes or until the sauce has thickened and reduced slightly.</li>
                                    <li>Pour the teriyaki sauce over the salmon fillets, and garnish with thinly sliced green onion.</li>
                                    <li>Serve hot with steamed rice and your favorite vegetables.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/teriyaki-salmon-recipe/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/7-Tamago Sando.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Japanese Egg Sandwich</h2>
                    </div>
                    <p>Egg salad tucked between slices of white bread, Japanese Egg Sandwich (Tamago Sando) is a timeless snack you can find in every convenience store in Japan. The filling is creamy and bursting with a rich egg-yolk flavor, and the bread is soft and pillowy.</p>
                    <a href="#popup7-main" class="btn">View Recipe</a>
                    <div id="popup7-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Japanese Egg Sandwich</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Large eggs </td>
                                        <td> 	4 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mayonnaise </td>
                                        <td> 3-4 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Milk</td>
                                        <td> 1 Tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Black pepper </td>
                                        <td> A pinch </td>
                                    </tr>
                    
                                    <tr>
                                        <td> White bread slices </td>
                                        <td> 8 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Butter </td>
                                        <td> For spreading </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>

                                <ol>
                                    <li>In a medium mixing bowl, whisk together the large eggs, mayonnaise, milk, salt, and black pepper until the mixture is smooth and well combined.</li>
                                    <li>Heat a non-stick pan over medium heat, and add a small amount of butter.</li>
                                    <li>Pour the egg mixture into the pan, and cook it, stirring frequently, for about 2-3 minutes or until the eggs are scrambled and cooked through.</li>
                                    <li>Remove the scrambled eggs from the pan and set them aside to cool.</li>
                                    <li>Toast the white bread slices until they are golden brown and crispy.</li>
                                    <li>Spread butter on one side of each bread slice.</li>
                                    <li>Spoon a generous amount of the scrambled eggs onto one buttered bread slice.</li>
                                    <li>Top the scrambled eggs with another buttered bread slice.</li>
                                    <li>Cut off the crusts of the sandwich, and slice it into two equal parts.</li>
                                    <li>Repeat steps 7-9 with the remaining bread slices and scrambled eggs.</li>
                                    <li>Wrap the sandwiches tightly with plastic wrap, and chill them in the refrigerator for at least 30 minutes or until ready to serve.</li>
                                    <li>Cut the chilled sandwiches into smaller bite-sized pieces, and serve them as a light breakfast or snack.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/japanese-egg-sandwich-tamago-sando/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/8-Tantanmen.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Tantanmen</h2>
                    </div>
                    <p>Tan Tan Ramen (Tantanmen) is a rich and flavorful Japanese ramen noodle soup adapted from the famous Chinese Sichuan dan dan mian. It`s unique for both its savory topping and the spicy yet creamy soup broth. This hot bowl of ramen is too good to be missed!</p>
                    <a href="#popup8-main" class="btn">View Recipe</a>
                    <div id="popup8-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Tantanmen</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Ground pork </td>
                                        <td> 8 oz (225 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Garlic, minced </td>
                                        <td> 1 clove</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Ginger, grated</td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sake </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Doubanjiang (spicy bean paste) </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Chinese sesame paste or tahini </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken stock </td>
                                        <td> 3 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy milk </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Chili oil </td>
                                        <td> 2-3 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> To taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> White pepper </td>
                                        <td> To taste </td>
                                    </tr>
                                    <tr>
                                        <td> Ramen noodles </td>
                                        <td> 4 servings  </td>
                                    </tr>
                                    <tr>
                                        <td> Green onions, thinly sliced </td>
                                        <td>For garnish</td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large pot, bring the chicken stock to a boil, and add the ground pork, garlic, ginger, soy sauce, and sake.</li>
                                    <li>Cook the pork mixture over medium-high heat, breaking up the meat with a wooden spoon, for about 5-7 minutes or until the pork is browned and cooked through.</li>
                                    <li>Add the doubanjiang and sesame paste to the pot, and stir to combine.</li>
                                    <li>Pour in the soy milk and chili oil, and stir the mixture until it is well blended.</li>
                                    <li>Season the soup with salt and white pepper to taste.</li>
                                    <li>Reduce the heat to low, and let the soup simmer for about 10-15 minutes to allow the flavors to meld together.</li>
                                    <li>Cook the ramen noodles according to the package instructions, and drain them well.</li>
                                    <li>Divide the cooked noodles among 4 bowls, and ladle the hot soup over the noodles.</li>
                                    <li>Garnish each bowl with thinly sliced green onions.</li>
                                    <li>Serve the Tantanmen hot, and enjoy!</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/tantanmen/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/9-Tamagotoji.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Tamagotoji</h2>
                    </div>
                    <p>In this comforting Japanese Simmered Egg and Yuba Tofu Skin (Tamagotoji), we gently cook the ingredients in a savory dashi broth and bind them together with lightly beaten eggs. The delicate, nutty soy milk skin pairs beautifully with soft-cooked fluffy eggs.</p>
                    <a href="#popup9-main" class="btn">View Recipe</a>
                    <div id="popup9-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Tamagotoji</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Large eggs </td>
                                        <td> 	3 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi stock </td>
                                        <td> 1 1/2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce</td>
                                        <td> 1 1/2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td>Mirin</td>
                                        <td> 1 1/2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td> 1/2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> a pinch </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, thinly sliced </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a small bowl, whisk together the large eggs until they are well beaten.</li>
                                    <li>In a separate medium pot, combine the dashi stock, soy sauce, mirin, sugar, and salt, and bring the mixture to a simmer over medium heat.</li>
                                    <li>Slowly pour the beaten eggs into the pot, stirring gently with a chopstick or fork in a circular motion for about 1-2 minutes, until the eggs are cooked and just set.</li>
                                    <li>Slowly pour the beaten eggs into the pot, stirring gently with a chopstick or fork in a circular motion for about 1-2 minutes, until the eggs are cooked and just set.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/yuba-tamagotoji/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/1-MAIN DISH/10-Nabeyaki Udon.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Nabeyaki Udon</h2>
                    </div>
                    <p>Served in an individual donabe clay pot, Nabeyaki Udon is a wintertime staple in Japan. In this recipe, thick chewy udon noodles are cooked in a flavorful dashi broth along with kamaboko fish cake, deep-fried tofu pouch, scallions, and an egg. Top it up with crispy shrimp tempura to make it extra fancy or keep it simple with what you have in the fridge.</p>
                    <a href="#popup10-main" class="btn">View Recipe</a>
                    <div id="popup10-main" class="popup">
                        <a href="#recipes-main" class="close">&times;</a>
                        <h2>Nabeyaki Udon</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Udon noodles </td>
                                        <td> 4 servings </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken breast, cut into small pieces </td>
                                        <td> 8 oz (225 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Carrot, sliced</td>
                                        <td> 1/2 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shiitake mushrooms, stems removed and sliced </td>
                                        <td> 4 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Kamaboko (fish cake), sliced </td>
                                        <td> 2 oz (60 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, thinly sliced </td>
                                        <td> 2 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi stock </td>
                                        <td> 4 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin</td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> to taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Egg, lightly beaten </td>
                                        <td> 1 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shichimi togarashi (Japanese seven spice) </td>
                                        <td> For garnish </td>
                                    </tr>
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large pot, bring the dashi stock to a boil, and add the chicken, carrot, and shiitake mushrooms.</li>
                                    <li>Reduce the heat to medium-low, and let the ingredients simmer for about 5-7 minutes or until the chicken is cooked through and the vegetables are tender.</li>
                                    <li>Add the sliced kamaboko and green onion to the pot, and let them cook for another minute or two.</li>
                                    <li>Stir in the mirin and soy sauce, and season the soup with salt to taste.</li>
                                    <li>Divide the cooked udon noodles among 4 individual bowls.</li>
                                    <li>Pour the hot soup over the noodles, and top each bowl with a lightly beaten egg.</li>
                                    <li>Garnish each bowl with shichimi togarashi, and serve the Nabeyaki Udon hot.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/nabeyaki-udon/#wprm-recipe-container-58632">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-main" class="close-popup"></a>
                </div>
            </div>
        </div>

    </section>
    <!-- #READ MORE LESS END -->

    <!-- QUOTE START -->

    <section id="quote">
        <div class="text-wrapper">
            <h2>From Classic to Creative</h2>
            <h1>Explore Our Collection of Mouth-Watering Recipes</h1>
        </div>
    </section>

    <!-- QUOTE END -->

    <!-- #RECIPE MENU -->

    <section id="recipes-appe">
        <div class="section-heading">
            <h3>Appetizer</h3>
            <h1>Start Your Meal off Right with These Delicious Appetizer Recipes</h1>
            <div class="square-wrapper flex-row">
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
            </div>
        </div>
        <div class="toggle-button-container">
            <button class="toggle-button-appe">Show More</button>
        </div>

        <div class="menu">
            
            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/1-Chawanmushi.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Chawanmushi</h2>
                    </div>
                    <p>Chawanmushi is a classic Japanese savory custard that`s steamed and served in a delicate cup. Tender chicken pieces, colorful kamaboko fish cake, and shimeji mushrooms are draped in a smooth and silky custard seasoned with dashi soup stock.</p>
                    <a href="#popup1-appe" class="btn">View Recipe</a>
                    <div id="popup1-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Chawanmushi</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Large Eggs </td>
                                        <td> 2</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi stock </td>
                                        <td> 1 1/2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce</td>
                                        <td> 2 tsp</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin</td>
                                        <td> 2 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt</td>
                                        <td>A pinch </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shrimp, cooked and shelled </td>
                                        <td> 4 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Kamaboko (fish cake), sliced </td>
                                        <td> 2 oz (60 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shimeji mushrooms, separated </td>
                                        <td> 1.5 oz (40 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mitsuba (Japanese parsley) or green onion, thinly sliced </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a small bowl, whisk together the large eggs until they are well beaten.</li>
                                    <li>In a separate medium pot, combine the dashi stock, soy sauce, mirin, and salt, and bring the mixture to a simmer over medium heat.</li>
                                    <li>Place a steaming basket or sieve over the pot, and pour the beaten eggs into the basket.</li>
                                    <li>Top the eggs with the cooked shrimp, sliced kamaboko, and separated shimeji mushrooms.</li>
                                    <li>Cover the pot with a lid, and let the chawanmushi steam for about 10-12 minutes or until the eggs are cooked through.</li>
                                    <li>Garnish the chawanmushi with thinly sliced mitsuba or green onion, and serve it hot.</li>
                                </ol>
                               
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/chawanmushi-savory-steamed-egg-custard/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/2-Blistered Shishito Peppers.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Blistered Shishito Peppers</h2>
                    </div>
                    <p>Smoky, fun, and super addicting, these blistered shishito peppers make the best appetizer to serve with your summer dishes! Roast these Japanese peppers in a dry skillet until deliciously charred and flavor them with a simple ginger soy sauce.</p>
                    <a href="#popup2-appe" class="btn">View Recipe</a>
                    <div id="popup2-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Blistered Shishito Peppers</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Shishito peppers </td>
                                        <td> 8 oz (225 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> 2-3 tbsp</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce</td>
                                        <td> To taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon juice </td>
                                        <td> To taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Bonito flakes (katsuobushi) </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Rinse the shishito peppers under cold water, and pat them dry with a paper towel.</li>
                                    <li>Heat the vegetable oil in a large skillet over high heat until it is hot but not smoking.</li>
                                    <li>Add the shishito peppers to the skillet, and cook them for about 2-3 minutes or until they are blistered and lightly charred on all sides.</li>
                                    <li>Remove the skillet from the heat, and season the peppers with soy sauce and lemon juice to taste.</li>
                                    <li>Transfer the shishito peppers to a serving plate, and garnish them with bonito flakes.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/blistered-shishito-peppers/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/3-Agedashi Tofu.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Agedashi Tofu</h2>
                    </div>
                    <p>Crispy deep-fried tofu served in a flavorful umami sauce, Agedashi Tofu is a popular appetizer you can find at izakaya and Japanese restaurants. It requires deep-frying, but the process is easier than you think.</p>
                    <a href="#popup3-appe" class="btn">View Recipe</a>
                    <div id="popup3-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Agedashi Tofu</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Firm tofu </td>
                                        <td> 14 oz (400 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Potato starch </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil</td>
                                        <td> For frying </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi stock </td>
                                        <td> 1 cup</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Grated daikon radish </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shichimi togarashi (Japanese seven spice) </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Green onion, thinly sliced </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                               
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Drain the firm tofu, and cut it into 1-inch cubes.</li>
                                    <li>Place the potato starch in a shallow dish, and coat the tofu cubes evenly with the starch.</li>
                                    <li>Heat the vegetable oil in a deep pot or wok over high heat until it is hot but not smoking.</li>
                                    <li>Fry the coated tofu cubes in the hot oil for about 2-3 minutes or until they are golden brown and crispy.</li>
                                    <li>Remove the fried tofu cubes from the pot, and drain them on a paper towel.</li>
                                    <li>In a separate pot, combine the dashi stock, soy sauce, and mirin, and bring the mixture to a boil over medium heat.</li>
                                    <li>Place the fried tofu cubes into a serving bowl, and pour the hot broth over the top.</li>
                                    <li>Garnish the agedashi tofu with grated daikon radish, shichimi togarashi, and thinly sliced green onion.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/agedashi-tofu-2/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/4-Datemaki.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Datemaki</h2>
                    </div>
                    <p>Baked in the oven and rolled into a cylinder, Datemaki or Sweet Rolled Omelette is a must-have dish for your Japanese Osechi Ryori menu on New Year`s Day. Similar to tamagoyaki, this delicious omelette is tender and moist on the inside but with a golden brown exterior and sunny decorative shape.</p>
                    <a href="#popup4-appe" class="btn">View Recipe</a>
                    <div id="popup4-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Datemaki</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Eggs </td>
                                        <td> 4 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce</td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Dashi stock </td>
                                        <td>1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Potato starch </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td>1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Toasted nori seaweed, cut into thin strips </td>
                                        <td>For garnish </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Shredded tamagoyaki (Japanese omelet) </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large bowl, whisk together the eggs, sugar, soy sauce, mirin, and dashi stock until they are well combined.</li>
                                    <li>Pour the egg mixture through a fine-mesh sieve into a separate bowl to remove any lumps.</li>
                                    <li>Line a rectangular baking dish with parchment paper, and pour the egg mixture into the dish.</li>
                                    <li>Preheat the oven to 350°F (180°C), and place the baking dish into the oven.</li>
                                    <li>Bake the datemaki for about 25-30 minutes or until the egg is cooked through.</li>
                                    <li>In a separate small bowl, mix together the potato starch and water until they are well combined.</li>
                                    <li>Remove the datemaki from the oven, and brush the potato starch mixture over the top.</li>
                                    <li>Return the datemaki to the oven, and bake it for an additional 5-10 minutes or until the potato starch glaze is golden brown and crispy.</li>
                                    <li>Remove the datemaki from the oven, and let it cool for a few minutes.</li>
                                    <li>Cut the datemaki into slices, and garnish it with toasted nori seaweed and shredded tamagoyaki.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/datemaki-sweet-rolled-omelette/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/5-Butter Soy Sauce Scallops.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Butter Soy Sauce Scallops</h2>
                    </div>
                    <p>Pan-fried to perfection, these quick Butter Soy Sauce Scallops are sweet, juicy, and oh-so addicting!</p>
                    <a href="#popup5-appe" class="btn">View Recipe</a>
                    <div id="popup5-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Butter Soy Sauce Scallops</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Scallops </td>
                                        <td> 12-14 pieces </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter </td>
                                        <td> 2 tbsp</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce</td>
                                        <td> 1 Tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sake </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> sugar </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Black pepper, freshly ground </td>
                                        <td> To taste </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon wedges </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Rinse the scallops, and pat them dry with a paper towel.</li>
                                    <li>Melt the unsalted butter in a large frying pan over medium-high heat.</li>
                                    <li>Add the scallops to the pan, and cook them for about 1-2 minutes per side or until they are golden brown.</li>
                                    <li>Remove the cooked scallops from the pan, and set them aside.</li>
                                    <li>In the same pan, add the soy sauce, sake, sugar, and black pepper, and cook the mixture for about 1-2 minutes or until it is slightly thickened.</li>
                                    <li>Return the cooked scallops to the pan, and toss them with the sauce until they are evenly coated.</li>
                                    <li>Serve the scallops immediately with lemon wedges on the side.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/butter-soy-sauce-scallops/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/6-Tazukuri.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Tazukuri</h2>
                    </div>
                    <p>Toasted anchovies and sesame seeds coated in a honey-soy sauce glaze, Tazukuri is a sweet and savory snack commonly served as part of Osechi Ryori (traditional Japanese New Year foods).</p>
                    <a href="#popup6-appe" class="btn">View Recipe</a>
                    <div id="popup6-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Tazukuri</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Dried baby sardines (niboshi)</td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin</td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> For frying </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Rinse the dried baby sardines in cold water, and drain them well.</li>
                                    <li>In a small bowl, mix together the soy sauce, mirin, and sugar until the sugar is dissolved.</li>
                                    <li>Heat the vegetable oil in a frying pan over medium heat.</li>
                                    <li>Add the dried baby sardines to the pan, and fry them for about 2-3 minutes or until they are crispy and golden brown.</li>
                                    <li>Remove the fried sardines from the pan, and drain them on a paper towel.</li>
                                    <li>In a separate pan, heat the soy sauce mixture over medium heat until it is slightly thickened.</li>
                                    <li>Add the fried sardines to the pan, and toss them with the sauce until they are evenly coated.</li>
                                    <li>Remove the tazukuri from the heat, and let it cool for a few minutes.</li>
                                    <li>Serve the tazukuri in small bowls as a snack or appetizer.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/tazukuri-candied-anchovies/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/7-Braised Pork Belly.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Kakuni</h2>
                    </div>
                    <p>Slow cooked pork belly in soy sauce glaze, Kakuni (Japanese Braised Pork Belly) is literally melt-in-your-mouth delicious. So good with rice and egg on the side. </p>
                    <a href="#popup7-appe" class="btn">View Recipe</a>
                    <div id="popup7-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Kakuni</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Pork belly </td>
                                        <td> 1 lb </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sake</td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mirin </td>
                                        <td>  1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td>  1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td>  1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Scallions, thinly sliced </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                               
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Cut the pork belly into large cubes.</li>
                                    <li>In a large pot, bring the soy sauce, sake, mirin, sugar, and water to a boil over high heat.</li>
                                    <li>Add the pork belly to the pot, and bring the mixture to a simmer.</li>
                                    <li>Cover the pot with a lid, and cook the pork belly over low heat for about 2 hours or until it is tender and the liquid has thickened.</li>
                                    <li>Remove the cooked pork belly from the pot, and let it cool for a few minutes.</li>
                                    <li>Slice the pork belly into bite-sized pieces, and garnish with thinly sliced scallions.</li>
                                    <li>Serve the kakuni hot with rice and your favorite vegetable side dish.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/braised-pork-belly-kakuni/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/8-Japanese Sake-Steamed Clams.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Japanese Sake-Steamed Clams</h2>
                    </div>
                    <p>Japanese Sake-Steamed Clams made in 10 minutes with just 5 ingredients! A favorite of izakaya, this seafood fare exudes a fun casual vibe when enjoyed with chilled beer.</p>
                    <a href="#popup8-appe" class="btn">View Recipe</a>
                    <div id="popup8-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Japanese Sake-Steamed Clams</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Manila clams </td>
                                        <td> 2 lbs </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Japanese sake</td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Garlic, minced</td>
                                        <td> 2 cloves </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Butter </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon wedges </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Rinse the Manila clams in cold water, and drain them well.</li>
                                    <li>In a large pot, bring the Japanese sake and minced garlic to a boil over high heat.</li>
                                    <li>Add the Manila clams to the pot, and cover the pot with a lid.</li>
                                    <li>Cook the clams over medium heat for about 5-7 minutes or until they are fully opened.</li>
                                    <li>Using a slotted spoon, remove the cooked clams from the pot, and transfer them to a serving bowl.</li>
                                    <li>In a small saucepan, melt the butter over low heat.</li>
                                    <li>Add the soy sauce to the melted butter, and stir to combine.</li>
                                    <li>Pour the butter and soy sauce mixture over the cooked clams, and toss them gently to coat.</li>
                                    <li>Serve the sake-steamed clams hot with lemon wedges on the side.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/japanese-sake-steamed-clams/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/9-Teba Shio.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Teba Shio</h2>
                    </div>
                    <p>With only 3 ingredients, these Japanese Salted Chicken Wings (Teba Shio) are oven-broiled till juicy and crisp golden perfection. So good and unbelievably easy to make, they will be the wings on repeat for all your parties, game days or lazy Sunday dinners.</p>
                    <a href="#popup9-appe" class="btn">View Recipe</a>
                    <div id="popup9-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Teba Shio</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Chicken wings </td>
                                        <td>20 wings </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sake </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon wedges </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 400°F (200°C).</li>
                                    <li>Rinse the chicken wings under cold water, and pat them dry with paper towels.</li>
                                    <li>In a large bowl, season the chicken wings with salt and sake.</li>
                                    <li>Mix the chicken wings well, and let them marinate for 10-15 minutes.</li>
                                    <li>Line a baking sheet with parchment paper, and brush it with vegetable oil.</li>
                                    <li>Arrange the chicken wings on the baking sheet in a single layer.</li>
                                    <li>Bake the chicken wings for about 40-45 minutes or until they are golden brown and crispy.</li>
                                    <li>Remove the chicken wings from the oven, and let them cool for a few minutes.</li>
                                    <li>Transfer the chicken wings to a serving plate, and garnish with lemon wedges.</li>
                                    <li>Serve the Teba Shio hot with your favorite dipping sauce.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/teba-shio-salted-chicken-wings/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/2-APPETIZER/10-Spicy Edamame.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Spicy Edamame</h2>
                    </div>
                    <p>Snack on these fiery and spicy edamame sautéed with chili paste, garlic, and miso. It`s intensely delicious. You won`t be able to stop eating these!</p>
                    <a href="#popup10-appe" class="btn">View Recipe</a>
                    <div id="popup10-appe" class="popup">
                        <a href="#recipes-appe" class="close">&times;</a>
                        <h2>Spicy Edamame</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Edamame, unshelled </td>
                                        <td> 2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vegetable oil </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Garlic, minced</td>
                                        <td> 2 cloves </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Red pepper flakes </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Soy sauce </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sesame oil </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sesame seeds, toasted </td>
                                        <td> For garnish </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large pot, bring salted water to a boil over high heat.</li>
                                    <li>Add the edamame to the pot, and cook them for about 5-7 minutes or until they are tender.</li>
                                    <li>Drain the edamame, and set them aside.</li>
                                    <li>In a large pan, heat the vegetable oil over medium heat.</li>
                                    <li>Add the minced garlic to the pan, and cook for about 30 seconds or until fragrant.</li>
                                    <li>Add the red pepper flakes to the pan, and cook for another 30 seconds.</li>
                                    <li>Add the cooked edamame to the pan, and toss them to coat with the garlic and red pepper flakes.</li>
                                    <li>Add the soy sauce and sesame oil to the pan, and toss the edamame again to coat.</li>
                                    <li>Cook the edamame for about 1-2 minutes or until they are heated through.</li>
                                    <li>Transfer the spicy edamame to a serving bowl, and garnish with toasted sesame seeds.</li>
                                    <li>Serve the spicy edamame hot as an appetizer or snack.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/spicy-edamame/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-appe" class="close-popup"></a>
                </div>
            </div>
        </div>

    </section>
    <!-- #READ MORE LESS END -->

    <!-- QUOTE START -->

    <section id="quote">
        <div class="text-wrapper">
            <h2>Indulge Your Sweet Tooth with These Decadent Desserts</h2>
            <h1>Perfect for Any Occasion and Guaranteed to Satisfy!</h1>
        </div>
    </section>

    <!-- QUOTE END -->

    <!-- #RECIPE MENU -->

    <section id="recipes-dessert">
        <div class="section-heading">
            <h3>Dessert</h3>
            <h1>Life is uncertain. Eat dessert first.</h1>
            <div class="square-wrapper flex-row">
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
            </div>
        </div>
        <div class="toggle-button-container">
            <button class="toggle-button-dessert">Show More</button>
        </div>

        <div class="menu">
            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/1-Basque Burnt Cheesecake.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Basque Burnt Cheesecake</h2>
                    </div>
                    <p>Creamy on the inside and caramelized on the outside, this Basque Burnt Cheesecake is easier than it looks to make at home. Baked at a high temperature, the cheesecake`s iconic rich dark top is a showstopper! Follow my tips and tricks for a foolproof recipe.</p>
                    <a href="#popup1-dessert" class="btn">View Recipe</a>
                    <div id="popup1-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Basque Burnt Cheesecake</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Cream cheese, room temperature </td>
                                        <td> 16 oz (2 blocks) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> All-purpose flour</td>
                                        <td> 1 Tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Large eggs, room temperature </td>
                                        <td> 4 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Heavy cream </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vanilla extract </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Confectioners' sugar, for dusting </td>
                                        <td> Optional </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 400°F (200°C).</li>
                                    <li>In a large mixing bowl, beat the cream cheese until it is creamy and smooth.</li>
                                    <li>Add the granulated sugar, flour, and salt to the bowl, and beat until the mixture is well combined.</li>
                                    <li>Add the eggs one at a time, and beat well after each addition.</li>
                                    <li>Add the heavy cream and vanilla extract to the bowl, and beat until the mixture is smooth and creamy.</li>
                                    <li>Pour the batter into a 9-inch (23 cm) springform pan that has been lined with parchment paper.</li>
                                    <li>Bake the cheesecake for 50-60 minutes or until the top is golden brown and the center is set.</li>
                                    <li>Remove the cheesecake from the oven, and let it cool to room temperature.</li>
                                    <li>Once cooled, remove the cheesecake from the pan, and dust it with confectioners' sugar if desired.</li>
                                    <li>Slice the Basque Burnt Cheesecake, and serve it chilled or at room temperature.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/basque-burnt-cheesecake/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/2-Matcha Swiss Roll.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Matcha Swiss Roll</h2>
                    </div>
                    <p>Matcha Swiss Roll is a fluffy sponge cake with a swirl of fresh matcha cream rolled in the middle. Light, creamy, and mildly sweet, it`s a delicious afternoon snack or post-dinner dessert that you can enjoy with a cup of coffee or tea.</p>
                    <a href="#popup2-dessert" class="btn">View Recipe</a>
                    <div id="popup2-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Matcha Swiss Roll</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Cake flour </td>
                                        <td> 3/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Matcha powder </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Large eggs </td>
                                        <td> 4 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 3/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Milk </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter, melted </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Whipped cream, for filling </td>
                                        <td> As needed </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Confectioners' sugar, for dusting </td>
                                        <td> As needed </td>
                                    </tr>
                    
                                    
                                </table>
                               
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 350°F (175°C).</li>
                                    <li>Sift the cake flour and matcha powder together, and set them aside.</li>
                                    <li>In a large mixing bowl, beat the eggs until they are light and frothy.</li>
                                    <li>Add the granulated sugar to the bowl gradually, and continue beating until the mixture is thick and pale.</li>
                                    <li>Add the sifted flour and matcha powder to the bowl, and fold gently until the mixture is smooth.</li>
                                    <li>Add the milk and melted butter to the bowl, and fold gently until the mixture is well combined.</li>
                                    <li>Pour the batter into a 10x15-inch (25x38 cm) jelly roll pan that has been lined with parchment paper.</li>
                                    <li>Bake the cake for 12-15 minutes or until the top is golden brown and the cake springs back when lightly touched.</li>
                                    <li>Remove the cake from the oven, and let it cool to room temperature.</li>
                                    <li>Once cooled, dust the cake with confectioners' sugar.</li>
                                    <li>Flip the cake over onto a sheet of parchment paper, and remove the parchment paper that was on the bottom of the cake.</li>
                                    <li>Spread a layer of whipped cream over the cake, leaving a 1-inch (2.5 cm) border around the edges.</li>
                                    <li>Roll the cake up tightly from one end, using the parchment paper to help you.</li>
                                    <li>Chill the Matcha Swiss Roll for at least 30 minutes before slicing and serving.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/matcha-swiss-roll/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/3-Japanese Strawberry Shortcake.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Japanese Strawberry Shortcake</h2>
                    </div>
                    <p>This simple and elegant cake is perfect for celebrating all occasions. Detailed step-by-step picture instructions are included.</p>
                    <a href="#popup3-dessert" class="btn">View Recipe</a>
                    <div id="popup3-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Japanese Strawberry Shortcake</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Cake flour </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Baking powder </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter, room temperature </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Large eggs, room temperature </td>
                                        <td> 2 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Milk </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vanilla extract </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Fresh strawberries, sliced </td>
                                        <td> 1 lb (450 g)</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Whipped cream, for filling and topping </td>
                                        <td> As needed </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 350°F (175°C).</li>
                                    <li>Sift the cake flour, baking powder, and salt together, and set them aside.</li>
                                    <li>In a large mixing bowl, cream the butter and granulated sugar together until they are light and fluffy.</li>
                                    <li>Add the eggs one at a time, and beat well after each addition.</li>
                                    <li>Add the sifted dry ingredients to the bowl in three parts, alternating with the milk, and mix until the batter is smooth and well combined.</li>
                                    <li>Add the vanilla extract to the bowl, and mix until it is well incorporated.</li>
                                    <li>Pour the batter into two 8-inch (20 cm) round cake pans that have been greased and lined with parchment paper.</li>
                                    <li>Bake the cakes for 25-30 minutes or until they are golden brown and a toothpick inserted into the center comes out clean.</li>
                                    <li>Remove the cakes from the oven, and let them cool in the pans for 5 minutes.</li>
                                    <li>Remove the cakes from the pans, and let them cool to room temperature on wire racks.</li>
                                    <li>Once the cakes are cool, spread a layer of whipped cream over one cake, and top with sliced strawberries.</li>
                                    <li>Place the second cake on top of the strawberries, and spread another layer of whipped cream on top.</li>
                                    <li>Decorate the top of the cake with more sliced strawberries and whipped cream as desired.</li>
                                    <li>Chill the Japanese Strawberry Shortcake for at least 30 minutes before slicing and serving.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/japanese-strawberry-shortcake/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/4-Japanese Cheesecake.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Japanese Cheesecake</h2>
                    </div>
                    <p>Light, jiggly, and fluffy, Japanese Cheesecake (Soufflé Cheesecake) is seriously the most delicious treat to serve for a crowd. It has the melt-in-your-mouth combination of creamy cheesecake and airy soufflé.</p>
                    <a href="#popup4-dessert" class="btn">View Recipe</a>
                    <div id="popup4-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Japanese Cheesecake</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Cream cheese, room temperature </td>
                                        <td> 8 oz (225 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter, room temperature </td>
                                        <td> 3 tbsp</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Whole Milk </td>
                                        <td> 1/3 cup (80 ml)</td>
                                    </tr>
                    
                                    <tr>
                                        <td>Granulated sugar</td>
                                        <td> 1/4 cup (50 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cake flour </td>
                                        <td> 1/4 cup (30 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cornstarch </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Large eggs, separated and at room temperature </td>
                                        <td> 3 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cream of tartar </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon juice </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Powdered sugar, for dusting </td>
                                        <td> as needed </td>
                                    </tr>
                    
                                   
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 320°F (160°C). Line the bottom and sides of an 8-inch (20-cm) round cake pan with parchment paper.</li>
                                    <li>In a large mixing bowl, whisk together the cream cheese and unsalted butter until smooth and creamy.</li>
                                    <li>In a small saucepan, heat the whole milk over low heat until it just comes to a simmer.</li>
                                    <li>In a separate mixing bowl, whisk together the granulated sugar, cake flour, and cornstarch.</li>
                                    <li>Gradually whisk the dry mixture into the cream cheese mixture until it is well combined.</li>
                                    <li>Slowly pour the hot whole milk into the cream cheese mixture, whisking constantly until it is well combined.</li>
                                    <li>Add the egg yolks to the mixture, and whisk until the mixture is smooth.</li>
                                    <li>In a separate mixing bowl, beat the egg whites and cream of tartar until stiff peaks form.</li>
                                    <li>Gently fold the egg whites into the cream cheese mixture, a little at a time, until they are well incorporated.</li>
                                    <li>Add the lemon juice to the mixture, and fold it in gently.</li>
                                    <li>Pour the cheesecake batter into the prepared cake pan, and smooth the top with a spatula.</li>
                                    <li>Place the cake pan into a larger baking dish, and add hot water to the larger dish until it reaches about halfway up the sides of the cake pan.</li>
                                    <li>Bake the cheesecake in the preheated oven for about 40-45 minutes, or until it is set but still jiggles slightly in the center.</li>
                                    <li>Remove the cheesecake from the oven, and let it cool completely in the pan.</li>
                                    <li>Once the cheesecake is cool, remove it from the pan and dust the top with powdered sugar.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/souffle-japanese-cheesecake/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/5-Pear and Almond Tart.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Pear and Almond Tart</h2>
                    </div>
                    <p>Fancy as it may look, this traditional French-style Pear Almond Tart or Pear Frangipane Tart is easier to make than you think. It`s a perfect fall dessert, especially during Thanksgiving!</p>
                    <a href="#popup5-dessert" class="btn">View Recipe</a>
                    <div id="popup5-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Pear and Almond Tart</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> All-purpose flour </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Powdered sugar </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter, room temperature </td>
                                        <td>1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Large egg yolk, room temperature </td>
                                        <td> 1 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Almond flour </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vanilla extract </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Pears, peeled, cored, and sliced </td>
                                        <td> 	3 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Apricot jam, melted </td>
                                        <td> As needed </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sliced almonds </td>
                                        <td> As needed </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 375°F (190°C).</li>
                                    <li>In a large mixing bowl, combine the all-purpose flour and powdered sugar, and mix well.</li>
                                    <li>Add the unsalted butter to the bowl, and mix with a pastry blender or your fingers until the mixture is crumbly.</li>
                                    <li>Add the egg yolk to the bowl, and mix until the dough comes together into a ball.</li>
                                    <li>Flatten the dough into a disk, and wrap it in plastic wrap.</li>
                                    <li>Chill the dough in the refrigerator for at least 30 minutes.</li>
                                    <li>Once the dough is chilled, roll it out on a floured surface, and transfer it to a 9-inch (23 cm) tart pan with a removable bottom.</li>
                                    <li>Press the dough into the bottom and sides of the pan, trimming off any excess dough.</li>
                                    <li>In a separate mixing bowl, cream the unsalted butter and granulated sugar together until they are light and fluffy.</li>
                                    <li>Add the almond flour to the bowl, and mix until it is well incorporated.</li>
                                    <li>Add the eggs to the bowl one at a time, and beat well after each addition.</li>
                                    <li>Add the vanilla extract to the bowl, and mix until it is well incorporated.</li>
                                    <li>Pour the almond mixture into the prepared tart shell, and smooth it out into an even layer.</li>
                                    <li>Arrange the sliced pears on top of the almond mixture, pressing them down slightly.</li>
                                    <li>Bake the Pear and Almond Tart for 40-45 minutes or until the filling is golden brown and set.</li>
                                    <li>Remove the tart from the oven, and brush the melted apricot jam over the top of the pears.</li>
                                    <li>Sprinkle the sliced almonds over the top of the tart, and let it cool to room temperature before slicing and serving.</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/pear-almond-tart/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/6-Matcha Chocolate.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Matcha Chocolate</h2>
                    </div>
                    <p>Made with white chocolate, butter, and cream and dusted with Japanese green tea powder, this decadent Matcha Chocolate (or Matcha Nama Chocolate) is simply irresistible. It`s rich with a truffle-like texture and just the right touch of sweetness. </p>
                    <a href="#popup6-dessert" class="btn">View Recipe</a>
                    <div id="popup6-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Matcha Chocolate</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> White chocolate, chopped </td>
                                        <td> 8 oz (227 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Heavy cream </td>
                                        <td> 1/4 cup (60 ml) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Matcha powder </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Place the chopped white chocolate in a heatproof bowl.</li>
                                    <li>In a small saucepan, heat the heavy cream over medium heat until it comes to a simmer.</li>
                                    <li>Remove the saucepan from the heat, and whisk in the matcha powder until it is well combined.</li>
                                    <li>Pour the hot matcha cream over the white chocolate, and let it sit for a few minutes to allow the chocolate to melt.</li>
                                    <li>Stir the mixture together until the chocolate is completely melted and the mixture is smooth.</li>
                                    <li>Add the unsalted butter to the bowl, and stir until it is well incorporated.</li>
                                    <li>Pour the matcha chocolate into a silicone chocolate mold or candy mold, and chill it in the refrigerator until it is firm.</li>
                                    <li>Once the matcha chocolate is firm, remove it from the mold, and store it in an airtight container in the refrigerator until ready to serve.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/green-tea-chocolate/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/7-Matcha Ice Cream.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Matcha Ice Cream</h2>
                    </div>
                    <p>Earthy and sweet Matcha Ice Cream is the perfect refreshing treat on a hot day. You only need a few simple ingredients to make this recipe at home. With a deep intensity and rich texture, this green tea ice cream instantly takes me back to Japan. If you want to know what true Japanese matcha ice cream tastes like, this recipe is for you.</p>
                    <a href="#popup7-dessert" class="btn">View Recipe</a>
                    <div id="popup7-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Matcha Ice Cream</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Heavy cream </td>
                                        <td> 1 cup (240 ml) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Whole milk </td>
                                        <td> 1 cup (240 ml) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 3/4 cup (150 g) </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Matcha powder </td>
                                        <td> 3 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Large egg yolks </td>
                                        <td> 4 </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large saucepan, heat the heavy cream, whole milk, granulated sugar, and salt over medium heat until it comes to a simmer.</li>
                                    <li>Remove the saucepan from the heat, and whisk in the matcha powder until it is well combined.</li>
                                    <li>In a separate mixing bowl, whisk the large egg yolks until they are light and frothy.</li>
                                    <li>Gradually pour the hot matcha cream into the egg yolks, whisking constantly to prevent the eggs from curdling.</li>
                                    <li>Pour the egg mixture back into the saucepan, and cook over low heat, stirring constantly, until the mixture thickens and coats the back of a spoon.</li>
                                    <li>Remove the saucepan from the heat, and strain the mixture through a fine-mesh strainer into a large mixing bowl.</li>
                                    <li>Cover the bowl with plastic wrap, and chill the mixture in the refrigerator until it is completely chilled.</li>
                                    <li>Once the matcha ice cream mixture is chilled, pour it into an ice cream maker, and churn it according to the manufacturer's instructions.</li>
                                    <li>Transfer the churned matcha ice cream to a freezer-safe container, and freeze it until it is firm.</li>
                                    <li>Once the matcha ice cream is firm, remove it from the freezer, and let it sit at room temperature for a few minutes to soften before scooping and serving.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/green-tea-ice-cream-matcha-ice-cream/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/8-Hanami Dango.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Hanami Dango</h2>
                    </div>
                    <p>Skewered dumplings made with rice flour and glutinous rice flour, Hanami Dango are popular snacks enjoyed during cherry blossom viewing in Japan. These chewy dumplings in three colors (sanshoku dango) come in pink, white, and green springtime hues. With just a touch of sweetness, this traditional Japanese confectionery announces the arrival of spring.</p>
                    <a href="#popup8-dessert" class="btn">View Recipe</a>
                    <div id="popup8-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Hanami Dango</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Mochiko (glutinous rice flour) </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Hot water </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Food coloring (pink, green, yellow) </td>
                                        <td> a few drops </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Anko (sweet red bean paste)</td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Kinako (roasted soybean flour) </td>
                                        <td>2 tbsp </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a large mixing bowl, combine the mochiko and hot water, and stir until it forms a smooth dough.</li>
                                    <li>Divide the dough into three equal portions, and add a few drops of food coloring to each portion to make them pink, green, and yellow.</li>
                                    <li>Roll each portion of the dough into small balls, about the size of a cherry.</li>
                                    <li>Cook the dango in boiling water until they float to the surface, and then let them cook for another 1-2 minutes.</li>
                                    <li>Remove the dango from the boiling water with a slotted spoon, and transfer them to a bowl of cold water to cool.</li>
                                    <li>Skewer three dango balls onto a bamboo skewer, alternating colors.</li>
                                    <li>Toast the kinako in a dry skillet over medium heat until it is fragrant and lightly browned.</li>
                                    <li>Serve the dango skewers with a dollop of anko and a sprinkle of toasted kinako.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/hanami-dango/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/9-Pan Pudding.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Pan Pudding</h2>
                    </div>
                    <p>Pan Pudding (Japanese Milk Bread Pudding) is made with fluffy shokupan, eggs, milk, and sugar and topped with a delicious caramel sauce. The high ratio of custard gives this dish the texture of purin (the Japanese take on crème caramel or flan) that simply melts in your mouth.</p>
                    <a href="#popup9-dessert" class="btn">View Recipe</a>
                    <div id="popup9-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Pan Pudding</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Bread slices </td>
                                        <td> 4-5 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Milk</td>
                                        <td> 2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Eggs </td>
                                        <td> 3 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td>1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vanilla extract </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Butter </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Raisins or dried cranberries (optional) </td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 350°F (175°C).</li>
                                    <li>Cut the bread slices into small cubes, and arrange them in a buttered baking dish.</li>
                                    <li>In a mixing bowl, whisk together the milk, eggs, sugar, and vanilla extract until well combined.</li>
                                    <li>Pour the milk mixture over the bread cubes, making sure to soak each piece of bread.</li>
                                    <li>Dot the top of the bread mixture with small pieces of butter.</li>
                                    <li>If desired, sprinkle raisins or dried cranberries on top of the bread mixture.</li>
                                    <li>Bake the pudding in the preheated oven for about 45-50 minutes, or until it is golden brown and set in the center.</li>
                                    <li>Let the pudding cool for a few minutes before serving.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/pan-pudding/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/3-DESSERT/10-Madeleines.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Madeleines</h2>
                    </div>
                    <p>With their signature shell shape, Madeleines are bite-sized French butter cakes with a hint of lemon. The Japanese have long enjoyed Madeleines for their light, fluffy, and moist texture. They are a perfect treat for afternoon tea!</p>
                    <a href="#popup10-dessert" class="btn">View Recipe</a>
                    <div id="popup10-dessert" class="popup">
                        <a href="#recipes-dessert" class="close">&times;</a>
                        <h2>Madeleines</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Unsalted butter, melted and cooled </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> All-purpose flour </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Baking powder </td>
                                        <td> 1 Tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Salt </td>
                                        <td> 1/4 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Granulated sugar </td>
                                        <td> 2/3 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Eggs </td>
                                        <td> 2 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Vanilla extract </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon zest </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Preheat the oven to 350°F (175°C). Grease a madeleine pan with butter or cooking spray.</li>
                                    <li>In a medium mixing bowl, sift together the flour, baking powder, and salt.</li>
                                    <li>In a separate large mixing bowl, whisk together the sugar and eggs until light and frothy, about 2-3 minutes.</li>
                                    <li>Add the vanilla extract and lemon zest to the egg mixture, and whisk to combine.</li>
                                    <li>Add the sifted flour mixture to the egg mixture, and whisk until just combined.</li>
                                    <li>Gently fold in the melted butter until fully incorporated into the batter.</li>
                                    <li>Spoon the batter into the prepared madeleine pan, filling each mold about 3/4 full.</li>
                                    <li>Bake in the preheated oven for 10-12 minutes, or until the madeleines are golden brown and spring back when touched.</li>
                                    <li>Remove the madeleines from the oven and let them cool for a few minutes before removing them from the pan and transferring them to a wire rack to cool completely.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="https://www.justonecookbook.com/madeleines/">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-dessert" class="close-popup"></a>
                </div>
            </div>
        </div>

    </section>
    <!-- #READ MORE LESS END -->

    <!-- QUOTE START -->

    <section id="quote">
        <div class="text-wrapper">
            <h2>Cool and Refreshing Beverage Recipes</h2>
            <h1>To Quench Your Thirst</h1>
        </div>
    </section>

    <!-- QUOTE END -->

    <!-- #RECIPE MENU -->

    <section id="recipes-beve">
        <div class="section-heading">
            <h3>Beverage</h3>
            <h1>Good drinks, good friends, good times.</h1>
            <div class="square-wrapper flex-row">
                <div class="square"></div>
                <div class="square"></div>
                <div class="square"></div>
            </div>
        </div>
        <div class="toggle-button-container">
            <button class="toggle-button-beve">Show More</button>
        </div>

        <div class="menu">
            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/1-Amazake.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Amazake</h2>
                    </div>
                    <p>Creamy with a natural mild sweetness, Amazake or sweet sake is a popular Japanese hot drink during the New Year`s and Hina Matsuri (Doll Festival). In this post, you will see two ways to make Amazake: one with rice koji and the other one with sake lees.</p>
                    <a href="#popup1-beve" class="btn">View Recipe</a>
                    <div id="popup1-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Amazake</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Short-grain rice </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 3 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> koji</td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar </td>
                                        <td> 2-4 tbsp (optional) </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Rinse the rice in cold water and drain.</li>
                                    <li>In a large pot, bring the rice and water to a boil. Reduce the heat to low and simmer, covered, for 20-30 minutes or until the rice is fully cooked and soft.</li>
                                    <li>Remove the pot from heat and let it cool down for 10-15 minutes.</li>
                                    <li>Mix the koji into the cooked rice and stir well.</li>
                                    <li>Cover the pot with a lid and place it in a warm spot, such as an oven with the light turned on, for 8-10 hours.</li>
                                    <li>Once the mixture has fermented and thickened, stir it well and strain the liquid into a separate bowl, pressing down on the solids with a spoon or spatula to extract as much liquid as possible.</li>
                                    <li>Add sugar to taste, if desired.</li>
                                    <li>Serve the amazake warm or chilled.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/2-Matcha Latte.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Matcha Latte</h2>
                    </div>
                    <p>Learn how to make a creamy and frothy cup of homemade Matcha Latte! This hot beverage with green tea powder is packed with antioxidants and tastes better than Starbucks. </p>
                    <a href="#popup2-beve" class="btn">View Recipe</a>
                    <div id="popup2-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Matcha Latte</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Matcha powder </td>
                                        <td> 1 tsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Hot water </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td>Milk</td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Honey or sugar (optional) </td>
                                        <td> to taste </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a mug, whisk together the matcha powder and hot water until smooth and frothy.</li>
                                    <li>Heat the milk in a small saucepan over medium heat until steaming hot.</li>
                                    <li>Pour the hot milk into the mug with the matcha mixture and stir well.</li>
                                    <li>Add honey or sugar to taste, if desired.</li>
                                    <li>Enjoy your matcha latte hot!</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/3-Royal Milk Tea.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Royal Milk Tea</h2>
                    </div>
                    <p>A popular drink in Japan, Royal Milk Tea is made with Assam or Darjeeling tea leaves and milk. You can add sugar or honey to suit your taste. It`s a delicious drink to serve when you have friends over for tea time.</p>
                    <a href="#popup3-beve" class="btn">View Recipe</a>
                    <div id="popup3-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Royal Milk Tea</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Black tea leaves or tea bags </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Milk</td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar or honey (optional)</td>
                                        <td> to taste </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a medium saucepan, bring the water to a boil.</li>
                                    <li>Add the black tea leaves or tea bags to the boiling water and simmer for 5 minutes.</li>
                                    <li>Remove the pot from heat and let the tea steep for 3-5 more minutes.</li>
                                    <li>Strain the tea leaves or remove the tea bags and pour the tea into a separate pot or container.</li>
                                    <li>Add the milk to the pot with the tea and heat over medium-low heat until steaming hot.</li>
                                    <li>Add sugar or honey to taste, if desired.</li>
                                    <li>Pour the royal milk tea into a mug and enjoy hot!</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/4-Honey Ginger Tea.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Honey Ginger Tea</h2>
                    </div>
                    <p>Sip your way to a healthy start with a warming cup of shōgayu, or Honey Ginger Tea! Not only is it a potent cold and flu remedy, but ginger tea also boasts a myriad of health benefits. Learn how to make a simple cup at home and enjoy it all winter long.</p>
                    <a href="#popup4-beve" class="btn">View Recipe</a>
                    <div id="popup4-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Honey Ginger Tea</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Fresh ginger root, sliced </td>
                                        <td> 2-3 inches </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 4 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Honey</td>
                                        <td> 1/4 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Lemon juice (optional)</td>
                                        <td> to taste </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a saucepan, bring the sliced ginger and water to a boil.</li>
                                    <li>Reduce the heat and simmer for 15-20 minutes.</li>
                                    <li>Remove from heat and strain the ginger water.</li>
                                    <li>Stir in honey and lemon juice to taste.</li>
                                    <li>Serve hot and enjoy your honey ginger tea!</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/5-Aka Shiso Juice.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Aka Shiso Juice</h2>
                    </div>
                    <p>With a beautiful, rose color and a refreshing taste, Aka Shiso Juice (Red Perilla Juice) is a popular homemade summer drink in Japan made of red perilla leaves. It brings out your appetite on hot days and helps with recovery from exhaustion, digestion, anti-aging, and more!!</p>
                    <a href="#popup5-beve" class="btn">View Recipe</a>
                    <div id="popup5-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Aka Shiso Juice</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Aka shiso leaves </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 4 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Sugar</td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td>Lemon juice (optional)</td>
                                        <td> to taste </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Rinse the aka shiso leaves and chop them coarsely.</li>
                                    <li>In a saucepan, bring the chopped shiso leaves and water to a boil.</li>
                                    <li>Reduce the heat and simmer for 10-15 minutes.</li>
                                    <li>Strain the liquid through a fine-mesh sieve, pressing down on the solids to extract as much juice as possible.</li>
                                    <li>Return the juice to the saucepan and add sugar.</li>
                                    <li>Cook over low heat, stirring constantly, until the sugar dissolves and the juice thickens slightly.</li>
                                    <li>Remove from heat and stir in lemon juice to taste.</li>
                                    <li>Let the aka shiso juice cool to room temperature, then chill in the refrigerator.</li>
                                    <li>Serve cold and enjoy your refreshing aka shiso juice!</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/6-Mulled Cider (with Wine) & Homemade Mulling Spices.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Mulled Cider (with Wine) & Homemade Mulling Spices</h2>
                    </div>
                    <p>Infused with Homemade Mulling Spices, Mulled Cider (with or without wine) is the perfect drink to serve during the holidays. It fills your kitchen with a rich, spicy aroma that`s warm and welcoming as the drink itself!</p>
                    <a href="#popup6-beve" class="btn">View Recipe</a>
                    <div id="popup6-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Mulled Cider (with Wine) & Homemade Mulling Spices</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Apple cider </td>
                                        <td> 4 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Red wine </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Orange, sliced</td>
                                        <td> 1 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Mulling spices (see recipe below) </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Honey or brown sugar </td>
                                        <td> to taste </td>
                                    </tr>
                    
                                    
                                </table>
                                <h2>Mulling Spices</h2>
                                <table>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                    </tr>
                                    <tr>
                                        <td>Cinnamon sticks</td>
                                        <td>2-3</td>
                                    </tr>
                                    <tr>
                                        <td>Whole cloves</td>
                                        <td>10-12</td>
                                    </tr>
                                    <tr>
                                        <td>Whole allspice berries</td>
                                        <td>1 tsp</td>
                                    </tr>
                                    <tr>
                                        <td>Star anise</td>
                                        <td>1-2</td>
                                    </tr>
                                    <tr>
                                        <td>Nutmeg, freshly grated</td>
                                        <td>1/4 tsp</td>
                                    </tr>
                                    
                                </table>
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>In a saucepan, combine the apple cider, red wine, and sliced orange.</li>
                                    <li>Add the mulling spices to a tea bag or cheesecloth and tie it with kitchen twine.</li>
                                    <li>Add the spice bag to the pot and bring the mixture to a simmer over low heat.</li>
                                    <li>Simmer for 20-30 minutes, stirring occasionally, until the flavors have melded.</li>
                                    <li>Remove the spice bag and orange slices with a slotted spoon.</li>
                                    <li>Stir in honey or brown sugar to taste.</li>
                                    <li>Ladle the mulled cider into mugs and enjoy your cozy and fragrant drink!</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/7-Buckwheat Tea.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Sobacha</h2>
                    </div>
                    <p>Brewed from buckwheat grains, this healthy and delicious Buckwheat Tea or Sobacha will be your new favorite drink! A popular tea in Japan, it is a great way to get the many benefits, along with its antioxidant power. You could enjoy it cold or warm and it`s perfect for an evening drink just before bed. </p>
                    <a href="#popup7-beve" class="btn">View Recipe</a>
                    <div id="popup7-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Sobacha</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Sobacha (roasted buckwheat tea) </td>
                                        <td> 2 tbsp</td>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 2 cups </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Put sobacha and water in a medium saucepan and bring to a boil.</li>
                                    <li>Once boiling, reduce the heat to low and simmer for 5-10 minutes.</li>
                                    <li>Remove from heat and strain the tea into a teapot or a serving pitcher.</li>
                                    <li>Serve hot or cold.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/8-Masala Chai.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Masala Chai</h2>
                    </div>
                    <p>The Masala Chai is a delicious Indian milk tea made with a blend of spices such as cardamom and ginger. There are many versions of this tea, but this recipe is from my Indian neighbor who became one of my best friends.</p>
                    <a href="#popup8-beve" class="btn">View Recipe</a>
                    <div id="popup8-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Masala Chai</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Water </td>
                                        <td> 2 cups </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Black tea bags </td>
                                        <td> 2 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cinnamon sticks</td>
                                        <td> 2 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cardamom pods, crushed </td>
                                        <td> 4-5 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cloves </td>
                                        <td> 4-5 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Ginger, grated or sliced </td>
                                        <td> 1 inch </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Milk </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> sugar </td>
                                        <td>2 tbsp (or to taste)</td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                               
                                <ol>
                                    <li>In a medium saucepan, add water, tea bags, cinnamon sticks, cardamom pods, cloves, and ginger. Bring to a boil.</li>
                                    <li>Reduce the heat to low and simmer for 5 minutes.</li>
                                    <li>Add milk and sugar to the saucepan and continue to simmer for 2-3 minutes.</li>
                                    <li>Remove from heat and strain the tea into a teapot or a serving pitcher.</li>
                                    <li>Serve hot and enjoy.</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/9-Strawberry Mango Smoothie.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Strawberry Mango Smoothie</h2>
                    </div>
                    <p>Make a delicious breakfast or afternoon treat with this refreshing Strawberry Mango Smoothie with only 5 ingredients! You can use fresh fruits or frozen fruits for this easy drink.</p>
                    <a href="#popup9-beve" class="btn">View Recipe</a>
                    <div id="popup9-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Strawberry Mango Smoothie</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Frozen strawberries </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Frozen mango chunks </td>
                                        <td>1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Greek yogurt </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Honey </td>
                                        <td> 2 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Orange juice </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Combine all ingredients in a blender and blend until smooth.</li>
                                    <li>If the smoothie is too thick, add more orange juice as needed.</li>
                                    <li>Serve immediately and enjoy!</li>
                                    
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>

            <div class="food-items">
                <img src="./img/RECIPES/4-BEVERAGE/10-Chocolate Banana Smoothie.jpg">
                <div class="details">
                    <div class="details-sub">
                        <h2>Chocolate Banana Smoothie</h2>
                    </div>
                    <p>Power charge your day with this Chocolate Banana Smoothie made with velvety soy milk blended with banana! For additional creaminess & fun, top with whipped cream and colorful sprinkles.</p>
                    <a href="#popup10-beve" class="btn">View Recipe</a>
                    <div id="popup10-beve" class="popup">
                        <a href="#recipes-beve" class="close">&times;</a>
                        <h2>Chocolate Banana Smoothie</h2>
                        <div class="containers">
                            <div class="top">
                                <h2>Ingredients</h2>
                                <table>
                                    <tr> 
                                        <th> Name </th>
                                        <th> Quantity </th>
                                    </tr>
                    
                                    <tr>
                                        <td> Ripe banana </td>
                                        <td> 1 </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Cocoa powder </td>
                                        <td> 1 tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Honey</td>
                                        <td> 1 Tbsp </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Almond milk </td>
                                        <td> 1 cup </td>
                                    </tr>
                    
                                    <tr>
                                        <td> Ice cubes </td>
                                        <td> 1/2 cup </td>
                                    </tr>
                    
                                    
                                </table>
                                
                            </div>
                            <div class="bottom">
                                <h2>Steps</h2>
                                
                                <ol>
                                    <li>Combine all ingredients in a blender and blend until smooth.</li>
                                    <li>If the smoothie is too thick, add more almond milk as needed.</li>
                                    <li>Serve immediately and enjoy!</li>
                                </ol>
                                
                                <div class="reference">
                                    <a href="">just one cookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="#recipes-beve" class="close-popup"></a>
                </div>
            </div>
        </div>

    </section>
    <!-- #READ MORE LESS END -->
    
    <!-- FOOTER-QUOTE START -->

    <section class="footer-quote flex-col">
        <h1>From Our Kitchen To Yours, Let's Create Something Delicious</h1>
        <!-- <a href="#" class="btn3">View Our Delicious Recipes</a> -->
    </section>

    <!-- FOOTER-QUOTE END -->
    

    
    <!-- FOOTER START -->

    <footer id="footer">
        <div class="footer-top flex-row">

            <div class="flex-col">
                <h4 class="logo-name">AMBATUCOOKS</h4>

                <p class="desc">"Food is not just fuel, it's information. It talks to your DNA and tells it what to do. The most powerful tool to change your health, environment and entire world is your fork. Every time you eat, you make a choice. With every bite, you hold the power to change your life and the lives of others. Choose wisely, savor every flavor and nourish your body with love and respect."<br>- Dr. Mark Hyman.</p>
                <ul class="social-links">
                    <li><a href="https://facebook.com/ambatucooks69" target="_blank"><i class="icon bx bxl-facebook"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="icon bx bxl-twitter"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="icon bx bxl-instagram"></i></a></li>
                </ul>
            </div>

            <div class="flex-col">
                <h4 class="heading">ADDRESS</h4>

                <p class="desc">Zone 6 Capisnon<br>Kauswagan, Cagayan de Oro City 9000</p>
                <p class="desc">P: +63 997 267 1584<br>E: ambatucooks@gmail.com</p>
            </div>

            <div class="flex-col">
                <h4 class="heading">MORE INFO</h4>
                <a href="recipes.php#menu">Menu</a>
                <a href="index.php#about">About</a>
                <a href="index.php#consect">Contact Us</a>
                <a href="recipes.php#blogs">Specials</a>
            </div>

        </div>

        <div class="footer-bottom flex-row">
            <span>Copyright &copy 2023 All rights reserved | AmbatuCooks</span>
        </div>
    </footer>

    <!-- FOOTER END -->



    <!-- JQEURY -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- OWL CARO -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    
    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- LIGHTGAL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery-js/1.4.0/js/lightgallery.min.js"></script>

    <script>
        lightGallery(document.querySelector('.gallery-wrapper'));
    </script>


    <!-- LOCAL JS -->
    <script src="./assets/script-recipe-list.js"></script>

    <script>
        var myAudio = document.getElementById("bg-music");
        myAudio.volume = 0.2;

        var myload = document.getElementById("bg-ambatu");
        myload.volume = 0.2;
    </script>

</body>

</html>