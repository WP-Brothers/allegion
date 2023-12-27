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

function wpb_build_post_card_context(string|int $post_id): array
{
    return [
        'title'     => get_the_title($post_id),
        'image_id'  => get_post_thumbnail_id($post_id),
        'date'      => get_the_date('d/m/Y', $post_id),
        'labels'    => wpb_build_post_category_labels($post_id),
        'permalink' => get_the_permalink($post_id),
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
