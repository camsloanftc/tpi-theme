jQuery(document).ready(function($){

	// ========== Flexible - LightGallery ========== //

	// Photo Gallery
	if( $('.lightgallery-gallery').length ){

		$('.lightgallery-gallery').lightGallery({
			selector: '.lightgallery-item',
		});
	}


	// Video Gallery
	if( $('.lightgallery-video').length ){

		$('.lightgallery-video').lightGallery({
		    selector: 'this',
		    zoom: false,
		    counter: false,
		    download: false,
				youtubePlayerParams: {
					rel: 0,
				},
		});

	}

});
