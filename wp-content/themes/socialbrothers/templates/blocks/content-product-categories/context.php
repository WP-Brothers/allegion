<?php

add_filter(
    'wpb_twig_content-product-categories_context',
    function (array $context): array {
 
        if (! empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }

        if(!empty($context['category_products'])) {
            $categories = [];
            foreach($context['category_products'] as $category) {
                $term = get_term($category['category']);

                $categories[$term->term_id]['name'] = get_field('display_name', $term->taxonomy . '_' . $term->term_id) ?? $term->name;
                $categories[$term->term_id]['image_id'] = get_field('highlight_image', $term->taxonomy . '_' . $term->term_id) ?? '';
                $categories[$term->term_id]['slug'] = $term->slug ?? '';

            }
            $context['category_products'] = $categories;
        }
        return $context;
    }
);
