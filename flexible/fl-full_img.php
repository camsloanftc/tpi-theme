<?php
// Open Panel
openFlexible('full-img', null, true);

    // Image
    $img = get_sub_field('image');

    echo '<img class="full-img-img desktop" src="' . $img['sizes']['panel_bg'] . '" width="' . $img['sizes']['panel_bg-width'] . '" height="' . $img['sizes']['panel_bg-height'] . '" />';
    echo '<img class="full-img-img mobile" src="' . $img['sizes']['panel_bg_mobile'] . '" width="' . $img['sizes']['panel_bg_mobile-width'] . '" height="' . $img['sizes']['panel_bg_mobile-height'] . '" />';

    // Caption
    $caption = get_sub_field('caption');

    if( $caption ){

      $caption_link = get_sub_field('caption_link');
      $caption_external = get_sub_field('external_link');

      echo '<p class="fi-caption">';
        if( $caption_link ) echo '<a href="' . $caption_link . '" ' . ( $caption_external ? 'target="_blank"' : '' ) . '>';
          echo $caption;
        if( $caption_link ) echo '</a>';
      echo '</p>';

    }

closeFlexible(true);
?>
