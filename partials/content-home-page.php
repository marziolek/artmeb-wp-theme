<?php
/**
 * WPized Light: content-home-page
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('home-page'); ?>>
  <div class="container wide">
    <?php the_content(); ?>
  </div>
  <div class="container">
    <section  class="home-page-section-polecane">
      <?php if (get_field('strona-glowna-slider-polecane')) : ?>
      <h1><?php if (get_field('strona-glowna-naglowek-polecane')) { the_field('strona-glowna-naglowek-polecane'); } ?></h1>
      <div class="home-page-recommended">
        <div class="flexslider home-page-recommended-slider" id="polecane-tkaniny">
          <ul class="slides">

            <?php
            //$polecane = new WP_Query(array ( 'cat_id' => $lang_cat_id, 'posts_per_page' => -1 ));
            //$polecane = new WP_Query(array ( 'category_name' => 'Polecane', 'posts_per_page' => -1 ));
            $polecane = get_posts(array(
              'category' => 63, 
              'posts_per_page' => -1
            ));


            //while ($polecane->have_posts()) : $polecane->the_post();
            foreach($polecane as $pol) {

              $categories = wp_get_post_categories($pol->ID); 
              
              foreach($categories as $cats) {
                $cat = get_category($cats);
                $parentCatId = $cat->parent;
                if ($parentCatId) {
                  $catImg = category_image_src( array('term_id' => $cat->term_id ), false );
                  if ($catImg) : ?>

            <li>
              <a href="<?php echo get_category_link($cat->term_id) ?>" class="square-material-item">
                <img src="<?php echo $catImg; ?>" alt="<?php echo $parentCategory ?>" class="img-responsive">
                <div class="square-material-item-gradient"></div>
                <div class="square-material-item-name"><span><?php echo $cat->name; ?></span></div>
              </a>
            </li>

            <?php 
                  endif;
                  break;
                };
              };
            }
            ?>
          </ul>
        </div>
      </div>
      <?php 
      endif; 
      wp_reset_postdata();
      ?>
    </section>
    <section class="home-page-section-promotion-event">
      <?php
      if ($promotion = get_field('strona-glowna-promocja')) : ?>
      <article class="home-page-section-promotion">
        <h1>Promocja</h1>
        <?php echo $promotion; ?>      
      </article>
      <?php endif; ?>
      <?php
      if ($upcomingEvent = get_field('strona-glowna-event')) : ?>
      <article class="home-page-section-event">
        <h1>Najbliższe wydarzenie</h1>
        <?php echo $upcomingEvent; ?>      
      </article>
      <?php endif; ?>
    </section>
    <section class="home-page-section-cleanaboo">
      <h1><?php if (get_field('strona-glowna-naglowek')) { the_field('strona-glowna-naglowek'); } ?></h1>
      <div class="clearfix home-page-section-cleanaboo--content">
        <?php 
        $home_page_obraz = get_field('strona-glowna-obraz');
        if ($home_page_obraz) : ?>
        <img src="<?php echo $home_page_obraz['url']; ?>" 
             width="<?php echo $home_page_obraz['width']; ?>"
             height="<?php echo $home_page_obraz['height']; ?>"
             class="img-responsive home-page-image">
        <?php endif; ?>
        <div class="home-page-text">
          <?php if (get_field('strona-glowna-tekst')) { the_field('strona-glowna-tekst'); } ?>
        </div>
      </div>
    </section>
  </div>
</div>
<!-- / post -->
