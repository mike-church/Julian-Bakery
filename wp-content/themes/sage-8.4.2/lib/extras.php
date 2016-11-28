<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/**
 * Woocommerce theme support
 */
add_action( 'after_setup_theme', __NAMESPACE__ . '\\woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', __NAMESPACE__ . '\\woocommerce_header_add_to_cart_fragment' );
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  ob_start();
  ?>
  <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"><?php echo WC()->cart->get_cart_total(); ?></a> 
  <?php
  
  $fragments['a.cart-contents'] = ob_get_clean();
  
  return $fragments;
}

// Custom Body Class
add_action( 'body_class', __NAMESPACE__ . '\\toggle_menu_body_class');
function toggle_menu_body_class( $classes ) {
  if ( is_page() || is_single() || is_home() || is_archive() )
    $classes[] = 'cbp-spmenu-push';
  return $classes;
}

add_action( 'init', __NAMESPACE__ . '\\shared_type', 0 );
function shared_type() {
  register_taxonomy(
    'type',
    array('product'),
    array(
      'labels' => array(
        'name' => 'Diet Type',
        'menu_name' => 'Diet',
        'add_new_item' => 'Add New',
        'new_item_name' => 'New Diet'
      ),
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
      'sort' => true,      
      'args' => array( 'orderby' => 'term_order' ),
      'show_admin_column' => false,
      'capabilities'=>array(
        'manage_terms' => 'manage_options',//or some other capability your clients don't have
        'edit_terms' => 'manage_options',
        'delete_terms' => 'manage_options',
        'assign_terms' =>'edit_posts'),
      'rewrite' => array('with_front' => false, 'slug' => 'diet'),
    )
  );
}

/**
 * Match Height
 */
function match_height( $atts ) {
  ob_start(); 
  ?>
  <script>jQuery(function(a){a(".match-height").matchHeight({byRow:!0})});</script>
  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('match-height', __NAMESPACE__ . '\\match_height');

/**
 * Add Load more results pagination to FacetWP
 */
function fwp_load_more() {
?>
<script>
(function($) {
    $(function() {
        if ('object' != typeof FWP) {
            return;
        }

        wp.hooks.addFilter('facetwp/template_html', function(resp, params) {
            if (FWP.is_load_more) {
                FWP.is_load_more = false;
                $('.facetwp-template').append(params.html);
                return true;
            }
            return resp;
        });

        $(document).on('click', '.fwp-load-more', function() {
            $('.fwp-load-more').html('Loading...');
            FWP.is_load_more = true;
            FWP.paged = parseInt(FWP.settings.pager.page) + 1;
            FWP.soft_refresh = true;
            FWP.refresh();
        });

        $(document).on('facetwp-loaded', function() {
            if (FWP.settings.pager.page < FWP.settings.pager.total_pages) {
                if (! FWP.loaded && 1 > $('.fwp-load-more').length) {
                    $('.facetwp-template').after('<div class="text-center padding-30"><button class="fwp-load-more btn btn-primary">Show more results</button></div>');
                }
                else {
                    $('.fwp-load-more').html('Show more results').show();
                }
            }
            else {
                $('.fwp-load-more').hide();
            }
        });
    });
})(jQuery);
</script>
<?php
}
add_action( 'wp_head', __NAMESPACE__ . '\\fwp_load_more', 99 );

/**
 * Adjust default per-page results
 */
add_filter( 'facetwp_per_page_options', function( $options ) {
    return array( 12, 24, 48, 100 );
});

/**
 * YouTube Modal
 */
function youtube_modal( $atts ) {
  ob_start(); 
  ?>

<!-- Video / Generic Modal -->
<div class="modal video-modal" id="mediaModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <button type="button" data-dismiss="modal"><i class="icon-close"></i></button>
      <div class="modal-body">
        <!-- content dynamically inserted -->
      </div>
    </div>
  </div>
</div>

<script>
// REQUIRED: Include "jQuery Query Parser" plugin here or before this point: 
// https://github.com/mattsnider/jquery-plugin-query-parser
 (function($){var pl=/\+/g,searchStrict=/([^&=]+)=+([^&]*)/g,searchTolerant=/([^&=]+)=?([^&]*)/g,decode=function(s){return decodeURIComponent(s.replace(pl," "));};$.parseQuery=function(query,options){var match,o={},opts=options||{},search=opts.tolerant?searchTolerant:searchStrict;if('?'===query.substring(0,1)){query=query.substring(1);}while(match=search.exec(query)){o[decode(match[1])]=decode(match[2]);}return o;};$.getQuery=function(options){return $.parseQuery(window.location.search,options);};$.fn.parseQuery=function(options){return $.parseQuery($(this).serialize(),options);};}(jQuery));

// YOUTUBE VIDEO CODE
jQuery(document).ready(function($){
  
// BOOTSTRAP 3.0 - Open YouTube Video Dynamicaly in Modal Window
// Modal Window for dynamically opening videos
$('a[href^="https://www.youtube.com"]').on('click', function(e){
  // Store the query string variables and values
  // Uses "jQuery Query Parser" plugin, to allow for various URL formats (could have extra parameters)
  var queryString = $(this).attr('href').slice( $(this).attr('href').indexOf('?') + 1);
  var queryVars = $.parseQuery( queryString );
 
  // if GET variable "v" exists. This is the Youtube Video ID
  if ( 'v' in queryVars )
  {
    // Prevent opening of external page
    e.preventDefault();
 
    // Variables for iFrame code. Width and height from data attributes, else use default.
    var vidWidth = 1280; // default
    var vidHeight = 720; // default
    if ( $(this).attr('data-width') ) { vidWidth = parseInt($(this).attr('data-width')); }
    if ( $(this).attr('data-height') ) { vidHeight =  parseInt($(this).attr('data-height')); }
    var iFrameCode = '<div class="container"><div class="row"><div class="col-sm-10 col-sm-offset-1"><div class="video-container"><iframe width="' + vidWidth + '" height="'+ vidHeight +'" scrolling="no" allowtransparency="true" allowfullscreen="true" src="https://www.youtube.com/embed/'+  queryVars['v'] +'?rel=0&wmode=transparent&showinfo=0&autoplay=0" frameborder="0"></iframe></div></div></div></div>';
 
    // Replace Modal HTML with iFrame Embed
    $('#mediaModal .modal-body').html(iFrameCode);

 
    // Open Modal
    $('#mediaModal').modal();
  }
});
 
// Clear modal contents on close. 
// There was mention of videos that kept playing in the background.
$('#mediaModal').on('hidden.bs.modal', function () {
  $('#mediaModal .modal-body').html('');
});
 
}); 
</script>


  <?php
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}
add_shortcode('youtube-modal', __NAMESPACE__ . '\\youtube_modal');
