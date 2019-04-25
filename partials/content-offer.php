<?php
/**
 * WPized Light: content-offer
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('offer-page'); ?>>
  <section class="offer-page-section">
    <div class="container">
      <?php if (is_category() || strpos(get_page_template(), 'single-offer')) : ?>
        <a href="#filtr" id="filter-anchor" class="filter-anchor">Dopasuj tkaninę do swoich potrzeb</a>
      <?php endif; ?>
      <h1 class="offer-page-header"><?php _e('Tkaniny'); ?></h1>
      <ul class="clearfix horizontal offer-page-categories">
        <?php
        $args = 'taxonomy=category&hide_empty=0&parent=0&cat_id=-1&exclude=1,8,12,16,20,63,104,106,108,110&posts_per_page=-1';
        $categories = get_categories($args);
        foreach ($categories as $cat) {
          if (!in_array($cat->cat_ID, array(1,63))) : 
          $catImg = category_image_src( array('term_id' => $cat->term_id ), false );
          $catImg = get_image_id_by_url($catImg);
          if ($catImg) {
            $catImgLarge = wp_get_attachment_image_src($catImg, 'large');
          };
        ?>
        <li class="offer-page-categories--item">
          <a href="<?php echo get_category_link($cat->term_id); ?>" class="offer-page-categories--item-link" style="background-image: url(<?php echo $catImgLarge[0]; ?>)">
            <div class="name"><span><?php echo $cat->name; ?></span></div>
          </a>
        </li>
        <?php 
          endif;
        };
        ?>
      </ul>
    </div>
  </section>
</div>
<!-- / post -->
