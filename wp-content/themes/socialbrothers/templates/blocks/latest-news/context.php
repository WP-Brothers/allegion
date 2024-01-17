<?php

add_filter(
    'wpb_twig_latest-news_context',
    function (array $context): array {

        if(!empty($context['news'])) {
            $news = [];
            foreach($context['news'] as $article) {
                $tags = [];
                foreach(get_the_terms($article->ID, 'category_news') as $tag) {
                    array_push($tags, $tag->name);
                }

                $news[$article->ID]['title'] = $article->post_title;
                $news[$article->ID]['excerpt'] = substr(substr(get_the_excerpt($article->ID), 0, 85), 0, strrpos(get_the_excerpt($article->ID), ' ')) . " ...";
                $news[$article->ID]['permalink'] = $article->guid;
                $news[$article->ID]['date'] = date('d-m-Y', strtotime($article->post_date));
                $news[$article->ID]['thumbnail'] = get_the_post_thumbnail($article->ID, 'large', ['class' => "w-full object-cover rounded-[3px] max-h-[165px]"]);
                $news[$article->ID]['tags'] = $tags;
            }
            $context['news'] = $news;
        }

        return $context;
    }
);