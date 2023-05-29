// HOME CARO
$('.home-carousel').owlCarousel({
    loop: true,
    margin: 0,
    dots: false,
    autoplay: true,
    autoplayTimeout: 7000,
    animateOut: 'fadeOut',
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



menuBtn.onclick = function () {
    document.getElementById("nav-items").classList.toggle('active');

    if (document.getElementById("nav-items").classList.contains('active')) {
        menuBtn.classList.remove("bx-menu");
        menuBtn.classList.add("bx-x");
    }
    else {
        menuBtn.classList.remove("bx-x");
        menuBtn.classList.add("bx-menu");
    }
}



// searchBtn.onclick = function(){
//     document.getElementById("search-form").classList.toggle('active');

//     if(document.getElementById("search-form").classList.contains('active')){
//         searchBtn.classList.remove("bx-search-alt-2");
//         searchBtn.classList.add("bx-x");
//     }
//     else{
//         searchBtn.classList.remove("bx-x");
//         searchBtn.classList.add("bx-search-alt-2");
//     }
// }

// cartBtn.onclick = function(){
//     document.getElementById("cart").classList.toggle('active');

//     if(document.getElementById("cart").classList.contains('active')){
//         cartBtn.classList.remove("bx-cart");
//         cartBtn.classList.add("bx-x");
//     }
//     else{
//         cartBtn.classList.remove("bx-x");
//         cartBtn.classList.add("bx-cart");
//     }
// }

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

    if (e.target.classList.contains('menu-tab-item') && !e.target.classList.contains('active')) {

        const target = e.target.getAttribute("data-target");

        menuTabs.querySelector('.active').classList.remove('active');

        e.target.classList.add("active");

        let menuSection = document.querySelector(".menu-section");

        menuSection.querySelector(".menu-tab-content.show").classList.remove("show");
        menuSection.querySelector(target).classList.add("show");
    }

    else {
        return
    }
})

// BLOGS CAROU
$('.blog-carousel').owlCarousel({
    loop: true,
    dots: false,
    margin: 5,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
})

// REFRESH TO TOP
if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
} else {
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
}

// PROGRESS SCROLL BACK TO TOP
let calcScrollValue = () => {
    let scrollProgress = document.getElementById("progress");
    let progressValue = document.getElementById("progress-value");
    let pos = document.documentElement.scrollTop;
    let calcHeight =
        document.documentElement.scrollHeight -
        document.documentElement.clientHeight;
    let scrollValue = Math.round((pos * 100) / calcHeight);
    if (pos > 100) {
        scrollProgress.style.display = "grid";
    } else {
        scrollProgress.style.display = "none";
    }
    scrollProgress.addEventListener("click", () => {
        document.documentElement.scrollTop = 0;
    });
    scrollProgress.style.background = `conic-gradient(#7C9AD4 ${scrollValue}%, #d7d7d7 ${scrollValue}%)`;
};
window.onscroll = calcScrollValue;
window.onload = calcScrollValue;

// LOADER
var loader = document.querySelector(".loader")

window.addEventListener("load", vanish);

function vanish() {
    loader.classList.add("disappear")
}

// LAZY
var images = document.querySelectorAll('.lazy');

var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > 0) {
            entry.target.src = entry.target.dataset.src;
            observer.unobserve(entry.target);
        }
    });
}, {
    rootMargin: '200px'
  });

images.forEach(function (image) {
    observer.observe(image);
});