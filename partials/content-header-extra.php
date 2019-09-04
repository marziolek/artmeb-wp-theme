<?php
/*
 * WPIzed Light: Nagłówek extra
 *
 * @package WordPress
 * @subpackage WPized_Light
 */

 /*


<div <?php post_class('header-extra'); ?>>
  <div class="container">
    <div class="header-extra-wrapper">
      <div class="fb-like" data-href="https://www.facebook.com/Artmeb-Tkaniny-Meblowe-473329152877834/" data-layout="button" data-action="like" data-show-faces="true" data-share="false"></div>
      <span class="header-extra-phones">
        <?php if (get_field('numer_telefonu_1')) : ?>
          <span class="icon-phone"></span>
          <span class="header-extra-phones--number"><?php the_field('numer_telefonu_1'); ?></span>
        <?php endif; ?>
        <?php if (get_field('numer_telefonu_2')) : ?>
          <span class="header-extra-phones--number"><?php the_field('numer_telefonu_2'); ?></span>
        <?php endif; ?>
      </span>
      <span class="header-extra-email">
        <span class="icon-email"></span>
        <span><?php the_field('e-mail'); ?></span>
      </span>
      <?php echo do_shortcode('[google-translator]'); ?>
    </div>
  </div>
</div>
<!-- / header extra -->
