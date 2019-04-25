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


<div id="post-<?php the_ID(); ?>" <?php post_class('product-page'); ?>>
  <div class="container">
    <h1 class="offer-page-header category-page-header"><?php _e('Tkanina'); ?> <span class="subcategory-name"><?php echo strtolower(the_title()); ?></span></h1>

    <div class="row">
      <div class="col-sm-12 col-md-6 col-lg-8">
        <?php 
        if (get_the_content()) { 
          the_content();
        } else {
          the_post_thumbnail('full', array( 'class' => 'img-responsive' ));  
        };
        ?>
      </div>
      <?php 
      $nazwa_kolekcji = get_field('nazwa_kolekcji');
      $gramatura = get_field('gramatura');
      $sklad = get_field('sklad');
      $szerokosc = get_field('szerokość');
      $scieralnosc = get_field('scieralnosc');
      $pilingi = get_field('pilingi');
      $utrata_koloru = get_field('utrata_koloru');
      $odpornosc_na_tarcie = get_field('odpornosc_na_tarcie');
      $certyfikat_antybakteryjny = get_field('certyfikat_antybakteryjny');
      if ($nazwa_kolekcji ||
          $gramatura ||
          $sklad ||
          $szerokosc ||
          $scieralnosc ||
          $pilingi ||
          $utrata_koloru ||
          $odpornosc_na_tarcie ||
          $certyfikat_antybakteryjny) : 
      ?>
      <div class="col-sm-12 col-md-6 col-lg-4 product-card">
        <div class="product-card-wrapper">
          <h3><?php _e('Karta Produktu'); ?></h3>
          <ul>
            <?php if ($nazwa_kolekcji) : ?>
            <li>
              <?php _e('Nazwa Kolekcji'); ?>: <strong><?php echo strtoupper($nazwa_kolekcji); ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($gramatura) : ?>
            <li>
              <?php _e('Gramatura'); ?>: <strong><?php echo $gramatura; ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($sklad) : ?>
            <li>
              <?php _e('Skład'); ?>: <strong><?php echo $sklad; ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($szerokosc) : ?>
            <li>
              <?php _e('Szerokość'); ?>: <strong><?php echo $szerokosc; ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($scieralnosc) : ?>
            <li>
              <?php _e('Ścieralność'); ?> <i><?php _e('Test Martindale'); ?></i>: <strong><?php echo $scieralnosc; ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($pilingi) : ?>
            <li>
              <?php _e('Pilingi'); ?>: <strong><?php echo $pilingi; ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($utrata_koloru) : ?>
            <li>
              <?php _e('Utrata koloru pod wpływem światła'); ?>: <strong><?php echo $utrata_koloru; ?></strong>
            </li>
            <?php endif; ?>
            <?php if ($odpornosc_na_tarcie) : ?>
            <li>
              <?php _e('Odporność na tarcie'); ?>: <strong><?php echo $odpornosc_na_tarcie; ?></strong>
            </li> 
            <?php endif; ?>
            <?php if ($certyfikat_antybakteryjny) : ?>
            <li>
              <?php _e('Certyfikat antybakteryjny'); ?>: <strong><?php echo $certyfikat_antybakteryjny; ?></strong>
            </li>        
            <?php endif; ?>
          </ul>
          <?php if (get_field('karta_produktu')) : ?>
          <a href="<?php echo the_field('karta_produktu'); ?>" class="product-card-pdf" target="_blank">
            <span class="icon-pdf"></span>
            <span><?php _e('Pobierz kartę produktu'); ?></span>
          </a>
          <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
    </div>

  </div>
</div>
<!-- / post -->
