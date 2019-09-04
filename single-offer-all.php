<?php
/*
 * Template Name: Oferta wszystko
 *
 * WPIzed Light: Post
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
add_filter('body_class', 'multisite_body_classes');

function multisite_body_classes($classes) {
      $classes[] = 'archive woocommerce';
      return $classes;
}

get_header();
the_post();
?>

<?php get_template_part( 'partials/content-offer-all' ); ?>
<?php get_footer();