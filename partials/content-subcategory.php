<?php
/**
 * WPized Light: content-subcategory
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>
<li id="post-<?php the_ID(); ?>" class="category-page-list--item">

  <a href="<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail_url(); ?><?php endif; ?>" class="square-material-item" <?php if ( has_post_thumbnail() ) : ?>style="background-image: url(<?php the_post_thumbnail_url(); ?>)"<?php endif; ?> data-lightbox="lightbox-<?php the_ID(); ?>">
    <div class="square-material-item-gradient"></div>
    <div class="square-material-item-name"><span><?php the_title(); ?></span></div>
  </a>

  <?php
  preg_match_all('/<img[^>]+>/i',get_the_content(), $result); 
  foreach($result as $imgs) { 
    foreach($imgs as $img) {
      preg_match_all('/(src)=("[^"]*")/i',$img, $src);
      ?>
      <a href=<?php echo $src[2][0]; ?> data-lightbox="lightbox-<?php the_ID(); ?>" class="hide"></a>
      <?php
    }
  }
  ?>

</li>
<!-- / post -->
