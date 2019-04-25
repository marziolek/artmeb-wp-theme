<?php
if ( isset( $_GET['translate'] ) ) {
	add_action( 'wp_footer', 'translate_javascript' ); // Write our JS below here
}

function translate_javascript() {
	?>
	<button class="js-ajax-translate">Try Ajax</button>
	<p class="debug">
	</p>
	<script type="text/javascript" >
		jQuery(document).ready(function ($) {
			var offset = 0;
			jQuery('.js-ajax-translate').click(function (e) {
				call_ajax(offset);
			});
		});
		function call_ajax(offset = 0){
			var data = {
				'action': 'translate',
				'offset': offset
			};
			jQuery.post('<?php echo admin_url( 'admin-ajax.php' ); ?>', data, function (response) {
				var json = jQuery.parseJSON(response);
				if (json.fin === false) {
					call_ajax(offset + 1);
				}
				jQuery('p.debug').text(json.out);
			});
		}
	</script> <?php
}

add_action( 'wp_ajax_translate', 'translate_posts' );
add_action( 'wp_ajax_nopriv_translate', 'translate_posts' );

function translate_posts() {
	$offset = ( int ) $_POST['offset'];
	$args = array(
		'post_type' => 'post',
		'posts_per_page' => 1,
		'offset' => $offset,
		'lang' => 'en',
	);

	$enposts = new WP_Query( $args );
	if ( $enposts->have_posts() ) {
		while ( $enposts->have_posts() ) {
			$enposts->the_post();
			$product = array(
				'post_title' => get_the_title(),
				'post_content' => get_the_content(),
				'post_type' => 'product',
				'post_status' => 'publish',
			);

			$lang_slug = pll_get_post_language( get_the_ID() );
			$product_id = wp_insert_post( $product );
			pll_set_post_language( $product_id, $lang_slug );

			update_images_and_meta( get_the_id(),$product_id );

			$translation_product_id_pl = create_single_translation( get_the_ID(), 'pl' );
			$translation_product_id_de = create_single_translation( get_the_ID(), 'de' );
			$translation_product_id_ru = create_single_translation( get_the_ID(), 'ru' );
			$translation_product_id_cs = create_single_translation( get_the_ID(), 'cs' );

			// save the translations of each post
			pll_save_post_translations( array(
				'en' => $product_id,
				'pl' => $translation_product_id_pl,
				'de' => $translation_product_id_de,
				'ru' => $translation_product_id_ru,
				'cs' => $translation_product_id_cs,
					)
			);
		}
		wp_reset_postdata();
		echo json_encode( array( 'fin' => false, 'out' => 'Added translations to ' . get_the_title() . '. Iteration #' . $offset ) );
	} else {
		echo json_encode( array( 'fin' => true, 'out' => 'Finished.' ) );
	}
	die;
}

function create_single_translation($post_id, $lang) {
	// get the polish translation
	$translation_id = pll_get_post( $post_id, $lang );
	$translated_post = get_post( $translation_id );

	$translation = array(
		'post_title' => $translated_post->post_title,
		'post_content' => $translated_post->post_content,
		'post_type' => 'product',
		'post_status' => 'publish',
	);


	// create polish post
	$translation_product_id = wp_insert_post( $translation );
	update_images_and_meta( $translation_id, $translation_product_id );
	pll_set_post_language( $translation_product_id, $lang );

	return $translation_product_id;
}

function update_images_and_meta($translation_id, $translation_product_id) {
	
	update_post_meta( $translation_product_id, 'fibre_link', get_permalink( $translation_id ) );
	$cats = get_the_category( $translation_id );
	foreach ( $cats as $cat ) {
		$term = wp_create_term( $cat->name, 'product_cat' );
		wp_set_object_terms( $translation_product_id, $term['term_id'], 'product_cat' );
	}

	$thumbnail_id = get_post_thumbnail_id( $translation_id );
	set_post_thumbnail( $translation_product_id, $thumbnail_id );

	if ( get_field( 'tkanina_3d', $translation_id ) ) {
		update_field( 'tkanina_3d', get_field( 'tkanina_3d', $translation_id ), $translation_product_id );
	}
	
}
