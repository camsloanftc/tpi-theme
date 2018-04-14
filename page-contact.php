<?php
/* Template Name: Contact Page */
get_header(); ?>

<main>

<?php
// Flexible Content
flexibleContent();
?>

<section class="section-padding">
  <div class="row">

    <div class="col span-4 col-margin">

      <h4 class="line gold-line">Call Us</h4>

      <?php
			// Phones
			$phone_tf = get_field('phone_tf');
			$phone_local = get_field('phone_local');
      $fax = get_field('fax');
			?>

      <ul class="contact-phones">
				<li>Toll-Free Canada:<br /><a href="tel:<?php echo cleanPhoneNum($phone_tf); ?>"><?php echo $phone_tf; ?></a></li>
				<li>Outside Canada:<br /><a href="<?php echo cleanPhoneNum($phone_local); ?>"><?php echo $phone_local; ?></a></li>
				<li>Fax:<br /><span class="number"><?php echo $fax; ?></span></li>
			</ul>

      <?php
      // Address
      $address = get_field('contact_address');
      $footer_address = get_field('footer_address');
      $address_link = 'https://www.google.com/maps/dir//' . urlencode($footer_address);
      ?>

      <h4 class="line gold-line">Visit Us</h4>

      <p><?php echo $address ?><br /><a href="<?php echo $address_link; ?>" target="_blank">Get Directions</a>
      </p>

    </div>

    <div class="col span-8">

      <h4 class="line gold-line">Email Us</h4>

      <div class="contact-form-wrap">
        <?php
        // Contact Form
        echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]');
        ?>
      </div>

    </div>

  </div>
</section>


<?php
// Map
$map = get_field('map');
if( !empty($map) ):
?>

  <section id="section-contact-map">

    <div class="acf-map" data-zoomcontrol="true" data-draggable="true">
    	<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>" data-color="default"></div>
    </div>

  </section>

<?php endif; ?>


</main>

<?php get_footer(); ?>
