<?php

function woocommerce_template_loop_product_thumbnail(){  
  if ( has_post_thumbnail() ) { ?>
      <img src="<?php the_post_thumbnail_url( 'medium' );?>" class="img-responsive" >
    <?php
  }
}

function woocommerce_template_loop_product_title(){ ?>
		<h5 class="text-center"><?php echo the_title(); ?></h5> 
	<?php
}

function woocommerce_template_loop_rating(){ }

