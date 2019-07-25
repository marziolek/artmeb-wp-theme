<?php
/**
 * WPized Light: content-about
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('about-page'); ?>>
  <div class="container">
    <?php the_content(); ?>
  </div>
</div>
<!-- / post -->
