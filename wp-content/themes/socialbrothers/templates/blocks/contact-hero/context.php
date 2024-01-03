<?php

add_filter(
    'wpb_twig_contact-hero_context',
    function (array $context): array {
        
        if(empty($context['sub_title']) && !empty(get_field('contact_hours', 'options'))) {
                $context['sub_title'] = get_field('contact_hours', 'options');
        }

        $context['phone'] = get_field('phone', 'options') ?? '';
        $context['email'] = get_field('email', 'options') ?? '';
 
        return $context;
    }
);
