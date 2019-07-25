<?php
/**
 * WPized Light: content-contact
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('contact-page'); ?>>
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-8">
        <div class="row">
          <div class="col-md-5 contact-page__left">
            <?php if ($contactTitle = get_field('naglowek')) : ?>
              <h1><?php echo $contactTitle; ?></h1>
            <?php endif; ?>
            <?php if ($contactCompany = get_field('nazwa_firmy')) : ?>
              <p><?php echo $contactCompany; ?></p>
            <?php endif; ?>
            <?php if ($contactCompanyA = get_field('adres_firmy')) : ?>
              <p><?php echo $contactCompanyA; ?></p>
            <?php endif; ?>
            <?php if ($contactCompanyT = get_field('telefon_fax')) : ?>
              <p class="contact-page-phones"><?php echo $contactCompanyT; ?></p>
            <?php endif; ?>
            <?php if ($contactCompanyW = get_field('strona_internetowa')) : ?>
              <p><a href="<?php echo $contactCompanyW; ?>"><?php echo $contactCompanyW; ?></a></p>
            <?php endif; ?>
            <?php if ($contactCompanyE = get_field('email')) : ?>
              <p><a href="mailto:<?php echo $contactCompanyE; ?>"><?php echo $contactCompanyE; ?></a></p>
            <?php endif; ?>
            <h1 class="localization-title"><?php _e('Lokalizacja'); ?></h1>
            <img src="<?php echo get_template_directory_uri(); ?>/images/pages/map.jpg" alt="mapa" class="contact-map">
          </div>
          <?php if ($contactForm = get_field('formularz_kontaktowy')) : ?>
            <div class="col-md-7">
              <h1><?php _e('Formularz kontaktowy'); ?></h1>
              <?php echo do_shortcode($contactForm); ?>
            </div>
          <?php endif; ?>
          <div class="col-xs-12">
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / post -->
