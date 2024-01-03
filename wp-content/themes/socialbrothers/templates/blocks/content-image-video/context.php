<?php

add_filter(
    'wpb_twig_content-image-video_context',
    function (array $context): array {
       if(!empty($context['order_switch'])) {
            $context['block_one'] = 'justify-start';
            $context['block_two'] = 'justify-end';
        } else {
            $context['block_one'] = 'justify-end';
            $context['block_two'] = 'justify-start';
       }

        if(function_exists('get_cutoff_class')) {   
           $context['cutoff_class'] = get_cutoff_class('bl-tr');
        }

        $context['video_elm'] = wpb_add_video_context($context);

        return $context;
    }
);