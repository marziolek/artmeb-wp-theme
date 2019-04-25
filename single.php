<?php
/*
 * WPIzed Light: Post
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
get_header();
the_post();
?>
<?php 
if (is_single()) {
  get_template_part( 'partials/content-product' ); 
} else {
  get_template_part( 'partials/content', get_post_format() ); 
}
?>

<?php ; ?>
<?php get_footer();
