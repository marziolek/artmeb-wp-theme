<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add generic mappings.
 *
 * @since 3.1.0
 * @param array $mappings
 * @return array
 */
function wc_importer_generic_mappings( $mappings ) {
	$generic_mappings = array(
		_e( 'Title', 'woocommerce' )         => 'name',
		_e( 'Product Title', 'woocommerce' ) => 'name',
		_e( 'Price', 'woocommerce' )         => 'regular_price',
		_e( 'Parent SKU', 'woocommerce' )    => 'parent_id',
		_e( 'Quantity', 'woocommerce' )      => 'stock_quantity',
	);

	return array_merge( $mappings, $generic_mappings );
}
add_filter( 'woocommerce_csv_product_import_mapping_default_columns', 'wc_importer_generic_mappings' );
