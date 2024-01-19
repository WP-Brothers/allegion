<?php

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

Twig::render(
    'content/single-vacancy.twig',
    Theme::filter(
        'index_context',
        [
            'hero' => [
                'title' => get_the_title(),
                'labels' => wpb_build_vacancy_category_labels(['function', 'location', 'employment_type'], get_the_ID()),
            ],
            'contact' => [
                'content' => 'of heeft u vragen? Neem contact op met Fleur Veltman',
                'button' => [
                    'title' => 'Solliciteer nu',
                    'url' => '#',
                ],
            ],

            'content' => get_field('content', get_the_ID()) ?? '',
        ]
    )
);
