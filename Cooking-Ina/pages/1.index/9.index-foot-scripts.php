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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>


<!-- LOCAL JS -->
<script src="./assets/script.js"></script>

<script>
    var myAudio = document.getElementById("bg-music");
    myAudio.volume = 0.2;

    // var myload = document.getElementById("bg-ambatu");
    // myload.volume = 0.2;

    window.addEventListener("load", () => {
        const loader = document.querySelector(".loader");

        loader.classList.add("loader--hidden");

        loader.addEventListener("transitionend", () => {
            // Delay the removal of the loader by a short interval
            setTimeout(() => {
                document.body.removeChild(loader);
            }, 500); // Adjust the delay time as needed
        });
    });
</script>