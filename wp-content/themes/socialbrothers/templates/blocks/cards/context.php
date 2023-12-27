<?php

add_filter(
    'wpb_twig_cards_context',
    function (array $context): array {
        if (! empty($context['cards'])) {
            foreach ($context['cards'] as $key => $card) {
                $context['cards'][$key]['button'] = wpb_build_button_context($card['button']);
            }
        }

        return $context;
    }
);
