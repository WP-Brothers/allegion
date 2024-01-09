<?php 

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;


Twig::render(
    'content/single-product.twig',
    Theme::filter(
        'index_context',
        [
            'hero' => [
                'title'              => get_the_title(get_the_ID()),
                'safety_index'       => get_field("safety_index", get_the_ID()) ?? '',
                'product_image'       => get_field("safety_index", get_the_ID()) ?? '',
                'article_number'       => get_field("article_number", get_the_ID()) ?? '',
            ],
        ]
    )
);
