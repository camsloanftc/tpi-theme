<!DOCTYPE html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('url'); ?>/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('url'); ?>/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('url'); ?>/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('url'); ?>/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('url'); ?>/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('url'); ?>/apple-touch-icon-152x152.png" />
	<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/apple-touch-icon-152x152.png" sizes="152x152" />
	<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php bloginfo('url'); ?>/favicon-16x16.png" sizes="16x16" />
	<meta name="application-name" content="<?php bloginfo('name'); ?>"/>
	<meta name="msapplication-TileColor" content="#FFFFFF" />
	<meta name="msapplication-TileImage" content="<?php bloginfo('url'); ?>/mstile-144x144.png" />

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,700" rel="stylesheet">

	<?php
	// Header Scripts
	$scripts_status = get_field('scripts_status', 'options');
	if( $scripts_status == 'live' ){
		echo get_field('header_scripts', 'options');
	}
	?>

	<?php
		// Add "noindex, nofollow" for thank you pages.
		global $post;

		$post_title = strtolower($post->post_title);
		$is_thank_you_page = strpos($post_title, 'thank you') !== false;

		if($post->post_type == 'page' && $is_thank_you_page){
			echo '<!-- noindex, nofollow added on thank you pages. -->';
			echo '<meta name="robots" content="noindex, nofollow" />';
		}

		d($post_title, $is_thank_you_page);
	?>

	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
// Body Scripts
if( $scripts_status == 'live' ){
	echo get_field('body_scripts', 'options');
}
?>

	<header id="nav">
		<div class="row">
			<div class="col span-12">

				<?php
				// Phones
				$phone_tf = get_field('phone_tf', 102);
				$phone_local = get_field('phone_local', 102);
				?>

				<div id="nav-inner">

					<a id="nav-logo" href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('template_url'); ?>/images/tri-pac-logo.svg" onerror="this.src='<?php bloginfo('template_url'); ?>/images/tri-pac-logo.png';this.onerror=null;" width="345" height="46" alt="Tri Pac Inc. logo" /></a>

					<ul id="mobile-nav-sec-menu" class="mobile-nav">
						<li class="mnsm-phone"><a href="tel:<?php echo cleanPhoneNum($phone_tf); ?>"><?php e_svgi('phone'); ?><span class="text"><?php echo $phone_tf; ?></span></a></li>
						<li class="mnsm-quote"><a href="<?php bloginfo('url'); ?>/quote/"><?php e_svgi('quote'); ?><span class="text">Get a Quote</span></a></li>
					</ul>

					<div id="nav-sec-menu">
						<?php e_svgi('phone'); ?>
						<p class="nsm-phone nsm-phone-tf">Toll-Free: <a href="tel:<?php echo cleanPhoneNum($phone_tf); ?>"><?php echo $phone_tf; ?></a></p>
						<p class="nsm-phone">Local: <a href="<?php echo cleanPhoneNum($phone_local); ?>"><?php echo $phone_local; ?></a></p>
						<?php get_search_form(); ?>
					</div>

					<?php
					// Main nav - Desktop
					wp_nav_menu( array(
						'menu' => 'Main Menu',
						'menu_id' => 'main-menu',
						'menu_class' => 'menu',
						'container' => false,
						'items_wrap' => '<ul id="%1$s" class="%2$s">' . products_mega_menu() . '%3$s</ul>',
					));
					?>

					<div id="nav-wrap">

						<a id="mobile-nav-close" class="mobile-nav mobile-nav-toggle" href="javascript:void(0);">Close</a>

						<div id="mobile-nav-search" class="mobile-nav">
							<?php get_search_form(); ?>
						</div>

						<?php
						// Main nav - Mobile
						wp_nav_menu( array(
							'menu' => 'Main Menu',
							'menu_id' => 'main-menu-mobile',
							'menu_class' => 'menu',
							'container' => false,
							'items_wrap' => '<ul id="%1$s" class="%2$s"><li class="mobile-nav"><a href="' . get_bloginfo('url') . '">Home</a></li>' . products_mega_menu_mobile() . '%3$s</ul>',
						));
						?>

					</div>

					<a id="mobile-nav-hamburger" class="mobile-nav mobile-nav-toggle" href="javascript:void(0);"><div><span></span><span></span><span></span><span></span></div></a>

					<a id="mobile-nav-search-toggle" class="mobile-nav mobile-nav-toggle" href="javascript:void(0);"><?php e_svgi('search'); ?></a>

					<div id="mobile-nav-mask" class="mobile-nav mobile-nav-toggle"></div>

				</div>

			</div>
		</div>
	</header>

	<div id="nav-spacer"></div>
