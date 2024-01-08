<?php

add_filter(
    'wpb_twig_hero-slider_context',
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
        } else {
            $swiper_options['slidesPerView'] = 1.4;
        }
        
        $context['slide_content'] = 'molecules/hero-slide.twig';
        $context['background_image'] = true;
        $context['swiper_navigation'] = true;
        $context['slide_classes'] = '!h-auto self-stretch';
        $context['swiper_options'] = json_encode($swiper_options);

        return $context; 
    }
);
