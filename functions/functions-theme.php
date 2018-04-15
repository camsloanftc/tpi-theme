<?php
// =================================== //
// ========= THEME FUNCTIONS ========= //
// =================================== //

// Add menus capability
function register_my_menus(){
  register_nav_menus(
    array(
      'main-menu' => 'Main Menu',
    )
  );
}
add_action( 'init', 'register_my_menus' );


// Add thumbnail support for posts
add_theme_support( 'post-thumbnails', array( 'post' ) );


// Custom Image Sizes
if (function_exists('add_image_size')) {
	add_image_size('panel_bg', 1400, 600, true); // required for flexible content!
	add_image_size('panel_bg_mobile', 768, 800, true); // required for flexible content!
}


// Custom login logo (274 x ~80)
function my_login_logo() {
	echo '<style type="text/css">body.login div#login h1 a {background-image: url(\'' . get_bloginfo( 'template_directory' ) . '/images/login-logo.png\');width:320px;height:43px;background-size:contain;margin-bottom:30px}</style>';
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );


// Disable Menus and Meta Boxes
if (is_admin()) :

	function seed_remove_menus(){

		// Disable "Posts"
		remove_menu_page('edit.php');

		// Disable "Comments"
		remove_menu_page('edit-comments.php');

		// Disable "Customize"
		global $submenu;
		unset($submenu['themes.php'][6]);

		// Hide "Tools" from non-admins
		if ( ! current_user_can('manage_options') ){
			global $menu;
			unset($menu[75]);
		}

		// Disable meta boxes in posts
		remove_meta_box('postcustom', 'post', 'normal');
		remove_meta_box('slugdiv', 'post', 'normal');
		remove_meta_box('commentsdiv', 'post', 'normal');
		remove_meta_box('trackbacksdiv', 'post', 'normal');
		remove_meta_box('commentstatusdiv', 'post', 'normal');
		//remove_meta_box('postexcerpt', 'post', 'normal');
		//remove_meta_box('authordiv', 'post', 'normal');

	}

	add_action( 'admin_menu', 'seed_remove_menus' );

endif;


// Add ACF Options pages
if( function_exists('acf_add_options_page') ) {
  acf_add_options_page('Theme Options');
}


// ACF Google Maps API Key
function my_acf_init() {
	global $google_api_key;
	acf_update_setting('google_api_key', $google_api_key);
}
add_action('acf/init', 'my_acf_init');


// Remove term descriptions from post editor
// make page full width for flexible panels
function wpse_hide_cat_descr() { ?>

    <style type="text/css">
       .term-description-wrap {
           display: none;
       }
       #edittag{max-width:100%}
    </style>

<?php }

add_action( 'admin_head-term.php', 'wpse_hide_cat_descr' );



// Pre Get Posts
function tripac_pre_get_posts( $query ) {

  // Order Taxonomy Queries by Custom Order
  if( !is_admin() && $query->is_tax('product_cat') ){
    $query->set( 'orderby', 'menu_order' );
    $query->set( 'order', 'ASC' );
    $query->set( 'posts_per_page', -1 );
  }

}
add_action( 'pre_get_posts', 'tripac_pre_get_posts' );



// ===== Generate Products Mega Menu (Desktop) ===== //
function products_mega_menu(){

  // try to get from cache
  ob_start();

  $buttons = '';
  $boxes = '';


  // Product Categories
  $terms = get_terms(array(
    'taxonomy' => 'product_cat',
    'orderby' => 'menu_order',
    'order' => 'ASC',
  ));
  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

    $i = 0;

    foreach ( $terms as $term ) {

      $i++;

      // Fields
      $cat_blurb = get_field('blurb', 'product_cat_' . $term->term_id);
      $cat_img = get_field('feat_img', 'product_cat_' . $term->term_id);
      $cat_layout = get_field('layout', 'product_cat_' . $term->term_id);


      // ===== Top Button - Open ===== //
      $buttons .= '<li class="pmm-cat' . ($i == 1 ? ' active' : '') . '" data-id="' . $i . '"><a class="cat-col-' . $term->term_id . ' cc-bg" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';


      // ===== Category Box ===== //
      $boxes .= '<li class="pmm-box" data-id="' . $i . '"' . ($i == 1 ? ' style="display:block"' : '') . '>';

        // Banner
        $boxes .= '<div class="banner">';

          // Background Image
          $boxes .= '<div class="bg-img desktop" style="background-image:url(\'' . $cat_img['sizes']['panel_bg'] . '\');"></div>';
          $boxes .= '<div class="bg-img mobile" style="background-image:url(\'' . $cat_img['sizes']['panel_bg_mobile'] . '\');"></div>';

          // Content
          $boxes .= '<div class="content">';

            // Overlay
            $boxes .= '<div class="overlay cat-col-' . $term->term_id . ' cc-bg"></div>';

            // Blurb
            $boxes .= '<p class="blurb">' . $cat_blurb . '</p>';

            // Explore Button
            $boxes .= '<a href="' . esc_url( get_term_link( $term ) ) . '" class="explore">Explore<span> Products</span></a>';

          $boxes .= '</div>';

        $boxes .= '</div>';


        // ===== Products List ===== //
        $args = array(
          'post_type' => 'product',
          'posts_per_page' => -1,
          'tax_query' => array(
            array(
              'taxonomy' => 'product_cat',
              'field' => 'term_id',
              'terms' => array($term->term_id),
            ),
          ),
        );

        $wp_query = new WP_Query($args);

        if( $wp_query->have_posts() ):

          $boxes .= '<ul class="products-list cat-col-' . $term->term_id . ' cc-border">';

            while( $wp_query->have_posts() ): $wp_query->the_post();

              $link = get_permalink();

              $boxes .= '<li><a href="' . $link . '" class="cat-col-' . $term->term_id . ' cc-border-hover-before cc-color-hover">' . get_the_title() . svgi('triangle-right') . '</a></li>';

            endwhile;

          $boxes .= '</ul>';

        endif;

        wp_reset_query();

        // close category box
        $boxes .= '</li>';

    }

  }


  // Products
  echo '<li class="pmm"><a href="' . get_bloginfo('url') . '/products/">Products</a>';

    // Sub
    echo '<div class="pmm-sub">';

      // Category Names
      echo '<ul class="pmm-cats">' . $buttons . '</ul>';

      // Boxes
      echo '<ul class="pmm-boxes">' . $boxes . '</ul>';

    echo '</div>';

  // Close main heading
  echo '</li>';


  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}


// ===== Generate Products Mega Menu (Mobile) ===== //
function products_mega_menu_mobile(){

  ob_start();

  // Main Heading
  echo '<li><a href="' . get_bloginfo('url') . '/products/">Products</a>';

    // Mega Menu
    echo '<ul class="sub-menu">';

      // Product Categories
      $terms = get_terms(array(
        'taxonomy' => 'product_cat',
        'orderby' => 'menu_order',
        'order' => 'ASC',
      ));
      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

        foreach ( $terms as $term ) {

          // Fields
          $cat_layout = get_field('layout', 'product_cat_' . $term->term_id);

          // ===== Top Button - Open ===== //
          echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';

            // ===== Products List ===== //
            $args = array(
              'post_type' => 'product',
              'posts_per_page' => -1,
              'tax_query' => array(
                array(
                  'taxonomy' => 'product_cat',
                  'field' => 'term_id',
                  'terms' => array($term->term_id),
                ),
              ),
            );

            $wp_query = new WP_Query($args);

            if( $wp_query->have_posts() ):

              echo '<ul class="sub-menu">';

                while( $wp_query->have_posts() ): $wp_query->the_post();
                  $link = get_permalink();

                  echo '<li><a href="' . $link . '">' . get_the_title() . '</a></li>';

                endwhile;

              echo '</ul>';

            endif;

            wp_reset_query();


          // close top button
          echo '</li>';

        }

      }

    echo '</ul>';

  // Close main heading
  echo '</li>';


  $output = ob_get_contents();
  ob_end_clean();

  return $output;
}



// Reset products mega menu cache when saving a PRODUCT
function tp_update_mm_cache_cpt($post_id, $post, $update){
  if( get_post_type($post_id) == 'product')
    update_option('mm_cache', '');
    update_option('mm_mobile_cache', '');
}
add_action('save_post', 'tp_update_mm_cache_cpt', 10, 3);


// Reset products mega menu cache when updating PRODUCT meta (ordering!)
function tp_update_mm_cache_order($meta_id, $post_id, $meta_key, $meta_value){
  //if( $meta_key == 'menu_order'){
    update_option('mm_cache', '');
    update_option('mm_mobile_cache', '');
  //}
}
add_action('added_post_meta', 'tp_update_mm_cache_order', 10, 4);
add_action('updated_post_meta', 'tp_update_mm_cache_order', 10, 4);


// Reset products mega menu cache when saving a TAXONOMY
function tp_update_mm_cache_tax($term_id, $tt_id, $taxonomy) {
  if( $taxonomy == 'product_cat' )
    update_option('mm_cache', '');
    update_option('mm_mobile_cache', '');
}
add_action( 'created_term', 'tp_update_mm_cache_tax', 10, 3 );
add_action( 'edited_term', 'tp_update_mm_cache_tax', 10, 3 );
add_action( 'delete_term', 'tp_update_mm_cache_tax', 10, 3 );



// [cta] Shortcode
function cta_shortcode_func( $atts ) {
  return get_field('cta_content', 'options');
}
add_shortcode( 'cta', 'cta_shortcode_func' );
?>
