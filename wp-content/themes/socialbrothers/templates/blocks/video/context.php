<?php

add_filter(
    'wpb_twig_video_context',
    function (array $context): array {

        $context['video_elm'] = wpb_add_video_context($context);

        if (! empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons'], 'btn--solid btn--ghost');
        }

        return $context;
    }
);