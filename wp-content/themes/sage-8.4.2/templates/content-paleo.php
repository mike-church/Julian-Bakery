<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<button onclick="FWP.reset()" class="facetwp-reset">Reset</button>
			<?php echo do_shortcode('[facetwp facet="product_categories"]') ;?>
			<?php echo do_shortcode('[facetwp facet="tags"]') ;?>
			
		</div>
		<div class="col-sm-8">
			<?php echo do_shortcode('[facetwp template="paleo"]') ;?> 
		</div>
	</div>
</div>
