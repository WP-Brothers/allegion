<?php

add_filter(
    'wpb_twig_thank-you_context',
    function (array $context): array {
        $context['socials'] = get_field('socials', 'options');

        return $context;
    }
);
