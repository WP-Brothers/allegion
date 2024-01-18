import Swiper from 'swiper';

// Swiper.use([Navigation]);

const modalSlider = () => {

  const imageSlider = new Swiper('.modal-swiper__image-slider', {
    slidesPerView: 1,
    direction: 'horizontal',
    centeredSlides: false,
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });

  const navSlider = new Swiper('.modal-swiper__nav-slider', {
    slidesPerView: 5,
    direction: 'horizontal',
    spaceBetween: 24,
    allowTouchMove: false,
    centeredSlides: false,
    on: {
      click() {
        imageSlider.slideTo(navSlider.clickedIndex);
      },
    },
  });

  const slides = document.querySelectorAll(
    '.modal-swiper__nav-slider .swiper-slide',
  );
  const firstSlide = document.querySelector(
    '.modal-swiper__nav-slider .swiper-slide',
  )!;

  firstSlide.classList.add('active');

  imageSlider.on('slideChange', () => {
    navSlider.slideTo(imageSlider.activeIndex);

    if (slides.length > 0) {
      slides.forEach((slide, key) => {
        slide.classList.remove('active');
        if (key === imageSlider.activeIndex) {
          slide.classList.add('active');
        }
      });
    }
  });

}
export default modalSlider;