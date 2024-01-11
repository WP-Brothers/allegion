<?php 

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$links = [];
$productinformation = [];
$specifications = [];
$downloads = [];
$technical_drawings = [];

if(!empty(get_field('product_information', get_the_ID()))) {
    $links['productinformation'] = __('Productinformatie', '_SBF');
    $productinformation = [
        'id' => 'productinformation',
        'title' => __('Product informatie'),
        'content' => get_field('product_information', get_the_ID()),
    ];
}

if(!empty(get_field('product_information', get_the_ID())) || !empty(get_field('specifications_safety', get_the_ID())) || !empty(get_field('specifications_technical', get_the_ID())) ) {
    $links['specifications'] = __('Specificaties', '_SBF');
   
    $specifications['id'] = 'specifications';
    $specifications['title'] = __('Specificaties');

    if(!empty(get_field('product_information', get_the_ID()))) {
        $specifications['content'] = get_field('specifications_text', get_the_ID());
    }

    if(!empty(get_field('specifications_safety', get_the_ID()))) {
        $safety = [];
        $safetyField = get_field('specifications_safety', get_the_ID());
    
        foreach($safetyField as $item) {
            $safety[] = [
                'attribute' => $item['specifications_safety_attribute'],
                'value' => $item['specifications_safety_value']
            ];
        }

        $specifications['safety'] = $safety;
    }

    if(!empty(get_field('specifications_technical', get_the_ID()))) {
        $technical = [];
        $technicalField = get_field('specifications_technical', get_the_ID());
    
        foreach($technicalField as $item) {
            $technical[] = [
                'attribute' => $item['specifications_technical_attribute'],
                'value' => $item['specifications_technical_value']
            ];
        }

        $specifications['technical'] = $technical;
    }
}

if(!empty(get_field('downloads_text', get_the_ID())) || !empty(get_field('downloads_files', get_the_ID()))) {
    $links['downloads'] = __('Downloads', '_SBF');
   
    $downloads['id'] = 'downloads';
    $downloads['title'] = __('Downloads');

    if(!empty(get_field('downloads_text', get_the_ID()))) {
        $downloads['content'] = get_field('downloads_text', get_the_ID());
    }

    if(!empty(get_field('downloads_files', get_the_ID()))) {
        $downloads['files'] = get_field('downloads_files', get_the_ID());
    }
}

if(!empty(get_field('technical_drawings', get_the_ID()))) {
    $links['technical_drawings'] = __('Technische tekeningen', '_SBF');
    $technical_drawings = [
        'id' => 'technical_drawings',
        'title' => __('Technische tekeningen'),
        'drawings' => get_field('technical_drawings', get_the_ID()),
    ];
}

Twig::render(
    'content/single-product.twig',
    Theme::filter(
        'index_context',
        [
            'hero' => [
                'title'             => get_the_title(get_the_ID()),
                'safety_index'      => get_field("safety_index", get_the_ID()) ?? '',
                'product_image'     => get_post_thumbnail_id(get_the_ID()) ?? '',
                'article_number'    => get_field("article_number", get_the_ID()) ?? '',
                'price'             => wpb_build_price(get_field("price", get_the_ID())) ?? '',
                'keurmerken'        => wpb_build_keurmerken(get_the_ID(), 1),
            ],
            'anchor_menu' => [
                'links'             => $links,
            ],
            'productinformation'    => $productinformation,
            'specifications'        => $specifications,
            'downloads'             => $downloads,
            'technical_drawings'    => $technical_drawings,
        ]
    )
);