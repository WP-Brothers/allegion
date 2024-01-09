<?php

add_filter(
    'wpb_twig_content-product-slider_context',
    function (array $context): array {
        $slides   = [];


        if(!empty($context['products'])) {
            foreach($context['products'] as $product) {
                $slides[] = wpb_build_product_card_context($product->ID);
            }
        }

        $context['slides'] = $slides;

        if (!empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }

        $swiper_options = [
            'slidesPerView' => 1,
            'spaceBetween'  => 16,
            'swipeDirection' => 'next',
            'navigation' => true,
            'breakpoints'   => [
                420 => [
                    'slidesPerView' => 2,
                ],
                540 => [
                    'slidesPerView' => 3,
                ],
                768 => [
                    'spaceBetween' => 24,
                ],
                1024 => [
                    'slidesPerView' => 2,
                ],
            ],
        ];

        $context['swiper_options'] = json_encode($swiper_options);
        $context['swiper_navigation'] = $swiper_options['navigation'];
        
        $context['flow'] = 0;
        $context['swiper_navigation'] = 0;
        
        $context['slide_content'] = 'molecules/product-card.twig';
        return $context;
    }
);
