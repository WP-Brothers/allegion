<?php

add_filter(
    'wpb_twig_content-image-banner_context',
    function (array $context): array {
        if (! empty($context['orientation']) && 'vertical' === $context['orientation']) {
            $context['orientation'] = 'md:flex-row-reverse';
        } else {
            $context['orientation'] = '';
        }

        $context['text_inherit'] = true;

        if (! empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons'], 'btn--solid btn--ghost');
        }

        return $context;
    }
);
