<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<section class="section-padding background-warning">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="color-white margin-bottom-0"><?php woocommerce_page_title(); ?></h1>
				<?php endif; ?>				
			</div>
		</div>
	</div>
</section>
<section class="section-padding">
	<div class="container">
		<div class="row margin-bottom-30">
			<div class="col-sm-3 col-lg-2">				
				<button onclick="FWP.reset()" class="btn btn-primary btn-block">Clear All Filters</button>
			</div>
			<div class="col-sm-9 col-lg-10">
				<?php echo do_shortcode('[facetwp counts="true"]') ;?>
            	<?php echo do_shortcode('[facetwp sort="true"]') ;?>

			</div>
		</div>
		<div class="row">
			<div class="col-sm-3 col-lg-2 sidebar">
				<h6 class="tax-title">Diet Type</h6>
				<?php echo do_shortcode('[facetwp facet="product_type"]') ;?>
				<h6 class="tax-title">Categories</h6>
				<?php echo do_shortcode('[facetwp facet="product_categories"]') ;?>
				<h6 class="tax-title">Features</h6>
				<?php echo do_shortcode('[facetwp facet="tags"]') ;?>
			</div>
			<div class="col-sm-9 col-lg-10">
				<div class="row facetwp-template">					

					<?php if ( have_posts() ) : ?>

					<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>

					<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

						<?php wc_get_template( 'loop/no-products-found.php' ); ?>

					<?php endif; ?>

				</div>				
			</div>
		</div>
	</div>
</section>
<?php echo do_shortcode('[facetwp pager="true"]') ;?>
<?php echo do_shortcode('[facetwp per_page="true"]') ;?>
<script>
(function($) {
    $(function() {
        FWP.loading_handler = function() { }
    });
})(jQuery);
</script>





