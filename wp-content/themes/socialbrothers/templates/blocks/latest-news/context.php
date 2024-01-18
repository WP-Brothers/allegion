<?php

add_filter(
    'wpb_twig_latest-news_context',
    function (array $context): array {

        if(!empty($context['news'])) {
            $news = [];
            foreach($context['news'] as $article) {
                $news[] = wpb_build_news_card_context($article->ID);
            }
            $context['news'] = $news;
        }

        return $context;
    }
);