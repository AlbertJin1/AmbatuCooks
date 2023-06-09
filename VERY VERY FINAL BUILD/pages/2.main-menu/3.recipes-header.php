<!-- PRENAV FIRST -->
<div id="prenav-text">
    <div class="flex-row">
        <div class="contact-info">
            <?php if ($isLogged1) { ?>
                User: <span><?php echo getLoggedInUserName(); ?></span>
            <?php } ?>
            <?php if ($isLogged2) { ?>
                Phone no: <span>+63 997 267 1584</span> or email us: <span>ambatucooks@gmail.com</span>
            <?php } ?>
        </div>
        <div class="opening-times flex-row">
            <ul class="social-links flex-row">
                <li><a href="https://facebook.com/ambatucooks69" target="_blank"><i class="bx bxl-facebook"></i></a></li>
                <!-- <li><a href="javascript:void(0)"><i class="bx bxl-instagram"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="bx bxl-twitter"></i></a></li>
                        <li><a href="javascript:void(0)"><i class="bx bxl-youtube"></i></a></li> -->
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
            <img href="index.php" src="./img/Logo/AMBATU.png" alt="">
        </h5>
    </div>

    <ul id="nav-items" class="nav-items">
        <li><a href="index.php#home" class="nav-links">HOME</a></li>
        <!-- <li><a href="index.php#about" class="nav-links">ABOUT</a></li> -->
        <li><a href="recipes.php" class="nav-links">MAIN MENU</a></li>
        <li><a href="recipes-list.php" class="nav-links">COURSES</a></li>
        <!-- <li><a href="recipe-app.html" target="_blank" class="nav-links">APP</a></li> -->
        <!-- <li><a href="index.php#reviews" class="nav-links">REVIEWS</a></li> -->
        <li><a href="recipes.php#menu" class="nav-links">CATEGORY</a></li>
        <li><a href="recipes.php#blogs" class="nav-links">SPECIALS</a></li>
        <li><a href="#footer" class="nav-links">CONTACT</a></li>
        <?php if ($isLogged1) { ?>
            <li><a href="logout.php" class="nav-links">LOGOUT</a></li>
        <?php } ?>
        <?php if ($isLogged2) { ?>
            <li><a href="login_form.php" class="nav-links">LOGIN</a></li>
        <?php } ?>
    </ul>

    <ul class="nav-btns">

        <div class="nav-icon">
            <i class="darkbtn bx bx-moon"></i>
        </div>

    </ul>

</nav>

<!-- NAVBAR END -->