
<?php
/**
 * WPized Light: content-realization
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('realizations-page'); ?>>
  <div class="container">
    <h1><?php _e('Realizacje'); ?> <span class="subcategory-name"><?php if ($collection = get_field('nazwa_kolekcji')) { echo $collection; } ?></span></h1>
    <div class="row">
      <div class="col-xs-12 col-sm-9 col-md-8 realizations-page-slider-wrapper">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>
<!-- / post -->
