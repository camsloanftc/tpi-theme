jQuery(document).ready(function($){


	// ===== Products Mega Menu ===== //
	var menuSpeed = 250,
			menuSpeedFast = 100,
			menuDelay = 350,
			fadeOut = false,
			fadeTimeout;

	function fadeMegaMenu(){
		fadeTimeout = setTimeout(function(){
			if( fadeOut ){
				$('.pmm-sub').fadeOut(menuSpeed);
			}
		}, menuDelay);
	}

	// Products toggle
	$('.pmm').hover(
		function(){

			// Hover IN
			fadeOut = false;

			$('.pmm-sub').fadeIn(menuSpeed);

		}, function(){

			// Hover Out
			fadeOut = true;
			clearTimeout(fadeTimeout);

			fadeMegaMenu();

		}
	);


	// Category toggles
	$('.pmm-cat').hover(
		function(){

			// Hover IN
			var catID = $(this).data('id'),
					box = $('.pmm-box[data-id="' + catID + '"]'),
					otherBoxes = $('.pmm-box:not([data-id="' + catID + '"])');

			$('.pmm-cat').removeClass('active');
			$(this).addClass('active');

			otherBoxes.removeClass('over').addClass('under');
			box.stop().removeClass('under').addClass('over').fadeIn(menuSpeed);
			otherBoxes.stop().delay(menuSpeed).fadeOut(menuSpeedFast);

		}, function(){

			// Hover Out
			// do nothing!

		}
	);


	// ===== Main Navs ===== //
	var nav = $('#nav'),
			scrollTop = $(this).scrollTop(),
			lastScrollTop = $(this).scrollTop(),
			navHeight = 140,
			mobileNavHeight = 50,
			deltaNavHeight = navHeight - mobileNavHeight;

	// Toggle Navs
	function toggleNavs(){

		// Desktop
		if ( scrollTop > deltaNavHeight ) {
			nav.addClass('small');
		} else {
			nav.removeClass('small');
		}

		// Mobile
		if( scrollTop > lastScrollTop && scrollTop > mobileNavHeight ){
			nav.addClass('mobile-nav-hide');
		} else {
			nav.removeClass('mobile-nav-hide');
		}
	}

	// Check scroll every 0.5s
	var didScroll = false;
	$(window).scroll(function(){ didScroll = true; });
	setInterval(function(){
	    if( didScroll ){
				didScroll = false;
				scrollTop = $(this).scrollTop();
				toggleNavs();
				lastScrollTop = scrollTop;
	    }
	}, 250);

	// Toggle navs on init
	toggleNavs();


	// ===== Mobile Nav Toggles ===== //

	// Main toggle
	$('.mobile-nav-toggle').click(function(){
		$('body').toggleClass('mobile-nav-active');
	});

	// Search toggle
	$('#mobile-nav-search-toggle').click(function(){
		$('#mobile-nav-search input').focus();
	});


	// ===== Nav sub-menus ===== //

	// Append open/close buttons sub-menus
	$('#main-menu-mobile li').has('.sub-menu').addClass('has-children').append('<div class="expand-btn"></div>');

	// Toggle sub-menus
	$('.expand-btn').click(function(){
		var el = $(this),
				subMenu = el.siblings('.sub-menu').first(),
				parent = el.parent(),
				grandparent = parent.parent();

		if(parent.hasClass('opened')){
			// close sub-menu
			subMenu.slideUp(300);

			// close children (if any)
			parent.find('.opened .sub-menu').slideUp(300);
			parent.find('.opened').toggleClass('opened');
		} else {
			// open sub-menu
			subMenu.slideDown(300);

			// close other menus (if any are opened)
			grandparent.find('.opened .sub-menu').not(parent).slideUp(300);
			grandparent.find('.opened').not(parent).toggleClass('opened');
		}
		parent.toggleClass('opened');
	});

});
