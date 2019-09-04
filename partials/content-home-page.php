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
    <section class="home-page-section-promotion-event">
      <?php
      if ($promotion = get_field('strona-glowna-promocja')) : ?>
      <article class="home-page-section-promotion">
        <h1>Oferta tygodnia</h1>
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
  </div>
</div>
<!-- / post -->
