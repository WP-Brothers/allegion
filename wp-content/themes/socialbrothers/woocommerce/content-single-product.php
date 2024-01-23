<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */


use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>

    <?php
    /**
     * Hook: woocommerce_before_single_product_summary.
     *
     * @hooked woocommerce_show_product_sale_flash - 10
     * @hooked woocommerce_show_product_images - 20
     */
    // do_action( 'woocommerce_before_single_product_summary' );

    $images = [];
    $slides = [];
    $ctaButtons = [];
    $modal_highlight_swiper_options = '';

    Twig::render(
        'organisms/single-product-hero.twig',
        Theme::filter(
            'index_context',
            [
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
            ]
        )
    );


    dump($product);
    if (!$product->is_purchasable()) {
        return;
    }

    echo wc_get_stock_html($product); // WPCS: XSS ok.

    if ($product->is_in_stock()) : ?>

        <?php do_action('woocommerce_before_add_to_cart_form'); ?>

        <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
            <?php do_action('woocommerce_before_add_to_cart_button'); ?>

            <?php
            do_action('woocommerce_before_add_to_cart_quantity');

            woocommerce_quantity_input(
                array(
                    'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
                    'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
                    'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
                )
            );

            do_action('woocommerce_after_add_to_cart_quantity');
            ?>

            <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

            <?php do_action('woocommerce_after_add_to_cart_button'); ?>
        </form>

        <?php do_action('woocommerce_after_add_to_cart_form'); ?>

    <?php else : ?>
        <p class="stock out-of-stock"><?php esc_html_e('This product is currently out of stock and unavailable.', 'woocommerce'); ?></p>
    <?php endif; ?>

</div>

<?php do_action('woocommerce_after_single_product'); ?>