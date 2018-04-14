<?php
// Open Panel
openFlexible('product-cats', null, true);

  // Product Categories
  $terms = get_terms( 'product_cat' );
  if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

    echo '<div class="row">';

      foreach ( $terms as $term ) {

        // Fields
        $cat_blurb = get_field('blurb', 'product_cat_' . $term->term_id);

        echo '<div class="col span-4">';

          // Content Wrap
          echo '<div class="row"><div class="col span-12"><div class="content-wrap">';

            // Name & Blurb
            echo '<div class="content cat-col-' . $term->term_id . ' cc-headings">';

              echo '<h3>' . $term->name . '</h3>';

              echo '<p class="blurb">' . $cat_blurb . '</p>';

            echo '</div>';

            echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="explore">Explore<span> Products</span></a>';

        echo '</div></div></div>';

        echo '</div>';
      }

    echo '</div>';
  }

closeFlexible(true);
?>
