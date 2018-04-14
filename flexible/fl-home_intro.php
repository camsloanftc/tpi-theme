<?php
// Open Panel
openFlexible('home-intro', null, true);

    // Background Image
    $bg = get_sub_field('bg_img');

    echo '<div class="bg-img desktop" style="background-image:url(\'' . $bg['sizes']['panel_bg'] . '\');"></div>';
    echo '<div class="bg-img mobile" style="background-image:url(\'' . $bg['sizes']['panel_bg_mobile'] . '\');"></div>';

    // Content & Categories
    echo '<div class="row"><div class="col span-12"><div class="home-intro-wrap">';

      // Content
      echo '<div class="content white-text">' . get_sub_field('content') . '</div>';

      // Product Categories
      $terms = get_terms( 'product_cat' );
      if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

        echo '<ul class="product-cats">';

          foreach ( $terms as $term ) {

            echo '<li class="cat-col-' . $term->term_id . ' cc-bg"><a href="' . esc_url( get_term_link( $term ) ) . '">';

              echo '<h3>' . $term->name . '</h3>';

              echo '<span class="explore">Explore<span> Products</span></span>';

            echo '</a></li>';

          }

        echo '</ul>';

      }

    echo '</div></div></div>';


closeFlexible(true);
?>
