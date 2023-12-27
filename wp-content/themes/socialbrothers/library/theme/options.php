<?php

declare(strict_types=1);

function wpb_get_button_types(): array
{
    return [
        'btn--solid'                  => __('Primair solid', '_SBB'),
        'btn--outline'                => __('Primair outline', '_SBB'),
        'btn--link'                   => __('Primair link', '_SBB'),
        'btn--solid btn--secondary'   => __('Secondair solid', '_SBB'),
        'btn--outline btn--secondary' => __('Secondair outline', '_SBB'),
        'btn--link btn--secondary'    => __('Secondair link', '_SBB'),
        'btn--solid btn--cta'         => __('CTA solid', '_SBB'),
        'btn--outline btn--cta'       => __('CTA outline', '_SBB'),
        'btn--link btn--cta'          => __('CTA link', '_SBB'),
        'btn--solid btn--white'       => __('Wit solid', '_SBB'),
        'btn--outline btn--white'     => __('Wit outline', '_SBB'),
        'btn--link btn--white'        => __('Wit link', '_SBB'),
    ];
}

add_action('admin_head', 'add_fonts_to_admin_head', 10, 0);

function add_fonts_to_admin_head(): void
{
    echo '<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">';
    echo '<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded&family=Material+Icons&family=Lato:ital,wght@0,400;0,700;1,400&family=Merriweather:wght@700&display=swap" rel="stylesheet">';
}
