<?php get_header(); ?>

<main>

<?php
// Queried Term
$queried_object = get_queried_object();

global $term_id;
$term_id = $queried_object->term_id;
$term_name = $queried_object->name;


$button_color = "";
if ( $term_id === 4 ) {
  $button_color = 'blue-button';
} else if ( $term_id === 3 ) {
  $button_color = 'green-button';
} else if ( $term_id === 5 ) {
  $button_color = 'orange-button';
}

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
        $show_blurb = get_field('show_blurb_on_landing_page', 'product_cat_' . $term_id);

        if ($show_blurb) {
          echo '<div class="blurb-box">';

          // Overlay
          echo '<div class="overlay cat-col-' . $term_id . ' cc-bg"></div>';

          // Blurb
          echo '<p class="blurb">' . $cat_blurb . '</p>';

          echo '</div>';
        }
        
        ?>

      </div>

    </div>
  </div>
</section>

<?php
// Flexible Content
global $flexible_rows;
$flexible_rows = 'product_cat_' . $term_id;
flexibleContent();
?>


<section id="section-p-cat-content">
  <div class="row">
    <div class="col span-12">

      <?php
      // Query Products in Category
      $html_out = '';

      if( $wp_query->have_posts() ):

        $html_out .= '<div id="p-cat-grid">';

        while( $wp_query->have_posts() ): $wp_query->the_post();
          $product_thumb = get_field('thumb');
          $product_thumb_src = $product_thumb['sizes']['medium'];
          $product_title = get_the_title();
          $product_link = get_the_permalink();

          $product_html = <<<HTML
          <div class="p-cat-grid__item">
            <div class="p-cat-card">
              <a class="p-cat-card__image-link" title="{$product_title}" href="{$product_link}"><img class="p-cat-card__image" src="{$product_thumb_src}" alt="{$product_title}" /></a>
              <h5 class="p-cat-card__title"><a href="{$product_link}">{$product_title}</a></h5>
              <a class="button p-cat-card__button {$button_color}" href="{$product_link}">View Product</a>
            </div>
          </div>    
HTML;
          $html_out .= $product_html;

        endwhile;

        $html_out .= '</div>';
        echo $html_out;

      endif;

      wp_reset_query();

      ?>

    </div>
  </div>
</section>

</main>

<?php get_footer(); ?>
