<?php
/**
 * WPized Light: Header
 *
 * Contains dummy HTML to show the default structure of WordPress header file
 *
 * Remember to always include the wp_head() call before the ending </head> tag
 *
 * Make sure that you include the <!DOCTYPE html> in the same line as ?> closing tag
 * otherwise ajax might not work properly
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
?><!DOCTYPE html>
<!--[if IE 8]> <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php bloginfo( 'description' ); ?>" />

  <link href="https://fonts.googleapis.com/css?family=Quicksand:400,700&display=swap&subset=latin-ext" rel="stylesheet">
  <?php
  wp_enqueue_style( 'main', get_template_directory_uri() . '/stylesheets/main.css' ); 
  ?>

  <!-- optional but recommended -->
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="shortcut icon" href="<?php bloginfo( 'stylesheet_directory' ); ?>/images/favicon.png" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!-- /optional -->

  <?php
  // do not remove
  wp_head();
  ?>
</head>
<body <?php body_class( 'no-js' ); ?>>

  <header class="clearfix header">
    <?php 
    $query_args = array(
      'post_type'  => 'page', 
      'meta_query' => array( 
        array(
          'key'   => '_wp_page_template', 
          'value' => 'single-header-extra.php'
        )
      )
    );
    $the_query = new WP_Query( $query_args );

    // Start the loop.
    while ( $the_query->have_posts() ) : $the_query->the_post();
    include(locate_template('partials/content-header-extra.php'));
    endwhile;
    ?>

    <nav class="navigation-main">
      <div class="container">
        <a href="<?php echo bloginfo('home'); ?>" class="navigation-main-logo">
          <img src="<?php bloginfo('template_directory')?>/images/logo-icon-artmeb.jpg" width="85" height="63" class="navigation-main-logo-img icon" />
          <img src="<?php bloginfo('template_directory')?>/images/logo-text-artmeb.svg" width="165" height="43" class="navigation-main-logo-img" />
        </a>
        <div class="nav-main">
          <?php do_action( 'wp_light_head' ); ?>
          <?php // echo do_shortcode('[google-translator]'); ?>
        </div>
      </div>
    </nav>

    <?php 

    /*require_once(ABSPATH . "wp-load.php");
    require_once(ABSPATH . "wp-admin/includes/taxonomy.php");
    require_once(ABSPATH . "wp-includes/post.php");

    global $polylang;
    global $wpdb;*/
    /*    $args = array(
      'posts_per_page'   => -1,
      'offset'           => 0,
      'orderby'          => 'ID',
      'order'            => 'DESC',
      'post_type'        => 'post',
      'suppress_filters' => true,
      'hide_empty' => false
    );
    $posts_array = get_posts( $args ); 
    $sliced_posts = array_slice($posts_array, 501, 500, true);
    //$posts_array = get_categories(array('hide_empty' => false)); 
    //var_dump($sliced_posts);

*/

    //$i = 0;
    //$lang = 'ru';
    /*
    foreach($sliced_posts as $postItem) {
      if ($polylang->model->get_post_language($postItem->ID)->slug === 'pl') {
        //if ($polylang->model->get_term_language($postItem->cat_ID)->slug === 'pl') {
        //if ($postItem->category_parent) {
        //if ($i < 1) {
        $categories = wp_get_post_categories($postItem->ID);
        //if (in_array(1163, $categories)) {
          $langCategories = array();
          foreach($categories as $category) {
            array_push($langCategories, pll_get_term($category, $lang));
          };

          $postData = array(
            'post_title'    => $postItem->post_title,
            'post_content'  => $postItem->post_content,
            'post_author'   => $postItem->post_author,
            'post_status'   => 'publish',
            'post_category' => $langCategories,
          );

          //var_dump($postData);

          //if ($i < 1) {
            $thumbId = get_post_thumbnail_id($postItem->ID);
            $newPostId = wp_insert_post($postData);
            set_post_thumbnail($newPostId, $thumbId);
            $polylang->model->set_post_language($newPostId, $lang);
            $polylang->model->save_translations('post', $newPostId, array('pl' => $postItem->ID));
            var_dump($newPostId);
            //++$i;
          //};
        //};


        //var_dump($postData);
        //$newPostId = wp_insert_post($postData);
        //var_dump($newPostId);
        //$thumbId = get_post_thumbnail_id($postItem->ID);
        //set_post_thumbnail($newPostId, $thumbId);
        //var_dump($thumbId);

        //$polylang->model->set_post_language($newPostId, $lang);
        //$polylang->model->save_translations('post', $newPostId, array('pl' => $postItem->ID));
        //++$i;


        //categories -----------------------------
        /*$catData = array(
            'cat_name'  => $postItem->cat_name,
            'category_nicename' => $lang . '-' . preg_replace("/[\s]+/", "-", strtolower($postItem->cat_name)),
            'category_parent'    => pll_get_term($postItem->parent, $lang),
            'taxonomy'  => $postItem->taxonomy
          );
        $newCatId = wp_insert_category($catData);
          $polylang->model->set_term_language($newCatId, $lang);
          $polylang->model->save_translations('term', $newCatId, array('pl' => $postItem->cat_ID));

        $results = $wpdb->get_results( 'SELECT option_value FROM wp_options WHERE option_name = "categoryimage_' . $postItem->cat_ID . '"');
          $imageId = $results[0]->option_value;
        echo ("INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(null, 'categoryimage_". $newCatId ."', '". $imageId ."', 'yes');");
          echo '<br>';*/
    //};
    //};
    //  };
    //};


    /*$newPostId = wp_insert_post(array(
      'post_title'    => 'Toro 22385',
      'post_content'  => '',
      'post_author'   => 1,
      'post_status'   => 'publish',
      'post_category' => array( 39, 1393 )
    ));
    var_dump($newPostId);
    $polylang->model->set_post_language($newPostId, 'en');
    $polylang->model->save_translations('post', $newPostId, array('pl' => 2126));
*/


    //
    /*require_once(ABSPATH . "wp-admin/includes/post.php");


    $dirName = 'Inari';
    $catId = 55;
    $catIdEn = 3518;
    $catIdDe = 3934;
    $catIdCs = 4354;
    $catIdRu = 3104;*/

    //  $urlEko = 'http://localhost/artmeb/wp-content/uploads/'. $dirName . '/';

    //$dir = 'C:/wamp/www/artmeb/wp-content/uploads/'. $dirName;
    // $list = new DirectoryIterator($dir);

    //$cdir = scandir($dir);
    //$slice = array_slice($cdir, 2);
    //var_dump($slice);

    //global $wpdb;

    //$id = 2000;
    // $i = 0;
    //foreach ($slice as $img) {
    /*$dirsInside = scandir($dir . $cat);
      $dirsInside = array_slice($dirsInside, 2);

      foreach ($dirsInside as $collection) {
        $dirsInsideInside = scandir($dir . $cat . '/' . $collection);
        $dirsInsideInside = array_slice($dirsInsideInside, 2);


        foreach ($dirsInsideInside as $img) {*/
    /*    $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $img);
      $name = preg_replace("/[\s-]+/", " ", $name);
      $path = 'http://localhost/artmeb/wp-content/uploads/2016/04/' . $img;
*/
    /*$collectionNameLower = strtolower($dirName);
          $collectionDB = get_category_by_slug(preg_replace("/[\s_]+/", "-", $collectionNameLower));
          $collectionId = $collectionDB->term_id;*/

    //echo ++$id . '<br>';
    /*echo $name . '<br>';
          echo $path . '<br>';
          echo $catId . '<br>';
          echo $collectionId . '<br>';*/

    /*     $results = $wpdb->get_results( 'SELECT ID FROM wp_posts WHERE post_title = "' . $name . '"');
      $imageId = $results[0]->ID;
*/

    /*var_dump($postData);
          var_dump($imageId);*/

    /*  
      $postData = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catId )
        );
        $newPost = wp_insert_post($postData);
        set_post_thumbnail($newPost, $imageId);
        $polylang->model->set_post_language($newPost, 'pl');
        $polylang->model->save_translations('post', $newPost, array('pl' => $newPost));

        $postDataEn = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdEn )
        );
        $newPostEn = wp_insert_post($postDataEn);
        set_post_thumbnail($newPostEn, $imageId);
        $polylang->model->set_post_language($newPostEn, 'en');
        $polylang->model->save_translations('post', $newPostEn, array('pl' => $newPost));

        $postDataDe = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdDe )
        );
        $newPostDe = wp_insert_post($postDataDe);
        set_post_thumbnail($newPostDe, $imageId);
        $polylang->model->set_post_language($newPostDe, 'de');
        $polylang->model->save_translations('post', $newPostDe, array('pl' => $newPost));

        $postDataCs = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdCs )
        );
        $newPostCs = wp_insert_post($postDataCs);
        set_post_thumbnail($newPostCs, $imageId);
        $polylang->model->set_post_language($newPostCs, 'cs');
        $polylang->model->save_translations('post', $newPostCs, array('pl' => $newPost));

        $postDataRu = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdRu )
        );
        $newPostRu = wp_insert_post($postDataRu);
        set_post_thumbnail($newPostRu, $imageId);
        $polylang->model->set_post_language($newPostRu, 'ru');
        $polylang->model->save_translations('post', $newPostRu, array('pl' => $newPost));

        var_dump($newPost);
        var_dump($newPostEn);
        var_dump($newPostDe);
        var_dump($newPostCs);
        var_dump($newPostRu);
        var_dump($i);*/

    //      ++$i;
    /* }
      };*/
    //    };





    /*
    wp_inster_post(array(
      'ID': null,
      'post_title'    => $name,
      'post_content'  => $_POST['post_content'],
      'post_status'   => 'publish',
      'post_category' => array( $catId, $collectionId )
    ));
*/    

    /*    foreach ($list as $fileinfo) {
      if ($fileinfo->isDir() && !$fileinfo->isDot()) {
        $listInside = new DirectoryIterator($dir . '/' . $fileinfo);

        foreach ($listInside as $fileinfoinside) {
          if ($fileinfoinside->isDir() && !$fileinfoinside->isDot()) {
            $catName = $fileinfoinside->getFilename();
            //var_dump($catName);

            $listInsideInside = new DirectoryIterator($dir . $fileinfoinside . '/');
            //$i = 0;
            foreach ($listInsideInside as $file) {
              //if ($i < 1) {
              if ($file->isFile()) {
                $filename = $file->getFilename();
                //var_dump($filename);
                $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename);
                var_dump($name);
                /* find attachment */
    /*global $wpdb;
                  $results = $wpdb->get_results( 'SELECT ID FROM wp_posts WHERE post_title = "' . $name . '"');
                  $imageId = $results[0]->ID;
                  $catNameLower = strtolower($catName);
                  $cat = get_category_by_slug(preg_replace("/[\s]+/", "-", $catNameLower));
                  echo '<br>';

                //var_dump($cat->name);

                /*echo "INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(null, 'categoryimage_". $cat->term_id ."', '". $imageId ."', 'yes');";
                //echo ($file->getFilename());
                //++$i;
              }
              //}
            }
          }
        }
      }
    }*/


    //$catId = 1106;
    /*foreach ($list as $fileinfo) {
        if ($fileinfo->isDir() && !$fileinfo->isDot()) {
          $catName = $fileinfo->getFilename();
          $catNameLower = strtolower($catName); */
    //echo "INSERT INTO `wp_terms` (`term_id`, `name`, `slug`, `term_group`) VALUES (". ++$catId .", '". preg_replace("/[\s_-]+/", " ", $catName) ."', '". preg_replace("/[\s]+/", "-", $catNameLower) ."', 0);";
    //echo '<br>';


    /*
          // adding category YAAAY!
          $my_cat_id = wp_insert_category(array(
            'cat_name' => preg_replace("/[\s_-]+/", " ", $catName),
            'category_nicename' => preg_replace("/[\s]+/", "-", $catNameLower),
            'category_parent' => 39,
            'taxonomy' => 'category'
          ));*/

    /*  $listInside = new DirectoryIterator($dir . '/' . $fileinfo);
          $i = 0;
          foreach ($listInside as $file) {
            if ($i < 1) {
              if ($file->isFile()) {*/
    /*echo "INSERT INTO `wp_termsmeta` (`meta_id`, `terms_id`, `meta_key`, `meta_value`) VALUES
(null, ". $catId .", 'obraz-wyrozniajacy', '". $urlEko . ($fileinfo->getFilename()) . '/' . ($file->getFilename()) ."');";*/
    /* $i++;
              }
            }
          }*/
    /*echo '<br>';
          echo "INSERT INTO `wp_term_taxonomy` (`term_taxonomy_id`, `term_id`, `taxonomy`, `description`, `parent`, `count`) VALUES
(null, ". $catId .", 'category', '', 37, 0);";

          echo '<br><br>';*/
    /*}
      }*/

    // dodanie karty produktu do kategorii PDF -----------------------------------------------------------
    /*global $wpdb;
    $results = $wpdb->get_results( 'SELECT guid, post_name FROM wp_posts WHERE post_name LIKE "karta-produktu-%"');

    $i = 0;
    foreach($results as $result) {
      $pdfUrl = $result->guid;
      $name = preg_replace("/\bkarta-produktu-\b/i", "", $result->post_name);
      $cats = $wpdb->get_results( 'SELECT * FROM wp_terms WHERE name LIKE "'. $name .'"');
      if ($cats) {
        foreach($cats as $cat) {
          var_dump($cat->name);
          //add_terms_meta($cat->term_id, 'pdf', $pdfUrl);
        }
        echo (++$i);
      }
    }*/
/*
    // Dodawanie tkanin z folderu $dirName / $dir
    require_once(ABSPATH . "wp-load.php");
    require_once(ABSPATH . "wp-admin/includes/taxonomy.php");
    require_once(ABSPATH . "wp-includes/post.php");

    global $wpdb;
    global $polylang;

    $dirName = 'eko-skora';
    $dir = 'C:/wamp/www/artmeb/wp-content/uploads/new/'. $dirName;
    $cdir = scandir($dir);


    // languages
    $langs = array('pl','en','de','cs','ru');

    $slice = array_slice($cdir, 2);
    $i = 0;

    foreach ($slice as $cat) {
      $dirsInside = scandir($dir . '/' . $cat);
      $dirsInside = array_slice($dirsInside, 2);


      $catId = get_cat_ID($cat);
      $catIdPl = pll_get_term($catId, 'pl');
      $catIdEn = pll_get_term($catId, 'en');
      $catIdDe = pll_get_term($catId, 'de');
      $catIdCs = pll_get_term($catId, 'cs');
      $catIdRu = pll_get_term($catId, 'ru');
      var_dump($catIdPl,$catIdEn,$catIdDe,$catIdCs,$catIdRu);
      foreach($dirsInside as $col) {
        $name = strtolower(preg_replace('/\\.[^.\\s]{3,4}$/', '', $col));
        $name = preg_replace("/[\s-]+/", " ", $name);
        $path = 'http://localhost/artmeb/wp-content/uploads/2016/05/' . preg_replace("/[\s ]+/", "-", strtolower($col));
        //$results = $wpdb->get_results( 'SELECT ID FROM wp_posts WHERE post_title = "' . $name . '"');
        //$imageId = $results[0]->ID;
        $results = $wpdb->get_results( 'SELECT post_id FROM wp_postmeta WHERE meta_value LIKE "2016/06/' . preg_replace("/.jpg/", "", preg_replace("/[\s ]+/", "-", $col) ) . '%"');
        $imageId = $results[0]->post_id;
        //var_dump($imageId);
        // stare zdjęcia
        if (!$imageId) {
          $results = $wpdb->get_results( 'SELECT post_id FROM wp_postmeta WHERE meta_value LIKE "2016/05/' . preg_replace("/.jpg/", "", preg_replace("/[\s ]+/", "-", $col) ) . '%"');
          $imageId = $results[0]->post_id;
          //var_dump($imageId);
        };

        //var_dump($imageId);
        //echo '<img src="http://localhost/artmeb/wp-content/uploads/2016/06/' . preg_replace("/[\s ]+/", "-", strtolower($col)) . '" width="100" height=" 100">';


        $postData = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdPl )
        );
        $newPost = wp_insert_post($postData);
        set_post_thumbnail($newPost, $imageId);
        $polylang->model->set_post_language($newPost, 'pl');
        $polylang->model->save_translations('post', $newPost, array('pl' => $newPost));

        $postDataEn = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdEn )
        );
        $newPostEn = wp_insert_post($postDataEn);
        set_post_thumbnail($newPostEn, $imageId);
        $polylang->model->set_post_language($newPostEn, 'en');
        $polylang->model->save_translations('post', $newPostEn, array('pl' => $newPost));

        $postDataDe = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdDe )
        );
        $newPostDe = wp_insert_post($postDataDe);
        set_post_thumbnail($newPostDe, $imageId);
        $polylang->model->set_post_language($newPostDe, 'de');
        $polylang->model->save_translations('post', $newPostDe, array('pl' => $newPost));

        $postDataCs = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdCs )
        );
        $newPostCs = wp_insert_post($postDataCs);
        set_post_thumbnail($newPostCs, $imageId);
        $polylang->model->set_post_language($newPostCs, 'cs');
        $polylang->model->save_translations('post', $newPostCs, array('pl' => $newPost));

        $postDataRu = array(
          'post_title'    => $name,
          'post_content'  => '',
          'post_author'   => 1,
          'post_status'   => 'publish',
          'post_category' => array( $catIdRu )
        );
        $newPostRu = wp_insert_post($postDataRu);
        set_post_thumbnail($newPostRu, $imageId);
        $polylang->model->set_post_language($newPostRu, 'ru');
        $polylang->model->save_translations('post', $newPostRu, array('pl' => $newPost));

        var_dump($newPost);
        var_dump($newPostEn);
        var_dump($newPostDe);
        var_dump($newPostCs);
        var_dump($newPostRu);
      };
    };*/
    // adds new categories (with translations) within a single folder
    /*foreach ($langs as $l) {
        $catId = get_category_by_slug(strtolower(preg_replace("/[\s ]+/", "-", $dirName)));
        $catIdLang = pll_get_term($catId->term_id, $l);

        // insert category
        $catData = array(
          'cat_name'          => $cat,
          'category_nicename' => $l .'-'. preg_replace("/[\s]+/", "-", strtolower($cat)),
          'category_parent'   => $catIdLang,
          'taxonomy'          => 'category'
        );
        //var_dump($catData);
        $catImgId = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_name LIKE '". preg_replace("/[\s ]+/", "-", strtolower($cat)) ."%' AND post_type LIKE 'attachment' LIMIT 1");
        //var_dump($catImgId[0]->ID);
        $newCatId = wp_insert_category($catData);
        if ($l == 'pl') {
          $newCatPLid = $newCatId;
          $polylang->model->set_term_language($newCatId, $l);
        } else {
          // insert category languages
          $polylang->model->set_term_language($newCatId, $l);
          $polylang->model->save_translations('term', $newCatId, array('pl' => $newCatPLid));
          //pll_set_term_language($newCatId, $l);
          //pll_save_term_translations(array('pl' => $newCatPLid, $l => $newCatId));
        };

        echo ("INSERT INTO `wp_options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES
(null, 'categoryimage_". $newCatId ."', '". $catImgId[0]->ID ."', 'yes');");
        echo '<br>';
      };*/
    /* };
*/
    //var_dump($i);

    /*
    set_post_thumbnail(21261, 10987);
    set_post_thumbnail(21262, 10987);
    set_post_thumbnail(21260, 10987);
    set_post_thumbnail(21258, 10987);
    set_post_thumbnail(21259, 10987);

    set_post_thumbnail(12600, 11790);
    set_post_thumbnail(12601, 11790);
    set_post_thumbnail(12602, 11790);
    set_post_thumbnail(12603, 11790);
    set_post_thumbnail(12604, 11790);

    set_post_thumbnail(12605, 11791);
    set_post_thumbnail(12606, 11791);
    set_post_thumbnail(12607, 11791);
    set_post_thumbnail(12608, 11791);
    set_post_thumbnail(12609, 11791);*/

    /*global $wpdb;
    $results = $wpdb->get_results( 'SELECT guid, post_name FROM wp_posts WHERE post_title LIKE "Karta produktu %"');

    $i = 0;
    foreach($results as $result) {
      $pdfUrl = $result->guid;

      if (strpos($pdfUrl, '/05/Ka') !== false) {
        $name = str_replace("-2", "", preg_replace("/\bKarta-produktu-\b/i", "", $result->post_name));
        //var_dump($name);
        $cats = $wpdb->get_results( 'SELECT * FROM wp_terms WHERE name LIKE "'. $name .'"');
        if ($cats) {
          foreach($cats as $cat) {
            var_dump($cat->name);
            update_terms_meta($cat->term_id, 'pdf', $pdfUrl);
          }
          echo (++$i);
        }
      }
    }*/

    // Add flat materials to materials
   /* 
   global $wpdb;
    $dir = 'C:/wamp/www/artmeb/wp-content/uploads/new/part1/b/';
    $cdir = scandir($dir);

    $slice = array_slice($cdir, 2);
    $i = 0;

    foreach ($slice as $cat) {
      $dirIn = 'C:/wamp/www/artmeb/wp-content/uploads/new/part1/b/' . $cat;
      $cdirIn = scandir($dirIn);

      $sliceIn = array_slice($cdirIn, 2);

      foreach ($sliceIn as $item) {
        $postTitle = preg_replace("/.jpg/", "", $item);
        $postidArr = $wpdb->get_results( "SELECT ID FROM wp_posts WHERE post_title = '" . $postTitle . "' AND post_type = 'post'" );

        //var_dump($postTitle);
        foreach ($postidArr as $post_id) {
          $img = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_name LIKE '". preg_replace("/[\s ]+/", "-", strtolower($postTitle)) ."%' AND post_type LIKE 'attachment' ORDER BY post_modified DESC LIMIT 1");
          //var_dump($img[0]->ID);
          //update_field('field_5746d98e4f82d', $img[0]->ID, $post_id); 
        };
      }
    }*/
    /*
    // insert wkladki 
    global $wpdb;
    $dir = 'C:/wamp/www/artmeb/wp-content/uploads/wkladki/';
    $cdir = scandir($dir);

    $slice = array_slice($cdir, 2);
    $i = 0;

    foreach ($slice as $cat) {
      //$catObj = get_category_by_slug(preg_replace("/[\s]+/", "-", preg_replace("/.jpg/", "", $cat)));
      $catObjs = $wpdb->get_results("SELECT * FROM `wp_terms` WHERE `name` LIKE '%". preg_replace("/.jpg/", "", $cat) ."%'");
      foreach ($catObjs as $catObj) {
        //if ($catObj->term_id) {
        $img = $wpdb->get_results("SELECT guid FROM wp_posts WHERE guid LIKE '%". $cat ."%'");

        echo '<br>';
        echo "INSERT INTO `wp_termsmeta` (`meta_id`, `terms_id`, `meta_key`, `meta_value`) VALUES
(null, ". $catObj->term_id .", 'obraz-wyrozniajacy', '". $img[0]->guid ."');";
        echo '<br>';
        //}
      }
    }
*/

    ?>
  </header>
