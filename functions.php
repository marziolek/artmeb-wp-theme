<?php
/**
 * WPized Light: Theme specific functionalities
 *
 * Do not close any of the php files included with ?> closing tag!
 *
 * @package WordPress
 * @subpackage WPized_Light
 */
define( 'WP_LIGHT', 'wp_light' ); // used in translation strings

function wp_light_load_features() {

  $features = scandir( dirname( __FILE__ ) . '/features/' );

  foreach ( $features as $feature ) {

    if ( current_theme_supports( $feature ) ) {
      require_once dirname( __FILE__ ) . '/features/' . $feature . '/' . $feature . '.php';
    }
  }
}

add_action( 'init', 'wp_light_load_features' );

add_theme_support( 'seo-title' );
add_theme_support( 'threaded-comments' );
add_theme_support( 'comments' );

// add two navigation menus
add_theme_support( 'menus', array(
  'navigation-top' => __( 'Top Navigation Menu' ),
  'navigation-foot' => __( 'Footer Navigation Menu' ),
) );

// add 3 default sidebars
add_theme_support( 'sidebars', array(
  array(),
  array(),
  array(),
) );

add_theme_support( 'images', array(
  '400x500' => array(
    'width' => '400',
    'height' => '500',
    'crop' => true,
  ),
) );

add_theme_support( 'cpt', array(
  // team post
  'wp-light-team' => array(
    'singular' => 'Team Member',
    'plural' => 'Team Members',
    'publicly_queryable' => true,
    'rewrite' => array( 'slug' => 'team', 'with_front' => true ),
  ),
) );

add_theme_support( 'custom-tax', array(
  // taxonomy like category
  'wp-light-team-tag' => array(
    'singular' => 'Member Category',
    'plural' => 'Member Categories',
    'rewrite' => array( 'slug' => 'category', 'with_front' => false ),
    'posts' => array( 'wp-light-team' ),
  ),
) );

add_theme_support( 'settings', array(
  'opt1' => array(
    'type' => 'text',
    'name' => 'fb',
    'desc' => 'Facebook link',
  ),
  'opt2' => array(
    'type' => 'dropdown_pages',
    'name' => 'dropdown-pages',
    'desc' => 'Testing dropdown pages',
  ),
  'opt3' => array(
    'type' => 'wp_editor',
    'name' => 'wp-editor',
    'desc' => 'Testing WP Editor',
  ),
) );


/* translations for polylang */

if (function_exists('pll_register_string')) {
  // footer
  pll_register_string('footer-copy', 'Copyright &copy; 2016 Artmeb. All Rights Reserved. Materials can be copied or downloaded only after permision from Artmeb.', 'Stopka');
  pll_register_string('footer-made-by', 'Made by', 'Stopka');
  pll_register_string('footer-company-name', 'Hurtownia Tkanin i Akcesorii Meblowych', 'Stopka');
  pll_register_string('footer-company-address', 'ul. Wrocławska 5, 63-600 Kępno', 'Stopka');
  pll_register_string('footer-company-phones', 'tel. +48 502 444 222, +48 500 155 604, tel. / fax (62) 782 12 54', 'Stopka');
  pll_register_string('footer-disclaimer', 'Dołożyliśmy wszelkich starań, aby kolorystyka prezentowanych tkanin na zdjęciach odpowiadała naturalnej, jednak ustawienia monitora oraz usytuowanie oświetlenia podczas wykonywania zdjęć mogą mieć wpływ na prezentowaną kolorystykę. Prosimy o weryfikację kolorów na próbnikach oraz ekspozycjach dostępnych w naszej hurtowni.', 'Stopka');
  pll_register_string('footer-czyszczenie', 'Czyszczenie wodą', 'Stopka'); 
  pll_register_string('footer-design', 'Design', 'Stopka'); 
  pll_register_string('footer-dostawa', 'Dostawa', 'Stopka'); 
  pll_register_string('footer-dzieci', 'Dzieci', 'Stopka'); 
  pll_register_string('footer-gabka', 'Gąbka', 'Stopka'); 
  pll_register_string('footer-iron', 'Iron', 'Stopka'); 
  pll_register_string('footer-kurier', 'Kurier', 'Stopka'); 
  pll_register_string('footer-miekkie', 'Miękkie', 'Stopka'); 
  pll_register_string('footer-mocne', 'Mocne', 'Stopka'); 
  pll_register_string('footer-mydlo', 'Mydło', 'Stopka'); 
  pll_register_string('footer-odkurzacz', 'Odkurzacz', 'Stopka'); 
  pll_register_string('footer-pralka', 'Pralka', 'Stopka'); 
  pll_register_string('footer-pranie', 'Pranie', 'Stopka'); 
  pll_register_string('footer-rece', 'Ręce', 'Stopka'); 
  pll_register_string('footer-soap', 'Soap', 'Stopka'); 
  pll_register_string('footer-srodowisko', 'Środowisko', 'Stopka'); 
  pll_register_string('footer-trudnopalne', 'Trudnopalne', 'Stopka'); 
  pll_register_string('footer-wodoodporne', 'Wodoodporne', 'Stopka'); 
  pll_register_string('footer-wlos', 'Włos', 'Stopka'); 

  // subcategory page
  pll_register_string('subcategory-tkanina', 'Tkanina', 'subcategory');
  pll_register_string('subcategory-tkaniny', 'Tkaniny', 'subcategory');
  pll_register_string('subcategory-karta-produktu', 'Karta Produktu', 'subcategory');
  pll_register_string('subcategory-nazwa-kolekcji', 'Nazwa Kolekcji', 'subcategory');
  pll_register_string('subcategory-gramatura', 'Gramatura', 'subcategory');
  pll_register_string('subcategory-sklad', 'Skład', 'subcategory');
  pll_register_string('subcategory-szerokosc', 'Szerokość', 'subcategory');
  pll_register_string('subcategory-scieralnosc', 'Ścieralność', 'subcategory');
  pll_register_string('subcategory-pilingi', 'Pilingi', 'subcategory');
  pll_register_string('subcategory-utrata-koloru', 'Utrata koloru pod wpływem światła', 'subcategory');
  pll_register_string('subcategory-odpornosc', 'Odporność na tarcie', 'subcategory');
  pll_register_string('subcategory-certyfikat-antybakteryjny', 'Certyfikat antybakteryjny', 'subcategory');
  pll_register_string('subcategory-pobierz-karte-produktu', 'Pobierz kartę produktu', 'subcategory');
  pll_register_string('subcategory-pasuje-z', 'Pasuje z:', 'subcategory');

  // contact page
  pll_register_string('contact-formularz-kontaktowy', 'Formularz kontaktowy', 'contact');
  pll_register_string('contact-lokalizacja', 'Lokalizacja', 'contact');

  // realizations pages
  pll_register_string('realizations-realizacje', 'Realizacje', 'realizations');  
  pll_register_string('realizations-strona', 'strona', 'realizations');

  // 3d
  pll_register_string('threed-rotate', 'Aby obrócić model kliknij i przeciągnij gdziekolwiek dookoła mebla.', 'threed');
  pll_register_string('threed-zoom', 'Aby przybliżyć/oddalić model użyj przycisków +/- z prawej strony.', 'threed');
  pll_register_string('threed-pick', 'Aby wybrać poszczególne elementy mebla, po prostu kliknij je.', 'threed');
  
  // pictograms
  pll_register_string('pictogram-filter', 'Wybierz jeden lub kilka piktogramów, aby przefiltrować tkaniny', 'pictogram');
};

/* / translations for polylang */

/* Change "Posts" into "Tkaniny" in admin panel */
function change_post_label_to_tkaniny() {
  global $menu;
  global $submenu;
  $menu[5][0] = 'Tkaniny';
  $submenu['edit.php'][5][0] = 'Tkaniny';
  $submenu['edit.php'][10][0] = 'Dodaj tkaninę';
  $submenu['edit.php'][16][0] = 'Tagi tkanin';
  echo '';
}
function change_post_object() {
  global $wp_post_types;
  $labels = &$wp_post_types['post']->labels;
  $labels->name = 'Tkaniny';
  $labels->singular_name = 'Tkanina';
  $labels->add_new = 'Dodaj tkaninę';
  $labels->add_new_item = 'Dodaj tkaninę';
  $labels->edit_item = 'Edytuj tkaninę';
  $labels->new_item = 'Nowa tkanina';
  $labels->view_item = 'Pokaż tkaninę';
  $labels->search_items = 'Szukaj tkaniny';
  $labels->not_found = 'Brak tkanin';
  $labels->not_found_in_trash = 'Brak tkanin w koszu';
  $labels->all_items = 'Wszystkie tkaniny';
  $labels->menu_name = 'Tkaniny';
  $labels->name_admin_bar = 'Tkaniny';
}

add_action( 'admin_menu', 'change_post_label_to_tkaniny' );
add_action( 'init', 'change_post_object' );
/* / Change "Posts" into "Tkaniny" in admin panel */

// footer js scripts
function my_js() {
  wp_enqueue_script(
    'main-handle', 
    get_bloginfo('template_directory') . '/javascript/main.js',
    true);
}
add_action( 'wp_footer', 'my_js' );

add_filter( 'nav_menu_css_class', 'add_parent_url_menu_class', 10, 2 );

function add_parent_url_menu_class( $classes = array(), $item = false ) {
  $current_url = current_url();
  $homepage_url = trailingslashit( get_bloginfo( 'url' ) );

  if( is_404() or $item->url == $homepage_url ) return $classes;

  if ( strstr( $current_url, $item->url) ) {
    $classes[] = 'current_page_item';
  }

  return $classes;
}

function current_url() {
  $url = ( 'on' == $_SERVER['HTTPS'] ) ? 'https://' : 'http://';

  $url .= $_SERVER['SERVER_NAME'];
  $url .= ( '80' == $_SERVER['SERVER_PORT'] ) ? '' : ':' . $_SERVER['SERVER_PORT'];
  $url .= $_SERVER['REQUEST_URI'];

  return trailingslashit( $url );
}

function get_image_id_by_url($image_url) {
  global $wpdb;
  $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s' LIMIT 1;", $image_url )); 
  return $attachment[0]; 
}

function more_post_ajax() {

  $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
  $cat = (isset($_POST['cat'])) ? $_POST['cat'] : 0;

  $args = array(
    'posts_per_page'   => 3,
    'cat'              => $cat,
    'orderby'          => 'name',
    'order'            => 'ASC',
    'post_type'        => 'post',
    'post_status'      => 'publish',
    'suppress_filters' => true,
    'paged'            => $page,
    'meta_query'	=> array(
      array(
        'key'		=> 'tkanina_3d',
        'value'		=> '^',
        'compare'	=> 'REGEXP'
      )
    )
  );

  $loop = new WP_Query($args);

  $out = '';

  if ($loop -> have_posts()) :  while ($loop -> have_posts()) : $loop -> the_post();
  $material3d = get_field('tkanina_3d');

  if ($material3d) {
    $materialFlat = wp_get_attachment_image_src($material3d, 'full'); 
    $materialFlatSmall = wp_get_attachment_image_src($material3d, 'thumbnail'); 
    $out .= '<div class="visualization-page-material" data-image="' . $materialFlat[0] .'" title="'. strtoupper(get_the_title()) . '" style="background-image: url(' . $materialFlatSmall[0] .')"></div>';
  };

  endwhile;
  endif;
  wp_reset_postdata();
  die($out);
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

function start_filter_session() {
  if (!session_id()) {
    session_start();
  }
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
  add_theme_support( 'woocommerce' );
};
if ( class_exists( 'WooCommerce' ) ) {
  add_action('init', 'start_filter_session', 1);
  add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

  add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

  function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
    $cols = 12;
    return $cols;
  }

  //Adding Alphabetical sorting option to shop and product settings pages
  function sip_alphabetical_shop_ordering( $sort_args ) {
    $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
    if ( 'alphabetical' == $orderby_value ) {
      $sort_args['orderby'] = 'title';
      $sort_args['order'] = 'asc';
      $sort_args['meta_key'] = '';
    }
    return $sort_args;
  }
  add_filter( 'woocommerce_get_catalog_ordering_args', 'sip_alphabetical_shop_ordering' );

  function sip_custom_wc_catalog_orderby( $sortby ) {
    unset($sortby['date']);
    $sortby['alphabetical'] = 'Sortuj wg nazwy: A-Z';
    return $sortby;
  }
  add_filter( 'woocommerce_default_catalog_orderby_options', 'sip_custom_wc_catalog_orderby' );
  add_filter( 'woocommerce_catalog_orderby', 'sip_custom_wc_catalog_orderby' );


  add_action( 'woocommerce_after_order_notes', 'wpdesk_vat_field' );
  /**
  * Pole NIP w zamówieniu
  */
  function wpdesk_vat_field( $checkout ) {
    echo '<div id="wpdesk_vat_field"><h2>' . _e('Dane do Faktury') . '</h2>';
    
    woocommerce_form_field( 'vat_number', array(
      'type'          => 'text',
      'class'         => array( 'vat-number-field form-row-wide') ,
      'label'         => __( 'NIP' ),
      'placeholder'   => __( 'Wpisz NIP, aby otrzymać fakturę' ),
    ), $checkout->get_value( 'vat_number' ));
    
    echo '</div>';
  }

  add_action( 'woocommerce_checkout_update_order_meta', 'wpdesk_checkout_vat_number_update_order_meta' );
  /**
  * Save VAT Number in the order meta
  */
  function wpdesk_checkout_vat_number_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['vat_number'] ) ) {
      update_post_meta( $order_id, '_vat_number', sanitize_text_field( $_POST['vat_number'] ) );
    }
  }

  add_action( 'woocommerce_admin_order_data_after_billing_address', 'wpdesk_vat_number_display_admin_order_meta', 10, 1 );
  /**
   * Wyświetlenie pola NIP
   */
  function wpdesk_vat_number_display_admin_order_meta( $order ) {
    echo '<p><strong>' . _e( 'NIP', 'woocommerce' ) . ':</strong> ' . get_post_meta( $order->id, '_vat_number', true ) . '</p>';
  }

  add_filter( 'woocommerce_email_order_meta_keys', 'wpdesk_vat_number_display_email' );
  /**
  * Pole NIP w mailu
  */
  function wpdesk_vat_number_display_email( $keys ) {
    $keys['NIP'] = '_vat_number';
    return $keys;
  }
}

add_filter( 'loop_shop_per_page', 'bbloomer_redefine_products_per_page', 9999 );
 function bbloomer_redefine_products_per_page( $per_page ) {
  $per_page = 18;
  return $per_page;
}

/* Add Show All Products to Woocommerce Shortcode */
function woocommerce_shortcode_display_all_products($args) {
  if(strtolower(@$args['post__in'][0])=='all') {
    global $wpdb;
    $args['post__in'] = array();
    $products = $wpdb->get_results("SELECT ID FROM ".$wpdb->posts." WHERE `post_type`='product'",ARRAY_A);
    foreach($products as $k => $v) { $args['post__in'][] = $products[$k]['ID']; }
  }
  return $args;
}
add_filter('woocommerce_shortcode_products_query', 'woocommerce_shortcode_display_all_products');

if (function_exists('acf_add_options_page')) {
  acf_add_options_page('Opcje');
}

add_filter( 'woocommerce_output_related_products_args', 'related_products_args', 20 );
function related_products_args( $args ) { 
  $args = wp_parse_args( array( 'posts_per_page' => 999, 'columns' => 6, 'orderby' => 'title', 'order' => 'ASC' ), $args );
  return $args;
};

add_filter( 'woocommerce_product_related_posts_relate_by_category', 'relate_by_category', 20);
function relate_by_category() {
  return false;
};