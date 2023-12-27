<?php

add_filter(
    'wpb_twig_single-intro_context',
    function (array $context): array {
        if (! empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }

        return $context;
    }
);
