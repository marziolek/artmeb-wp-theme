<?php
/*
 * Template Name: Realizacje
 *
 * WPIzed Light: Post
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
get_header();
the_post();
?>

<?php get_template_part( 'partials/content-realizations' ); ?>

<?php ; ?>
<?php 
wp_enqueue_style('flexslider', plugins_url() . '/ml-slider/assets/sliders/flexslider/flexslider.css');
wp_enqueue_script('flexslider', plugins_url() . '/ml-slider/assets/sliders/flexslider/jquery.flexslider-min.js');
get_footer();