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

defined( 'ABSPATH' ) || exit;

use SocialBrothers\Theme\Helper\Theme;
use SocialBrothers\Theme\Helper\Twig;

global $product;
$links = [];
$productinformation = [];
$specifications = [];
$downloads = [];
$technical_drawings = [];
$images = [];

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

// dd($product->get_price());
$add_to_cart = apply_filters( 'woocommerce_loop_add_to_cart_link',
sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="btn %s product_type_%s">%s</a>',
	esc_url( $product->add_to_cart_url() ),
	esc_attr( $product->get_id() ),
	esc_attr( $product->get_sku() ),
	$product->is_purchasable() ? 'add_to_cart_button' : '',
	esc_attr( $product->get_type() ),
	esc_html( $product->add_to_cart_text() )
),
$product );

$allow_buy = get_field('allow_buy', 'options');


if(!empty($product->get_description())) {
    $links['productinformation'] = __('Productinformatie', '_SBF');
    $productinformation = [
        'id' => 'productinformation',
        'title' => __('Product informatie'),
        'content' => $product->get_description(),
    ];
}

if(!empty(get_field('specifications_text', get_the_ID())) || !empty(get_field('specifications_safety', get_the_ID())) || !empty(get_field('specifications_technical', get_the_ID())) ) {
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


if(!empty($product->get_gallery_image_ids())) {
    $count = 1;
    $imagesField = $product->get_gallery_image_ids();

    $images['highlighted_images'][] = get_post_thumbnail_id(get_the_ID());
    $images['images'][] = get_post_thumbnail_id(get_the_ID());
    
    foreach($imagesField as $image) {
        if($count <= 3) {
            $images['highlighted_images'][] = $image;
        }
        $images['images'][] = $image;
        $count++;
    }
    if(count($imagesField) >= 3) {
        $images['more_images'] = true;
        $images['more_images_count'] = count($imagesField) - 3;
    }
    $images['arrow_selector'] =  get_template_directory_uri() . '/images/selector-arrow.svg';

    $slides = $images['images'];
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

?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
<?php
	Twig::render(
		'organisms/single-product-hero.twig',
		Theme::filter(
			'index_context',
			[

					'title'             => get_the_title(get_the_ID()),
					'safety_index'      => get_field("safety_index", get_the_ID()) ?? '',
					'product_image'     => get_post_thumbnail_id(get_the_ID()) ?? '',
					'article_number'    => $product->get_sku() ?? '',
					'price'             => get_woocommerce_currency_symbol() . $product->get_price() ?? '',
					'keurmerken'        => wpb_build_keurmerken(get_the_ID(), 1),
					'bullet_points'     => $product->get_short_description() ?? '',
					'images'            => $images ?? '',
					'slides'            => $slides ?? '',
					'modal_highlight_swiper_options' => json_encode($modal_highlight_swiper_options ?? '') ,
			]
		)
	);
	Twig::render(
		'molecules/anchor-menu.twig',
		Theme::filter(
			'index_context',
			[
				'links' => $links,
			]
		)
	);
?>

<section class="pt-10 pb-20 section">
		<div class="container">
			<div class="flex flex-col w-full lg:justify-between lg:flex-row">
				<div class="w-full lg:w-1/2">

					<?php if(!empty($productinformation['content'])): ?>
						<div id="<?= $productinformation['id']; ?>" class="pb-5">
							<?php if(!empty($productinformation['title'])): ?>
								<h3><?= $productinformation['title']; ?></h3>
							<?php endif; ?>
							<?php if(!empty($productinformation['content'])): ?>
								<div><?= do_shortcode($productinformation['content']); ?></div>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<?php if(!empty($specifications['content'] || !empty($specifications['safety']) || !empty($specifications['technical']))): ?>
						<div id="<?= $specifications['id']; ?>" class="py-5">
							<?php if(!empty($specifications['title'])): ?>
								<h3><?= $specifications['title']; ?></h3>
							<?php endif; ?>
							
							<?php if(!empty($specifications['content'])): ?>
								<div><?= do_shortcode($specifications['content']); ?></div>
							<?php endif; ?>


							<?php if(!empty($specifications['safety'])){
								Twig::render(
									'molecules/table.twig',
									Theme::filter(
										'index_context',
										[
											'title' => __('Veiligheidsinformatie', '_SBF'),
											'array' => $specifications['safety'],
											'class' => 'mb-6',
										]
									)
								);
							} ?>

							<?php if(!empty($specifications['technical'])){
								Twig::render(
									'molecules/table.twig',
									Theme::filter(
										'index_context',
										[
											'title' => __('Technische informatie', '_SBF'),
											'array' => $specifications['technical'],
										]
									)
								);
							} ?>
						
					
						</div>
					<?php endif; ?>

					<?php if(!empty($downloads['content']) || !empty($downloads['files'])): ?>
						<div id="<?= $downloads['id']; ?>" class="py-5">

							<?php if(!empty($downloads['title'])): ?>
								<h3><?= $downloads['title']; ?></h3>
							<?php endif; ?>
							
							<?php if(!empty($downloads['content'])): ?>
								<div class="mb-6"><?= do_shortcode($downloads['content']); ?></div>
							<?php endif; ?>


							<?php if(!empty($downloads['files'])): ?>
								<?php foreach($downloads['files'] as $item){
									Twig::render(
										'atoms/download.twig',
										Theme::filter(
											'index_context',
											[
												'title' => $item['title'],
												'name' => $item['name'],
												'url' => $item['url'],
											]
										)
									);
								}?>
							<?php endif; ?>

						</div>
					<?php endif; ?>

					<?php if(!empty($technical_drawings['drawings'])): ?>
						<div id="<?= $technical_drawings['id']; ?>" class="py-5">
							<?php if(!empty($technical_drawings['title'])): ?>
								<h3><?= $technical_drawings['title']; ?></h3>
							<?php endif; ?>
							
							
							<div class="flex flex-row gap-6 mt-4 flex-wrap">
								<?php foreach($technical_drawings['drawings'] as $drawing): ?>
									<div class="contains-modal">
										<div data-modal-open="modal-open">
											<?php
												Twig::render(
													'atoms/image.twig',
													Theme::filter(
														'index_context',
														[
															'image_id' => $drawing,
															'image_classes' => 'w-20 h-20 rounded-[4px] hover:border-[1px] border-secondary cursor-pointer'
														]
													)
												);
											?>
										</div>	
										<?php
											Twig::render(
												'molecules/dialog.twig',
												Theme::filter(
													'index_context',
													[
														'image_model_id' => $drawing,
													]
												)
											);
										?>
									</div>
								<?php endforeach; ?>
							</div>

						</div>
					<?php endif; ?>

				
				</div>

				<div class="w-full lg:w-5/12">
					<?php 
						Twig::render(
							'molecules/product-single-cta.twig',
							Theme::filter(
								'index_context',
								[
									'article_number' => $product->get_sku(),
									'title' => get_the_title(get_the_ID()),
									'buttons' => $ctaButtons,
									'shop_settings' => [
										'add_to_cart' 		=> $add_to_cart,
										'allow_buy'			=> $allow_buy
									],
								]
							)
						);
					// {% include "molecules/product-single-cta.twig" with cta %} ?>
				</div>
			</div>
		</div>
	</section>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>
