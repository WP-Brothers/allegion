<?php

add_filter(
    'wpb_twig_content-slider_context',
    function (array $context): array {
        $slides   = [];

        if(!empty($context['slides_tab_repeater'])) {
            foreach($context['slides_tab_repeater'] as $slide) {

                if (!empty($slide['buttons'])) {
                    $slide['buttons'] = wpb_build_buttons_context($slide['buttons']);
                }

                $slides[] = $slide;
            }
        }
        $context['slides'] = $slides;


        $swiper_options = [
            'spaceBetween'  => 0,
            'swipeDirection' => 'next',
            'navigation' => true,
            'breakpoints'   => [
                768 => [
                    'spaceBetween' => 0,
                ],
            ],
        ];

        if (!empty($context['slider_full_page'])) {
            $swiper_options['slidesPerView'] = 1;
            $swiper_options['centeredSlides'] = false;
        } else {
            $swiper_options['slidesPerView'] = 1.4;
            $swiper_options['centeredSlides'] = true;
            $swiper_options['breakpoints'][768]['spaceBetween'] = 25;
        }
        
        $context['slide_content'] = 'molecules/content-slide.twig';
        $context['background_image'] = true;
        $context['swiper_navigation'] = true;
        $context['slide_classes'] = '!h-auto self-stretch';
        $context['swiper_options'] = json_encode($swiper_options);
        $context['class_name'] = 'py-20';

        return $context; 
    }
);
