import Swiper from 'swiper/bundle'
// console.log (Swiper);
const swiper = new Swiper('.swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay: {
        delay: 30000,
        disableOnInteraction: false,
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next' ,
        prevEl: '.swiper-button-prev',
    },

});

    //
    // const v = document.getElementsByTagName("video")[0];
    //
    // v.addEventListener("canplay", function () {
    //     swiper.stopAutoplay();
    // }, true);
    //
    // v.addEventListener("ended", function () {
    //     swiper.startAutoplay();
    // }, true);
