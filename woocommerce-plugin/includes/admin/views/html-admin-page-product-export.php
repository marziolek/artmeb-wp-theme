<?php
/**
 * Admin View: Product Export
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_script( 'wc-product-export' );

$exporter        = new WC_Product_CSV_Exporter();
$product_count   = wp_count_posts( 'product' );
$variation_count = wp_count_posts( 'product' );
$total_rows      = $product_count->publish + $product_count->private + $variation_count->publish + $variation_count->private;
?>
<div class="wrap woocommerce">
	<h1><?php esc_html_e( 'Export Products', 'woocommerce' ); ?></h1>

	<div class="woocommerce-exporter-wrapper">
		<form class="woocommerce-exporter">
			<header>
				<span class="spinner is-active"></span>
				<h2><?php esc_html_e( 'Export products to a CSV file', 'woocommerce' ); ?></h2>
				<p><?php esc_html_e( 'This tool allows you to generate and download a CSV file containing a list of all products.', 'woocommerce' ); ?></p>
			</header>
			<section>
				<table class="form-table woocommerce-exporter-options">
					<tbody>
						<tr>
							<th scope="row">
								<label for="woocommerce-exporter-columns"><?php esc_html_e( 'Which columns should be exported?', 'woocommerce' ); ?></label>
							</th>
							<td>
								<select id="woocommerce-exporter-columns" class="woocommerce-exporter-columns wc-enhanced-select" style="width:100%;" multiple data-placeholder="<?php esc_attr__( 'Export all columns', 'woocommerce' ); ?>">
									<?php
										foreach ( $exporter->get_default_column_names() as $column_id => $column_name ) {
											echo '<option value="' . esc_attr( $column_id ) . '">' . esc_html( $column_name ) . '</option>';
										}
									?>
									<option value="downloads"><?php esc_html_e( 'Downloads', 'woocommerce' ); ?></option>
									<option value="attributes"><?php esc_html_e( 'Attributes', 'woocommerce' ); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="woocommerce-exporter-types"><?php esc_html_e( 'Which product types should be exported?', 'woocommerce' ); ?></label>
							</th>
							<td>
								<select id="woocommerce-exporter-types" class="woocommerce-exporter-types wc-enhanced-select" style="width:100%;" multiple data-placeholder="<?php esc_attr__( 'Export all products', 'woocommerce' ); ?>">
									<?php
										foreach ( wc_get_product_types() as $value => $label ) {
											echo '<option value="' . esc_attr( $value ) . '">' . esc_html( $label ) . '</option>';
										}
									?>
									<option value="variation"><?php esc_html_e( 'Product variations', 'woocommerce' ); ?></option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row">
								<label for="woocommerce-exporter-meta"><?php esc_html_e( 'Export custom meta?', 'woocommerce' ); ?></label>
							</th>
							<td>
								<input type="checkbox" id="woocommerce-exporter-meta" value="1" />
								<label for="woocommerce-exporter-meta"><?php esc_html_e( 'Yes, export all custom meta', 'woocommerce' ); ?></label>
							</td>
						</tr>
					</tbody>
				</table>
				<progress class="woocommerce-exporter-progress" max="100" value="0"></progress>
			</section>
			<div class="wc-actions">
				<input type="submit" class="woocommerce-exporter-button button button-primary" value="<?php esc_attr__( 'Generate CSV', 'woocommerce' ); ?>" />
			</div>
		</form>
	</div>
</div>