<?php
/**
 * WPized Light: content-category
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<li id="post-<?php echo $subcategory->term_id; ?>" class="category-page-list--item">
  <?php 
  $catImg = category_image_src( array('term_id' => $subcategory->term_id ), false ); 
  $catImg = get_image_id_by_url($catImg);
  if ($catImg) {
    $catImgLarge = wp_get_attachment_image_src($catImg, 'large');
  };
  ?>

  <a href="<?php echo get_category_link($subcategory->term_id); ?>" class="square-material-item" <?php if ( $catImg ) : ?>style="background-image: url(<?php echo $catImgLarge[0]; ?>)"<?php endif; ?>>
    <div class="square-material-item-gradient"></div>
    <div class="square-material-item-name"><span><?php echo $subcategory->name; ?></span></div>
  </a>

</li>
<!-- / post -->
