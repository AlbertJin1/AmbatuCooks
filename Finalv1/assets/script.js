// HOME CARO
$('.home-carousel').owlCarousel({
    loop: true,
    margin: 0,
    dots: true,
    nav: false,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

// NAVBAR
window.addEventListener('scroll', function () {
    let navbar = document.getElementById("navbar");
    navbar.classList.toggle('fixed', this.window.scrollY > 0)
})

// NAV BUTTONS
let menuBtn = document.querySelector('.menu-btn');
let searchBtn = document.querySelector('.searchbtn');
let cartBtn = document.querySelector('.cartbtn');
let darkBtn = document.querySelector('.darkbtn');
let signBtn = document.getElementById('signImg');

searchBtn.onclick = function () {
    document.getElementById("search-form").classList.toggle('active');

    if (document.getElementById("search-form").classList.contains('active')) {
        searchBtn.classList.remove("bx-search-alt-2");
        searchBtn.classList.add("bx-x");
    }
    else {
        searchBtn.classList.remove("bx-x");
        searchBtn.classList.add("bx-search-alt-2");
    }
}

cartBtn.onclick = function () {
    document.getElementById("cart").classList.toggle('active');

    if (document.getElementById("cart").classList.contains('active')) {
        cartBtn.classList.remove("bx-cart");
        cartBtn.classList.add("bx-x");
    }
    else {
        cartBtn.classList.remove("bx-x");
        cartBtn.classList.add("bx-cart");
    }
}

darkBtn.onclick = function () {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        darkBtn.classList.remove("bx-moon");
        darkBtn.classList.add("bx-sun");

        signImg.src = './img/sign/sign-dark.png';
    }
    else {
        darkBtn.classList.remove("bx-sun");
        darkBtn.classList.add("bx-moon");

        signImg.src = './img/sign/sign-light.png';
    }
}

// MENU SECTION
let menuTabs = document.querySelector('.menu-tabs');
menuTabs.addEventListener('click', function (e) {
    if (e.target.classList.contains('menu-tab-item') && !e.target.contains('active')) {

        const target = e.target.getAttribute("data-target");

        menuTabs.querySelector('active').classList.remove('active');

        e.target.classList.add("active");

        let menuSection = document.querySelector(".menu-section");

        menuSection.querySelector(".menu-tab-content.show").classList.remove("show");

        menuSection.querySelector(target).classList.add("show");
    }
    else {
        return
    }
})