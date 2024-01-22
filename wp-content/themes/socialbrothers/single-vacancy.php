<?php

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$contact_card = [
    'title'             => get_field('vacancy_contact_name', 'options') ?? '',
    'avatar'            => get_field('vacancy_contact_avatar', 'options') ?? '',
    'description'       => get_field('vacancy_contact_description', 'options') ?? '',
    'contact_info'      => get_field('vacancy_contact_info', 'options') ?? '',
];

Twig::render(
    'content/single-vacancy.twig',
    Theme::filter(
        'index_context',
        [
            'hero' => [
                'title'     => get_the_title(),
                'labels'    => wpb_build_vacancy_category_labels(['function', 'location', 'employment_type'], get_the_ID()),
            ],
            'contact' => [
                'content'   => get_field('vacancy_contact_text', 'options') ?? '',
                'button'    => get_field('vacancy_contact_button', 'options') ?? '',
            ],
            'card'      => $contact_card,
            'socials'   => get_field('socials', 'options') ?? [],
            'content'   => get_field('content', get_the_ID()) ?? '',
        ]
    )
);
