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

function woocommerce_template_loop_rating(){ }

