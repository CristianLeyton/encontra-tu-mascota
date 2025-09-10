import './bootstrap';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', () => {
    new Swiper('.post-gallery', {
        modules: [Navigation, Pagination],
        loop: true,
        spaceBetween: 10,
        slidesPerView: 1,
        centeredSlides: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});