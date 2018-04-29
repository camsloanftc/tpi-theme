<?php get_header(); ?>

<?php
// Get first term, for category info
global $term_id;
$term_id = '';

$terms = get_the_terms( get_the_ID(), 'product_cat' );
if ( $terms && ! is_wp_error( $terms ) ) :
	foreach ( $terms as $term ) {
		$term_id = $term->term_id;
		$term_name = $term->name;
		$term_link = esc_url( get_term_link( $term ) );
		break;
	}
endif;
?>

<main>

<section id="section-p-cat-banner">

  <?php
  // Banner Background
  $cat_img = get_field('feat_img', 'product_cat_' . $term_id);

  echo '<div class="bg-img desktop" style="background-image:url(\'' . $cat_img['sizes']['panel_bg'] . '\');"></div>';
  echo '<div class="bg-img mobile" style="background-image:url(\'' . $cat_img['sizes']['panel_bg_mobile'] . '\');"></div>';
  ?>

  <div class="row">
    <div class="col span-12">

      <div id="p-cat-banner-content" class="white-text">

        <?php
        // Category Name Box
        echo '<div class="heading-box">';

          // "Products" Link
          echo '<h6><a href="' . get_bloginfo('url') . '/products/">Products</a> / <a href="' . $term_link . '">' . $term_name . '</a></h6>';

          // Category Name
          echo '<h1>' . get_the_title() . '</h1>';

        echo '</div>';


        // Blurb Box
        $cat_blurb = get_field('blurb', 'product_cat_' . $term_id);

        echo '<div class="blurb-box">';

          // Overlay
          echo '<div class="overlay cat-col-' . $term_id . ' cc-bg"></div>';

          // Blurb
          echo '<p class="blurb">' . $cat_blurb . '</p>';

        echo '</div>';
        ?>

      </div>

    </div>
  </div>
</section>

<section class="section-padding">
	<div class="row">
		<div class="col span-12">

			<?php
			// Flexible Product Panels
			global $page_layout;
			$page_layout = 'page';
			echo '<div class="cat-col-' . $term_id . ' cc-headings cc-buttons">';
			include(locate_template('flexible/flexible-products.php'));
			echo '</div>';

			// Related Products
			$rel = get_field('related_products');

			if( ! empty($rel) ){

				// Don't include current product
				if (($key = array_search(get_the_ID(), $rel)) !== false) {
					unset($rel[$key]);
				}

				$args = array(
					'post_type' => 'product',
					'post__in' => $rel,
				);

				$wp_query = new WP_Query($args);

				if( $wp_query->have_posts() ):

					// Enqueue scripts
					wp_enqueue_script('theme-flexslider');

					// Heading
					echo '<h3>Related Products</h3>';

					// open carousel
					echo '<div class="rel-products-carousel">';

						echo '<div class="loading"></div>';
						echo '<ul class="slides">';

							while( $wp_query->have_posts() ): $wp_query->the_post();

								// Product
								$rel_terms = get_the_terms( get_the_ID(), 'product_cat' );
								$rel_cat = '';

								if ( $rel_terms && ! is_wp_error( $rel_terms ) ) :
									foreach ( $rel_terms as $rel_term ) {
										$rel_cat = $rel_term;
										$rel_cat_id = $rel_term->term_id;
										break;
									}
								endif;

	              $link = get_permalink();

								// thumb
								$thumb = get_field('thumb');

								echo '<li><a href="' . $link . '" class="cat-col-' . $rel_cat_id . ' cc-border cc-color-hover"><img src="' . $thumb['sizes']['thumbnail'] . '" alt="' . get_the_title() . '" /><span class="title">' . get_the_title() . '</span></a></li>';

							endwhile;

						echo '</ul>';

					// close carousel
					echo '</div>';

				endif;

				wp_reset_query();

			}
			?>


		</div>
	</div>
</section>

</main>

<?php get_footer(); ?>
