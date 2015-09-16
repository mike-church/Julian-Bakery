<?php
/**
 * Template Name: Full Page Template
 */
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'full-page'); ?>
<?php endwhile; ?>
