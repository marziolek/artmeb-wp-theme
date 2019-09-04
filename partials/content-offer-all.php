<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );
?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
    do_action( 'woocommerce_before_main_content' );
	?>

    <header class="woocommerce-products-header">
    <!-- 
      <?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

        <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>

      <?php endif; ?>
    -->
    
    <?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
      do_action( 'woocommerce_archive_description' );
		?>

    </header>

    <div class="container">
      <div class="row woocommerce-primary-and-secondary">
        <div id="secondary" class="col-xs-12 col-md-3 col-md-push-9 widget-area" role="complementary">
          <?php echo do_shortcode('[woof]'); ?>
        </div>

        <div id="primary" class="col-xs-12 col-md-9 col-md-pull-3 woocommerce-primary">
          <?php echo do_shortcode('[woof_products per_page=18 columns=6]'); ?>
        </div>
      </div>
    </div>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
