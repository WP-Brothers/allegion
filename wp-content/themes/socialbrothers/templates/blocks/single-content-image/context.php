<?php

add_filter(
    'wpb_twig_single-content-image_context',
    function (array $context): array {
        if (! empty($context['orientation']) && 'vertical' === $context['orientation']) {
            $context['orientation'] = 'md:flex-row-reverse';
        } else {
            $context['orientation'] = '';
        }

        if (! empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }
        $context['big'] = true;

        return $context;
    }
);
