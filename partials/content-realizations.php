<?php
/**
 * WPized Light: content-realizations
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
    <h1><?php the_title(); ?></h1>
    <div class="row realizations-page-relative">
      <div class="flexslider offer-page-categories realizations-page-list">
        <ul class="slides">
          <?php 
          $children = get_pages(array( 'child_of' => get_the_ID() )); 
          $chunked = array_chunk($children, 4);
          foreach( $chunked as $val ) :
          ?>
          <li class="realizations-page-list-slide">
            <?php foreach( $val as $item ) : ?>
            <div class="offer-page-categories--item col-xs-12 col-md-6 realizations-page-list--item">
              <a href="<?php echo get_permalink($item->ID); ?>" 
                 class="offer-page-categories--item-link realizations-page-list--item-link" 
                 style="background-image: url(<?php echo get_the_post_thumbnail_url($item->ID); ?>)">
                <div class="name"><span><?php echo $item->post_title; ?></span></div>
              </a>
            </div>
            <?php endforeach; ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="realizations-page-page-number"><?php _e('strona'); ?> <span class="realizations-page-page-number--text"></span></div>
    </div>
  </div>
</div>
<!-- / post -->
