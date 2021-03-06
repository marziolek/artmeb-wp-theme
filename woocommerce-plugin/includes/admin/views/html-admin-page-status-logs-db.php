<?php
/**
 * Admin View: Page - Status Database Logs
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<form method="get" id="mainform" action="">

	<?php $log_table_list->display(); ?>

	<input type="hidden" name="page" value="wc-status" />
	<input type="hidden" name="tab" value="logs" />

	<?php submit_button( _e( 'Flush all logs', 'woocommerce' ), 'delete', 'flush-logs' ); ?>
	<?php wp_nonce_field( 'woocommerce-status-logs' ); ?>
</form>
<?php
wc_enqueue_js( "
	jQuery( '#flush-logs' ).click( function() {
		if ( window.confirm('" . esc_js( _e( 'Are you sure you want to clear all logs from the database?', 'woocommerce' ) ) . "') ) {
			return true;
		}
		return false;
	});
" );
