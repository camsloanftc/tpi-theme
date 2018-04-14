<?php
// ============================= //
// ===== CUSTOM POST TYPES ===== //
// ============================= //

add_action( 'init', 'create_custom_post_types' );
function create_custom_post_types() {

	// product
	$product_args = array(
		'labels' => array(
			'name' => 'Products',
			'singular_name' => 'Product',
			'add_new' => 'Add New Product',
			'add_new_item' => 'Add New product',
			'edit_item' => 'Edit Product',
			'new_item' => 'New Product',
			'view_item' => 'View Product',
			'search_items' => 'Search Products',
			'not_found' => 'No Products found',
			'not_found_in_trash' => 'No Products found in Trash'
		),
		'public' => true,
		'has_archive' => false,
		'menu_icon' => get_bloginfo('template_url').'/images/cpt-product.png',
		'supports' => array(
			'title',
			'revisions',
		),
		// 'menu_position' => 20,
	);

	register_post_type( 'product', $product_args);
}


// ============================= //
// ===== CUSTOM TAXONOMIES ===== //
// ============================= //

add_action( 'init', 'custom_taxonomies' );
function custom_taxonomies() {

	// Product Categories
	register_taxonomy(
		'product_cat',
		'product',
		array(
			'hierarchical' => true,
			'label' => 'Product Categories',
			'query_var' => true,
			'rewrite' => array('slug' => 'product-cats')
		)
	);
}



// ========================== //
// ===== CUSTOM COLUMNS ===== //
// ========================== //

// Products - Custom Columns
add_filter( 'manage_edit-product_columns', 'product_edit_columns');
function product_edit_columns($columns){
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => 'Product',
		"product_cat" => 'Category',
		"product_thumb" => 'Thumbnail',
	);
	return $columns;
}

add_action( 'manage_product_posts_custom_column', 'product_columns');
function product_columns($column){
	global $post;
	switch ($column) {
		case "product_cat":
			$cat_list = '';
			$terms = get_the_terms( $post->ID, 'product_cat' );
			if ( $terms && ! is_wp_error( $terms ) ) :
			    $cat_array = array();
			    foreach($terms as $term){ $cat_array[] = $term->name; }
			    $cat_list = join(', ', $cat_array);
			endif;
			echo $cat_list;
			break;
		case "product_thumb":
			$img = get_field('thumb', $post->ID);
			if($img) echo '<img src="' . $img['sizes']['thumbnail'] . '" style="max-height:60px;width:auto" />';
			break;
	}
}
?>
