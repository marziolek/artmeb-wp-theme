<?php
/**
 * WPized Light: content-single
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="container">
    <h1><?php the_title(); ?></h1>

    <?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>

    <div class="content"> <?php the_content(); ?></div>
  </div>
</div>
<!-- / post -->
