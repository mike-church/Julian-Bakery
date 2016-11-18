<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();
$video = rwmb_meta( 'video_youtube_id' );

?>

<div class="hidden-xs" style="border-top:#ccc solid 1px;">

	<?php if ( ! empty( $video ) ) { ?>

		<div class="col-sm-4 col-md-3 margin-bottom-30">
			<img src="http://placehold.it/180x179" class="img-responsive">
		</div>

	<?php } ?>

	<?php if ( $attachment_ids ) {
		foreach ( $attachment_ids as $attachment_id ) {

			$classes = array( 'zoom' );
			$image_class = implode( ' ', $classes );
			$props = wc_get_product_attachment_props( $attachment_id, $post );

			if ( ! $props['url'] ) {
				continue;
			}

			echo apply_filters(
				'woocommerce_single_product_image_thumbnail_html',
				sprintf(
					'<div class="col-sm-4 col-md-3 margin-bottom-30"><a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a></div>',
					esc_url( $props['url'] ),
					esc_attr( $image_class ),
					esc_attr( $props['caption'] ),
					wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $props )
				),
				$attachment_id,
				$post->ID,
				esc_attr( $image_class )
			);
		} 
	} ?>
</div>




