<?php

declare(strict_types=1);

function wpb_build_button_context(array $button, string $type = null): array
{
    if (empty($type)) {
        $type = 'btn--solid';
    }

    if (! empty($button['link']['url'])) {
        $type = $button['type'] ?? $type;

        $button_data = [
            'url'    => $button['link']['url'],
            'title'  => $button['link']['title'],
            'target' => $button['link']['target'] ?? '_self',
            'type'   => $type,
            'icon'   => '',
        ];

        if (! empty($button['use_icon'] && ! empty($button['icon']))) {
            $button_data['icon'] = $button['icon'];

            if (! empty($button['icon_pos'])) {
                $button_data['type'] .= ' btn--icon-right';
            }
        }
    }

    return $button_data ?? [];
}

function wpb_build_buttons_context(array $buttons, string $type = null): array
{
    $context = [];
    foreach ($buttons as $button) {
        if (! empty($button['link']['url'])) {
            $context[] = wpb_build_button_context($button, $type);
        }
    }

    return $context;
}

function wpb_build_news_card_context(string|int $post_id): array
{

    $tags = [];
    foreach(get_the_terms($post_id, 'category_news') as $tag) {
        array_push($tags, $tag->name);
    }

    return [
        'title'         => get_the_title($post_id),
        'excerpt'       => substr(substr(get_the_excerpt($post_id), 0, 85), 0, strrpos(get_the_excerpt($post_id), ' ')) . " ...",
        'permalink'     => get_the_permalink($post_id),
        'date'          => get_the_date('d/m/Y', $post_id),
        'thumbnail'     => get_the_post_thumbnail($post_id, 'large', ['class' => "w-full object-cover rounded-[3px] max-h-[165px]"]),
        'tags'          => $tags,
    ];
}

function wpb_build_product_card_context(string|int $post_id): array
{
    return [
        'title'     => get_the_title($post_id),
        'image_id'  => get_post_thumbnail_id($post_id),
        'keurmerken'=> wpb_build_product_card_keurmerken($post_id),
        'permalink' => get_the_permalink($post_id),
        'article_number' => get_field('article_number', $post_id) ?? '',
        'safety_index' => get_field('safety_index', $post_id) ?? '',
        'external_link' => get_field('external_link', $post_id) ?? '',
    ];
}

function wpb_build_single_head_context(string|int $post_id, bool $show_date = true, bool $show_author = true): array
{
    $context = wpb_build_post_card_context($post_id);
    if (! empty($show_date)) {
        $context['labels'][] = [
            'label' => $context['date'],
            'type'  => 'clean',
            'icon'  => 'schedule',
        ];
    }
    if (! empty($show_author)) {
        $author_id           = get_post_field('post_author', $post_id);
        $context['labels'][] = [
            'label' => get_the_author_meta('display_name', $author_id),
            'type'  => 'clean',
            'icon'  => 'person',
        ];
    }

    return $context;
}

function wpb_build_post_category_labels(string|int $post_id): array
{
    $terms     = [];
    $post_type = get_post_type($post_id);
    if (taxonomy_exists("category_{$post_type}")) {
        $category_terms = get_the_terms($post_id, "category_{$post_type}");
        if (! empty($category_terms)) {
            foreach ($category_terms as $category_term) {
                $terms[] = [
                    'label' => $category_term->name,
                    'type'  => get_field('type', $category_term),
                ];
            }
        }
    }

    return $terms;
}

function wpb_build_product_card_keurmerken(string|int $post_id): array
{
    $returnArray = [];
    $keurmerken = get_field('keurmerken', $post_id) ?? '';

    if(!empty($keurmerken)) {
        foreach($keurmerken as $keurmerk) {
            $returnArray[] = [
                'image' => get_the_post_thumbnail($keurmerk, 'small', ['class' => 'w-auto h-full']),
            ];
        }
    }

    return $returnArray;
}


function wpb_build_safety_index_options()
{
    $indexArray = [];
    $safetyIndexes = get_field('safety_index_repeater', 'options') ?? '';

    $i = 1;
    if(!empty($safetyIndexes)) {
        foreach($safetyIndexes as $index) {
            $indexArray[] = [
                'key' => $index['safety_index_image']['url'],
                'label' => $index['safety_index_title'],
                'image' => $index['safety_index_image']['url'],
            ];
            
            $i++;
        }
    }
        

    return acf_image_select_options($indexArray);
}

function wpb_build_video_context(array $context): array
{
    if (! empty($context['video_type'])) {
        if (! empty($context['embed_video'])) {
            $context['video_elm'] = $context['embed_video'];
        }
    } elseif (! empty($context['video'])) {
        $context['video_elm'] = wp_video_shortcode([
            'src'    => wp_get_attachment_url($context['video']),
            'poster' => wp_get_attachment_url($context['image_id'] ?? false),
            'width'  => '1920',
        ]);
    }

    return $context;
}

function wpb_add_video_context(array $context): string
{
    if (! empty($context['video_group']['video_type'])) {
        if (! empty($context['video_group']['embed_video'])) {
            $video_elm = $context['video_group']['embed_video'];
        }
    } elseif (! empty($context['video_group']['video'])) {
        $video_elm = wp_video_shortcode([
            'src'    => wp_get_attachment_url($context['video_group']['video']),
            'poster' => wp_get_attachment_url($context['video_group']['placeholder_image_id'] ?? false),
            'width'  => '1920',
        ]);
    }

    return !empty($video_elm) ? $video_elm : '';
}

function wpb_build_author_context(string|int $user_id): array
{
    $context                   = [];
    $user                      = get_userdata($user_id);
    $context['name']           = $user->display_name;
    $context['socials']        = get_field('socials', "user_{$user_id}");
    $context['phone']          = get_field('phone', "user_{$user_id}");
    $context['email']          = get_field('email', "user_{$user_id}");
    $context['image_id']       = get_field('avatar', "user_{$user_id}");
    $context['about_me']       = get_field('about_me', "user_{$user_id}");
    $context['button']         = get_field('more_link', "user_{$user_id}");
    $context['button']['icon'] = 'chevron_right';
    $context['button']['type'] = 'btn--link btn--white';

    return $context;
}
