<?php
/*
 * The template for displaying Category pages
 *
 * WPIzed Light: Category
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
get_header();
the_post();

global $wpdb;
?>

<div class="offer-page">
  <?php $category = get_category($cat); ?>
  <section class="offer-page-section category-page <?php if (($category->parent) != 0) : ?>bg-fixed<?php endif; ?>">
    <div class="container">
      <?php if (is_category() || strpos(get_page_template(), 'single-offer')) : ?>
      <a href="#filtr" id="filter-anchor" class="filter-anchor">Dopasuj tkaninę do swoich potrzeb</a>
      <?php endif; ?>
      <?php 
      if (($category->parent) == 0) {
      ?>
      <h1 class="offer-page-header category-page-header">Tkaniny <?php echo strtolower($category->name); ?></h1>
      <ul class="category-page-list">
        <?php
        $subcategories = get_terms( 
          'category',
          array(
            'show_option_all'    => '',
            'orderby'            => 'name',
            'order'              => 'ASC',
            'style'              => 'list',
            'show_count'         => 0,
            'hide_empty'         => 0,
            'use_desc_for_title' => 1,
            'child_of'           => $category->cat_ID,
            'feed'               => '',
            'feed_type'          => '',
            'feed_image'         => '',
            'exclude'            => '',
            'exclude_tree'       => '',
            'include'            => '',
            'hierarchical'       => 1,
            'title_li'           => __( 'Categories' ),
            'show_option_none'   => __( '' ),
            'number'             => null,
            'echo'               => 1,
            'depth'              => 0,
            'current_category'   => 0,
            'pad_counts'         => 0,
            'taxonomy'           => 'category',
            'walker'             => null
          )
        );

        $pictograms = array('relation' => 'OR');

        $keywords = array('cat', 'lang', 'page_id'); 

        if (isset($_POST) && (sizeof($_POST) > 0)) {
          $postFilterData = $_POST;
          $_SESSION['post_data'] = $_POST;
        } elseif (isset($_SESSION['post_data'])) {
          $postFilterData = $_SESSION['post_data'];
        };

        if ($postFilterData['clearFilters'] == 'false') {
          foreach ($postFilterData as $key => $status) {
            if (!in_array($key, $keywords)) {
              $picto = array(
                'key'     => 'piktogramy',
                'value'   => $key,
                'compare' => 'LIKE'
              );
              array_push($pictograms, $picto);
            };
          };
        };

        // Start the Loop.
        foreach ( $subcategories as $subcategory ) :

        $subcategoryArgs = array(
          'posts_per_page' => -1, 
          'numberposts'=> -1,
          'category' => $subcategory->term_id,
          'meta_query' => $pictograms
        );

        if (sizeof($pictograms) > 1) {
          $postsFromSubcat = get_posts( $subcategoryArgs );
          foreach ( $postsFromSubcat as $posts ) {
            $category = get_the_category($posts->ID);
            if ($category[0]->parent !== 0) {
              set_query_var('subcategory', $subcategory);
              get_template_part( 'partials/content-category' );
              break;
            }
          };
        } else {
          $postsFromSubcat = get_posts( $subcategoryArgs );
          foreach ( $postsFromSubcat as $posts ) {
            set_query_var('subcategory', $subcategory);
            get_template_part( 'partials/content-category' );
            break;
          };
        }
        wp_reset_postdata();

        endforeach;
      } else {

        wp_enqueue_style('lightbox', '/wp-content/themes/wpized-light-master/stylesheets/lightbox.min.css');
        wp_enqueue_script('lightbox', '/wp-content/themes/wpized-light-master/javascript/lightbox.min.js');

        if (function_exists('get_all_terms_meta')) {
          $obrazWyrozniajacy = get_terms_meta($category->cat_ID, 'obraz-wyrozniajacy');
          $gramatura = get_terms_meta($category->cat_ID, 'gramatura');
          $certyfikatAntybakteryjny = get_terms_meta($category->cat_ID, 'certyfikat-antybakteryjny');
          $odpornoscNaTarcie = get_terms_meta($category->cat_ID, 'odpornosc-na-tarcie');
          $pilingi = get_terms_meta($category->cat_ID, 'pilingi');
          $scieralnosc = get_terms_meta($category->cat_ID, 'scieralnosc');
          $sklad = get_terms_meta($category->cat_ID, 'sklad');
          $szerokosc = get_terms_meta($category->cat_ID, 'szerokosc');
          $utrataKoloru = get_terms_meta($category->cat_ID, 'utrata-koloru');
          $pdf = get_terms_meta($category->cat_ID, 'pdf');
        };
        ?>
        <h1 class="offer-page-header category-page-header"><?php _e('Tkanina'); ?> <span class="subcategory-name"><?php echo strtolower($category->name); ?></span></h1>
        <div class="row">
          <div class="col-sm-12 col-md-7 col-lg-8">
            <?php if ($obrazWyrozniajacy[0]) : ?>
            <img src="<?php echo $obrazWyrozniajacy[0]; ?>" alt="image" class="img-responsive">
            <?php endif; ?>
            <?php 
        $matchingCollections = array(); 
        $pictograms = array();
            ?>
            <ul class="category-page-list category-page-list--subcategory">
              <?php
        query_posts('cat='.$category->cat_ID.'&posts_per_page=-1&orderby=title&order=ASC');
        if ( have_posts() ) : while ( have_posts() ) : the_post();?>

              <?php get_template_part( 'partials/content-subcategory' ); ?>

              <?php 
        if ($matchingCollection = get_field('matching_collection')) { 
          array_push($matchingCollections, $matchingCollection);
        };

        if ($pictogramsItem = get_field('piktogramy')) { 
          foreach($pictogramsItem as $pictogramSingle ) {
            array_push($pictograms, $pictogramSingle); 
          };
        };
              ?>

              <?php
        endwhile; endif;
        wp_reset_query();
              ?>
            </ul>
          </div>
          <div class="col-sm-12 col-md-5 col-lg-4 product-card">
            <div class="product-card-wrapper <?php if (!$pdf) { echo 'no-pdf'; } ?>">
              <h3><?php _e('Karta Produktu'); ?></h3>
              <ul>
                <li>
                  <?php _e('Nazwa Kolekcji'); ?>: <strong><?php echo strtoupper($category->name); ?></strong>
                </li>
                <li>
                  <?php _e('Gramatura'); ?>: <strong><?php echo $gramatura[0]; ?></strong>
                </li>
                <li>
                  <?php _e('Skład'); ?>: <strong><?php echo $sklad[0]; ?></strong>
                </li>
                <li>
                  <?php _e('Szerokość'); ?>: <strong><?php echo $szerokosc[0]; ?></strong>
                </li>
                <li>
                  <?php _e('Ścieralność'); ?> <i><?php _e('Test Martindale'); ?></i>: <strong><?php echo $scieralnosc[0]; ?></strong>
                </li>
                <li>
                  <?php _e('Pilingi'); ?>: <strong><?php echo $pilingi[0]; ?></strong>
                </li>
                <li>
                  <?php _e('Utrata koloru pod wpływem światła'); ?>: <strong><?php echo $utrataKoloru[0]; ?></strong>
                </li>
                <li>
                  <?php _e('Odporność na tarcie'); ?>: <strong><?php echo $odpornoscNaTarcie[0]; ?></strong>
                </li>    
                <li>
                  <?php _e('Certyfikat antybakteryjny'); ?>: <strong><?php echo $certyfikatAntybakteryjny[0]; ?></strong>
                </li>        
              </ul>
              <?php if ($pdf) : ?>
              <a href="<?php echo $pdf[0]; ?>" class="product-card-pdf" target="_blank">
                <span class="icon-pdf"></span>
                <span><?php _e('Pobierz kartę produktu'); ?></span>
              </a>
              <?php endif; ?>
            </div>
            <?php

        if ($pictograms) : 
            ?>
            <div class="offer-page-pictograms">
              <ul class="footer-pictograms-list footer-pictograms-list-sidebar">
                <?php 
        foreach(array_unique($pictograms) as $pictogram) : 
                ?>

                <li class="footer-pictograms-item footer-pictograms-item-sidebar">
                  <span class="pictograms-<?php echo $pictogram; ?>"></span>
                </li>

                <?php endforeach; ?>
                <li class="footer-pictograms-item footer-pictograms-item-sidebar fake"></li>
                <li class="footer-pictograms-item footer-pictograms-item-sidebar fake"></li>
                <li class="footer-pictograms-item footer-pictograms-item-sidebar fake"></li>
                <li class="footer-pictograms-item footer-pictograms-item-sidebar fake"></li>
              </ul>
            </div>
            <?php endif; ?>
            <?php if (sizeof($matchingCollections) > 0) : ?>
            <div class="offer-page-matching-collections">
              <h3><?php _e('Pasuje z:'); ?></h3>
              <ul>
                <?php foreach($matchingCollections[0] as $col) : ?>

                <li id="post-<?php echo $col->term_id; ?>" class="category-page-list--item">
                  <a href="<?php echo get_term_link($col->term_id); ?>" class="square-material-item" style="background-image: url(<?php echo category_image_src( array('term_id' => $col->term_id ), false ); ?>)">
                    <div class="square-material-item-gradient"></div>
                    <div class="square-material-item-name"><span><?php echo $col->name; ?></span></div>
                  </a>
                </li>

                <?php endforeach; ?>
                <li class="category-page-list--item fake"></li>
                <li class="category-page-list--item fake"></li>
                <li class="category-page-list--item fake"></li>
                <li class="category-page-list--item fake"></li>
              </ul>
            </div>
            <?php endif; ?>
          </div>
        </div>
        <?php }; ?>
        </div>
      </section>
    </div>

  <?php ; ?>
  <?php get_footer();