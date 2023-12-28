import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';
import { SwiperOptions } from 'swiper/types';
Swiper.use([Navigation, Pagination]);

const swiperInit = (slider: HTMLElement) => {
  const swiper: HTMLElement | null = slider.querySelector('.swiper');

  if (swiper) {
    const defaultOptions: SwiperOptions = {
      keyboard: true,
      spaceBetween: 16,
      slidesPerView: 1.2,
      loop: true,
      slideActiveClass: 'swiper-slide--active',

      pagination: {
        el: slider.querySelector('.swiper-pagination') as HTMLElement,
        clickable: true,
      },

      navigation: {
        prevEl: slider.querySelector('.swiper-button-prev') as HTMLElement,
        nextEl: slider.querySelector('.swiper-button-next') as HTMLElement,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 24,
        },
      },
    };

    const extendedOptionsAttr = slider.getAttribute('data-swiper');
    const extendedOptions: SwiperOptions = extendedOptionsAttr ? JSON.parse(decodeURIComponent(extendedOptionsAttr)) : {};

    if (extendedOptionsAttr) {
      const optionsJSON = JSON.parse(decodeURIComponent(extendedOptionsAttr));

      if (optionsJSON!.responsive) {
        Object.keys(optionsJSON!.responsive)?.forEach((breakpoint) => {
          if (window.innerWidth <= parseInt(breakpoint, 10)) return;

          Object.entries(optionsJSON!.responsive[breakpoint])?.forEach(
            (attribute) => {
              optionsJSON![attribute[0]] = attribute[1];
            }
          );
        });
      }
    }

    return new Swiper(swiper, {
      ...defaultOptions,
      ...extendedOptions,
    });
  }

  return false;
};

export default swiperInit;
