<?php

add_filter(
    'wpb_twig_content-faq_context',
    function (array $context): array {

        if(!empty($context['faqs'])) {
            $faqs = [];

            foreach($context['faqs'] as $faq){
                $faqs[$faq->ID]['name'] = $faq->post_title;
                $faqs[$faq->ID]['content'] = get_the_content('', '',$faq->ID);
            }            
            
            $context['faqs'] = $faqs;
        }


        if (! empty($context['buttons'])) {
            $context['buttons'] = wpb_build_buttons_context($context['buttons']);
        }

        return $context;
    }
);
