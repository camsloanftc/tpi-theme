<?php get_header(); ?>

<main>

<?php
// Queried Term
$queried_object = get_queried_object();

global $term_id;
$term_id = $queried_object->term_id;
$term_name = $queried_object->name;
?>

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
          echo '<h6><a href="' . get_bloginfo('url') . '/products/">Products</a></h6>';

          // Category Name
          echo '<h1>' . $term_name . '</h1>';

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

<section id="section-p-cat-content">
  <div class="row">
    <div class="col span-12">

      <?php
      // Query Products in Category
      $carousel = '';
      $products = '';

      if( $wp_query->have_posts() ):

        while( $wp_query->have_posts() ): $wp_query->the_post();


          // ===== Append to carousel ===== //
          $thumb = get_field('thumb');

          // open li, link
          $carousel .= '<li class="p-cat-tab"><a href="javascript:void(0);" class="p-cat-tab-link inactive cat-col-' . $term_id . ' cc-border cc-color-hover" data-pid="' . get_the_ID() . '">';

            // image and title
            $carousel .= '<img src="' . $thumb['sizes']['thumbnail'] . '" alt="' . get_the_title() . '" /><span class="title">' . get_the_title() . '</span>';

          // close li, link
          $carousel .= '</a></li>';



          // ===== Append to product ===== //
          $products .= '<div class="p-cat-product inactive" data-pid="' . get_the_ID() . '">';

            // Flexible Product Panels
            global $page_layout;
            $page_layout = 'tabs';
            ob_start();
            include(locate_template('flexible/flexible-products.php'));
            $products .= ob_get_clean();

          $products .= '</div>';


        endwhile;

      endif;

      wp_reset_query();


      // Product Tabs
      echo '<div id="p-cat-tabs">';

        // Carousel
        echo '<div id="p-cat-carousel-wrap"><a class="tab-arrow active arrow-prev cat-col-' . $term_id . ' cc-bg" href="javascript:void(0);">' . svgi('arrow-down') . '</a><a class="tab-arrow active arrow-next cat-col-' . $term_id . ' cc-bg" href="javascript:void(0);">' . svgi('arrow-down') . '</a><ul id="p-cat-carousel">' . $carousel . '</ul></div>';


        // Tab Contents
        echo '<div id="p-cat-products" class="cat-col-' . $term_id . ' cc-headings cc-buttons">' . $products . '</div>';

      echo '</div>';
      ?>

    </div>
  </div>
</section>


<?php
// Flexible Content
global $flexible_rows;
$flexible_rows = 'product_cat_' . $term_id;
flexibleContent();
?>


</main>

<?php get_footer(); ?>
