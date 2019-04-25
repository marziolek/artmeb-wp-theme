<?php
/**
 * WPized Light: content-visualization
 *
 * The template for displaying content after all other content-{template} files
 * were either not used or not found, see:
 * http://codex.wordpress.org/Function_Reference/get_template_part
 *
 * @package WordPress
 * @subpackage WPized_Light
 */

$threeD = get_template_directory_uri() . '/3D/';
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('visualization-page'); ?>>
  <div class="container">
    <h1><?php the_title(); ?></h1>
    <?php
    if (!get_the_content()) {
    ?>
    <div class="flex">
      <div class="flex-item-250">
        <ul class="visualization-page-list materials">
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
          <li class="visualization-page-list--item">
            <button type="button" class="visualization-page-list--item-button" style="background-image: url(<?php echo $catImgLarge[0]; ?>)"><?php echo $cat->name; ?></button>
            <div class="visualization-page-list--item-content">
              <?php
            $category = get_category($cat->cat_ID);
            if (($category->parent) == 0) {
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

              foreach ($subcategories as $subcat) { 
              ?>
              <div class="visualization-page-list--item-subcat">
                <button type="button" class="visualization-page-list--item-button visualization-page-list--item-subcat-button"><?php echo $subcat->name; ?></button>
                <div class="visualization-page-list--item-subcat-content">
                  <?php
                $args = array(
                  'posts_per_page'   => 3,
                  'offset'           => 0,
                  'cat'              => $subcat->term_id,
                  'orderby'          => 'name',
                  'order'            => 'ASC',
                  'post_type'        => 'post',
                  'post_status'      => 'publish',
                  'suppress_filters' => true,
                  'paged'            => 0,
                  'meta_query'	=> array(
                    array(
                      'key'		=> 'tkanina_3d',
                      'value'		=> '^',
                      'compare'	=> 'REGEXP'
                    )
                  )
                );
                $loop = new WP_Query($args);

                if ($loop -> have_posts()) :
                  while ( $loop->have_posts() ) : $loop->the_post();
                    $material3d = get_field('tkanina_3d');
                    if ($material3d) :
                      ?>
                      <?php 
                      $materialFlat = wp_get_attachment_image_src($material3d, 'full'); 
                      $materialFlatSmall = wp_get_attachment_image_src($material3d, 'thumbnail'); 
                      ?>
                        <div class="visualization-page-material" data-image="<?php echo $materialFlat[0]; ?>" title="<?php echo strtoupper(get_the_title()); ?>" style="background-image: url(<?php echo $materialFlatSmall[0]; ?>)"></div>
                        <?php
                    endif;
                  endwhile;
                else : echo '<div class="no-materials"></div>';
                endif;
                wp_reset_postdata();
                wp_reset_query();
                  ?>
                  <div class="visualization-page-material fake"></div>
                  <div class="visualization-page-material fake"></div>
                  <div class="visualization-page-material fake"></div>
                  <button type="button" class="visualization-page-material--load-more" data-cat="<?php echo $subcat->term_id; ?>">
                    Więcej
                    <span></span>
                  </button>
                </div>
              </div>
              <?php
              };
            };
              ?>
            </div>
          </li>
          <?php 
            endif;
          };
          ?>
        </ul>
      </div>
      <div class="flex-item model3d">
        <div id="progress-indicator" class="progress-indicator"><span class="text"></span><span class="loader"></span></div>
        <div class="model3d-info">
          <label for="input-full-object">
            <span>Zaznaczanie pojedynczych elementów</span>
            <input id="input-full-object" type="checkbox"/>
            <span class="custom-checkbox"></span>
          </label>
        </div>
        <div class="model3d-zoom">
          <button class="js-zoom-in">+</button>
          <button class="js-zoom-out">-</button>
        </div>
        <div id="model3d" class="canvas-wrapper" data-model-current="fotel"></div>
        <div class="model3d-information">
          <span>i</span>
          <div class="content">
            <p><?php _e('Aby obrócić model kliknij i przeciągnij gdziekolwiek dookoła mebla.');?></p>
            <p><?php _e('Aby przybliżyć/oddalić model użyj przycisków +/- z prawej strony.');?></p>
            <p><?php _e('Aby wybrać poszczególne elementy mebla, po prostu kliknij je.');?></p>
          </div>
        </div>
        <div class="model3d-switch">
          <button class="model3d-switch-item model3d-switch-fotel active" style="background-image: url(<?php echo $threeD . 'img/fotel.png'; ?>)" data-model="fotel"></button>
          <button class="model3d-switch-item model3d-switch-sofa" style="background-image: url(<?php echo $threeD . 'img/sofa2os.png'; ?>)" data-model="sofa2os"></button>
          <button class="model3d-switch-item model3d-switch-sofa-big" style="background-image: url(<?php echo $threeD . 'img/sofa4os.png'; ?>)" data-model="sofa4os"></button>
          <button class="model3d-switch-item model3d-switch-naroznik" style="background-image: url(<?php echo $threeD . 'img/naroznik_sono.png'; ?>)" data-model="naroznik_sono"></button>
          <button class="model3d-switch-item model3d-switch-sofamello" style="background-image: url(<?php echo $threeD . 'img/sofamello.png'; ?>)" data-model="sofamello"></button>
          <button class="model3d-switch-item model3d-switch-szezlong" style="background-image: url(<?php echo $threeD . 'img/szezlong.png'; ?>)" data-model="szezlong"></button>
        </div>
      </div>
    </div>
    <?php
    } else {
      the_content();
    }
    ?>
  </div>
</div>
<!-- / post -->
<script type="text/javascript">
  var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>',
      themeUrl = '<?php echo get_template_directory_uri(); ?>';
</script>

<?php
wp_enqueue_script('three-js-min', $threeD . 'build/three.min.js');

wp_enqueue_script('three-js-detector', $threeD .'build/Detector.js');
wp_enqueue_script('three-js-stats', $threeD .'build/stats.min.js');
wp_enqueue_script('three-js-loader-binary', $threeD . 'js/loaders/BinaryLoader.js');

wp_enqueue_script('three-js-canvas', $threeD . 'build/CanvasRenderer.js');
wp_enqueue_script('three-js-loader', $threeD . 'js/loaders/OBJLoader.js');
wp_enqueue_script('three-js-projector', $threeD . 'build/Projector.js');
wp_enqueue_script('three-js-orbit', $threeD . 'js/controls/OrbitControls.js');
wp_enqueue_script('three-js-main', $threeD . 'js/main.js');
