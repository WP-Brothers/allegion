<?php

add_filter(
    'wpb_twig_form_context',
    function (array $context): array {
        if (! empty($context['form_id']) && function_exists('gravity_form')) {
            $context['form'] = gravity_form($context['form_id'], false, true, false, null, false, null, false);
        }

        return $context;
    }
);
