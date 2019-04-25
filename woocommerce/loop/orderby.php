<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
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
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<form class="woocommerce-ordering" method="get">
  <?php foreach ( $catalog_orderby_options as $id => $name ) : ?>
    <label for="<?php echo esc_attr( $id ); ?>" <?php if (selected( $orderby, $id )) : ?> class="active"<?php endif; ?>>
      <span><?php echo esc_html( $name ); ?></span>
      <input type="radio" value="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ); ?>" name="orderby" <?php if (selected( $orderby, $id )) : ?>checked="checked"<?php endif; ?>>
    </label>
  <?php endforeach; ?>
	<?php wc_query_string_form_fields( null, array( 'orderby', 'submit' ) ); ?>
</form>
