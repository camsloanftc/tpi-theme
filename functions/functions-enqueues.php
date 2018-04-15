<?php
// ============================== //
// ====== Styles & Scripts ====== //
// ============================== //
if(!is_admin()){ add_action('wp_enqueue_scripts', 'my_scripts_enqueue'); }
function my_scripts_enqueue(){

	// Main CSS styles, with auto versioning
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/build/css/styles.min.css', array(), filemtime( get_stylesheet_directory() . '/build/css/styles.min.css' ) );

	// jQuery
	wp_deregister_script('jquery');
	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', false, '3.2.1', false);
	wp_enqueue_script('jquery');

	// jQuery UI
	wp_deregister_script('jquery-ui');
	wp_register_script('jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery'), '1.12.1', true);
	wp_register_script('theme-jquery-ui', get_template_directory_uri() . '/build/js/theme-jquery-ui.min.js', array('jquery', 'jquery-ui'), '1.0', true);
	//wp_enqueue_script('jquery-ui');

	// Global
	wp_register_script('global', get_template_directory_uri() . '/build/js/global.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('global');

	// Flexslider
	wp_register_script('flexslider', get_template_directory_uri() . '/js/libs/jquery.flexslider-min.js', array('jquery'), '2.6.3', true);
	wp_register_script('theme-flexslider', get_template_directory_uri() . '/build/js/theme-flexslider.min.js', array('jquery', 'flexslider'), '1.0', true);
	//wp_enqueue_script('flexslider');

	// lightGallery
	wp_register_style('lightgallery-css', get_template_directory_uri() . '/js/libs/lightgallery/css/lightgallery-custom.css');
	wp_register_script('lightgallery-js', get_template_directory_uri() . '/js/libs/lightgallery/js/lightgallery-custom.js', array('jquery'), '1.0', true);
	wp_register_script('theme-lightgallery', get_template_directory_uri() . '/build/js/theme-lightgallery.min.js', array('jquery', 'lightgallery-js'), '1.0', true);
	// wp_enqueue_style('lightgallery-css');
	// wp_enqueue_script('lightgallery-js');

	// ACF Maps
	global $google_api_key;
	wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . $google_api_key, null, '1.0', true);
	wp_register_script('acf-maps', get_template_directory_uri() . '/build/js/acf-maps.min.js', array('googlemaps'), '1.0', true);
	//wp_enqueue_script('script-acf-maps');

	if( is_page_template('page-contact.php') ){
		wp_enqueue_script('acf-maps');
	}

	// Product Cat Taxonomy
	wp_register_script('product-tabs', get_template_directory_uri() . '/build/js/product-tabs.min.js', array('jquery'), '1.0', true);

	// Currently, we are no longer using the product-tabs carousel, but a grid system instead.
	// I have left the old taxonomy-product_cat php code in a file called "taxonomy-product_cat-old.php" - Cam Sloan, Apr 15, 2018
	// if( is_tax('product_cat') ){
	// 	wp_enqueue_script('product-tabs');
	// }

	// SVG support for IE
	wp_register_script('svgxuse', get_template_directory_uri() . '/js/libs/svgxuse.min.js', null, '1.2.4', true);
	wp_enqueue_script('svgxuse');

}
?>
