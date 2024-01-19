<?php 

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

$links = [];
$productinformation = [];
$specifications = [];
$downloads = [];
$technical_drawings = [];
$images = [];


$product = wc_get_product( get_the_ID());

$productData = $product->get_data();


if(!empty($productData['description'])) {
    $links['productinformation'] = __('Productinformatie', '_SBF');
    $productinformation = [
        'id' => 'productinformation',
        'title' => __('Product informatie'),
        'content' => $productData['description'],
    ];
}


if(!empty(get_field('product_information', get_the_ID())) || !empty(get_field('specifications_safety', get_the_ID())) || !empty(get_field('specifications_technical', get_the_ID())) ) {
    $links['specifications'] = __('Specificaties', '_SBF');
   
    $specifications['id'] = 'specifications';
    $specifications['title'] = __('Specificaties');

    if(!empty(get_field('specifications_text', get_the_ID()))) {
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
        $files = [];
        $filesField = get_field('downloads_files', get_the_ID());
        foreach($filesField as $item) {
            $files[] = [
                'title' => $item['downloads_files_name'],
                'url'   => $item['downloads_files_file']['url'],
                'name'   => $item['downloads_files_file']['filename']
            ];
        }

        $downloads['files'] = $files;
    }
}

if(!empty(get_field('technical_drawings', get_the_ID()))) {
    $links['technical_drawings'] = __('Technische tekeningen', '_SBF');
    $drawings = [];

    foreach(get_field('technical_drawings', get_the_ID()) as $drawing) {
        $drawings[] = $drawing['technical_drawing']['ID'];
    }

    $technical_drawings = [
        'id' => 'technical_drawings',
        'title' => __('Technische tekeningen'),
        'drawings' => $drawings,
    ];
}

$ctaButtons = wpb_build_buttons_context([
    [
        'link' => [
            'url' => '#',
            'title' => __('Koop online', '_SBF'),
            'target' => '',
        ],
        'type' => 'btn--primary',
        'use_icon' => false,
    ],
    [
        'link' => [
            'url' => '#',
            'title' => __('Winkel in de buurt', '_SBF'),
            'target' => '',
        ],
        'type' => 'btn--secondary',
        'use_icon' => false,
    ]
]);

$slides = [];
if(!empty(get_field('images', get_the_ID()))) {
    $count = 1;
    $imagesField = get_field('images', get_the_ID());

    $images['highlighted_images'][] = get_post_thumbnail_id(get_the_ID());
    $images['highlighted_images_mobile'][] = get_post_thumbnail_id(get_the_ID());
    $images['images'][] = get_post_thumbnail_id(get_the_ID());
    
    foreach($imagesField as $image) {
        if($count <= 3) {
            $images['highlighted_images'][] = $image['images_image']['ID'];
        }
        if($count <= 1) {
            $images['highlighted_images_mobile'][] = $image['images_image']['ID'];
        }
        $images['images'][] = $image['images_image']['ID'];
        $count++;
    }
    if(count($imagesField) >= 3) {
        $images['more_images'] = true;
        $images['more_images_count'] = count($imagesField) - 3;
        $images['more_images_count_mobile'] = count($imagesField) - 1;
    }
    $images['arrow_selector'] =  get_template_directory_uri() . '/images/selector-arrow.svg';

    $slides = $images['images'];
}

$modal_highlight_swiper_options = [
    'slidesPerView' => 1,
    'spaceBetween'  => 0,
    'swipeDirection' => 'next',
    'navigation' => true,
    'breakpoints'   => [
        768 => [
            'slidesPerView' => 1,
            'spaceBetween' => 0,
        ],
    ],
];

get_header( 'shop' ); 
do_action( 'woocommerce_before_single_product' );









do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <?php
    do_action( 'woocommerce_before_add_to_cart_quantity' );

    woocommerce_quantity_input(
        array(
            'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
            'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
            'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
        )
    );

    do_action( 'woocommerce_after_add_to_cart_quantity' );
    ?>

    <button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

    <?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); 






Twig::render(
    'content/single-product.twig',
    Theme::filter(
        'index_context',
        [
            'product' => [
                'id' => get_the_ID(),
            ],
            'hero' => [
                'title'             => get_the_title(get_the_ID()),
                'safety_index'      => get_field("safety_index", get_the_ID()) ?? '',
                'product_image'     => get_post_thumbnail_id(get_the_ID()) ?? '',
                'article_number'    => get_field("article_number", get_the_ID()) ?? '',
                'price'             => wpb_build_price($product->get_regular_price()) ?? '',
                'keurmerken'        => wpb_build_keurmerken(get_the_ID(), 1),
                'bullet_points'     => $productData['short_description'] ?? '',
                'images'            => $images,
                'slides'            => $slides,
                'modal_highlight_swiper_options' => json_encode($modal_highlight_swiper_options),
                'buttons'           => $ctaButtons,
            ],
            'anchor_menu' => [
                'links'             => $links,
            ],
            'cta' => [
                'title'             => get_the_title(get_the_ID()),
                'article_number'    => get_field("article_number", get_the_ID()) ?? '',
                'buttons'           => $ctaButtons,
            ],
            'productinformation'    => $productinformation,
            'specifications'        => $specifications,
            'downloads'             => $downloads,
            'technical_drawings'    => $technical_drawings,
            'keurmerken'            => wpb_build_keurmerken(get_the_ID(), 1)
        ]
    )
);

do_action( 'woocommerce_after_single_product' );
get_footer( 'shop' ); 