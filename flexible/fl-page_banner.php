<?php
// Open Panel
openFlexible('page-banner', null, true);

  // Banner Background
  $bg_img = get_sub_field('bg_img');

  echo '<div class="bg-img desktop" style="background-image:url(\'' . $bg_img['sizes']['panel_bg'] . '\');"></div>';
  echo '<div class="bg-img mobile" style="background-image:url(\'' . $bg_img['sizes']['panel_bg_mobile'] . '\');"></div>';
  ?>

  <div class="row">
    <div class="col span-12">

      <div class="page-banner-wrap white-text">

        <?php
        // Left Content
        echo '<div class="left-content">';
          echo get_sub_field('left_content');
        echo '</div>';

        // Blurb Box
        $box_colour = get_sub_field('box_colour');
        $box_text = get_sub_field('right_content');

        echo '<div class="blurb-box col-' . $box_colour . '">';
          echo '<p class="blurb">' . $box_text . '</p>';
        echo '</div>';
        ?>

      </div>

    </div>
  </div>


<?php
// Close Panel
closeFlexible(true);
?>
