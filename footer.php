<footer id="footer">
	<div class="row">
		<div class="col span-12">

			<?php
			// Phones
			$phone_tf = get_field('phone_tf', 102);
			$phone_local = get_field('phone_local', 102);
			?>

			<ul class="footer-ctas">
				<li class="footer-phone">Toll-Free Canada:<br /><a href="tel:<?php echo cleanPhoneNum($phone_tf); ?>"><?php echo $phone_tf; ?></a></li>
				<li class="footer-phone">Outside Canada:<br /><a href="<?php echo cleanPhoneNum($phone_local); ?>"><?php echo $phone_local; ?></a></li>
				<li class="footer-link"><a href="<?php bloginfo('url'); ?>/quote/"><?php e_svgi('quote'); ?><span class="text">Get a Quote</span></a></li>
				<li class="footer-link"><a href="<?php bloginfo('url'); ?>/contact/"><?php e_svgi('mail'); ?><span class="text">Email Us</span></a></li>
			</ul>

		</div>
		<div class="col span-12 footer__bottom-container">
			<div class="footer__bottom-left">
				<ul class="footer-address">
					<li><a href="<?php bloginfo('url'); ?>/contact/"><?php the_field('footer_address', 102); ?></a></li>
				</ul>

				<ul class="footer-copy">
					<li>&copy;<?php echo date('Y'); ?> Tri Pac Inc.</li>
					<li><a href="/privacy-policy/">Privacy Policy</a></li>
				</ul>
			</div>
			<div class="footer__bottom-right">
				<img class="footer__mlb-logo" src="<?php echo get_bloginfo( 'template_directory' ) . '/images/MLB-tripac-logo.jpg'; ?>"/>
			</div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<?php
// Footer Scripts
$scripts_status = get_field('scripts_status', 'options');
if( $scripts_status == 'live' ){
	echo get_field('footer_scripts', 'options');
}
?>

</body>
</html>
