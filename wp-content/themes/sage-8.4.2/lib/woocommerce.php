<?php

function woocommerce_template_loop_product_thumbnail(){  
  if ( has_post_thumbnail() ) { ?>
  <div class="thumb-wrapper">
      <div class="thumb" style="background-image:url(<?php the_post_thumbnail_url( 'medium' );?>);"></div>
  </div>
    <?php
  }
}

function woocommerce_template_loop_product_title(){ ?>
		<h5><?php echo the_title(); ?></h5> 
	<?php
}

function woocommerce_template_loop_rating(){}
function woocommerce_template_loop_add_to_cart(){}
function woocommerce_review_display_gravatar(){}

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_home_text' );
function jk_change_breadcrumb_home_text( $defaults ) {
    // Change the breadcrumb home text from 'Home' to 'Shop'
	$defaults['home'] = 'Shop';
	return $defaults;
}

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    return '/shop';
}