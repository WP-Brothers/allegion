<?php

add_filter(
    'wpb_twig_faq_context',
    function (array $context): array {

        if(!empty($context['faqs'])) {
            $faqs = [];

            foreach($context['faqs'] as $faq){
                $faqs[$faq->ID]['name'] = $faq->post_title;
                $faqs[$faq->ID]['content'] = get_the_content('', '',$faq->ID);
            }            
            
            $context['faqs'] = $faqs;
        }

        return $context;
    }
);
