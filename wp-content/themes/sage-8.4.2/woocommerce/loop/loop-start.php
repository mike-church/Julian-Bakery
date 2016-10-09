<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
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
?>
<section class="section-padding">
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-lg-2">
				<?php echo do_shortcode('[facetwp facet="product_type"]') ;?>
				<?php echo do_shortcode('[facetwp facet="product_categories"]') ;?>
			</div>
			<div class="col-sm-9 col-lg-10">
				<div class="row">


