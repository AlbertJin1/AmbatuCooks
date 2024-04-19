
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


// TOP ON RELOAD
if (history.scrollRestoration) {
    history.scrollRestoration = 'manual';
} else {
    window.onbeforeunload = function () {
        window.scrollTo(0, 0);
    }
}

// SCROLL TO TOP
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


// FOR MAIN DISH SHOW BUTTON
var bmain = document.querySelector('.toggle-button-main');
var cmain = document.getElementById("recipes-main");

bmain.addEventListener('click', function () {

    if (cmain.style.maxHeight) {
        cmain.style.maxHeight = null;
        bmain.textContent = 'Show More';
    } else {
        cmain.style.maxHeight = cmain.scrollHeight + 'px';
        bmain.textContent = 'Show Less';
    }
});

// FOR APPETIZER SHOW BUTTON
var bappe = document.querySelector('.toggle-button-appe');
var cappe = document.getElementById("recipes-appe");

bappe.addEventListener('click', function () {

    if (cappe.style.maxHeight) {
        cappe.style.maxHeight = null;
        bappe.textContent = 'Show More';
    } else {
        cappe.style.maxHeight = cappe.scrollHeight + 'px';
        bappe.textContent = 'Show Less';
    }
});

// FOR DESSERT SHOW BUTTON
var bdessert = document.querySelector('.toggle-button-dessert');
var cdessert = document.getElementById("recipes-dessert");

bdessert.addEventListener('click', function () {

    if (cdessert.style.maxHeight) {
        cdessert.style.maxHeight = null;
        bdessert.textContent = 'Show More';
    } else {
        cdessert.style.maxHeight = cdessert.scrollHeight + 'px';
        bdessert.textContent = 'Show Less';
    }
});

// FOR BEVERAGE SHOW BUTTON
var bbeve = document.querySelector('.toggle-button-beve');
var cbeve = document.getElementById("recipes-beve");

bbeve.addEventListener('click', function () {

    if (cbeve.style.maxHeight) {
        cbeve.style.maxHeight = null;
        bbeve.textContent = 'Show More';
    } else {
        cbeve.style.maxHeight = cbeve.scrollHeight + 'px';
        bbeve.textContent = 'Show Less';
    }
});