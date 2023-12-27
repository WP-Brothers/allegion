<?php

add_filter(
    'wpb_twig_contact-form_context',
    function (array $context): array {
        if (! empty($context['form_id']) && function_exists('gravity_form')) {
            $context['form'] = gravity_form($context['form_id'], false, true, false, null, false, null, false);
        }

        $context['email']        = get_field('email', 'options');
        $context['phone']        = get_field('phone', 'options');
        $context['socials']      = get_field('socials', 'options');
        $context['address']      = get_field('address', 'options');
        $context['address_link'] = get_field('address_link', 'options');
        $context['business']     = get_field('business', 'options');

        return $context;
    }
);
