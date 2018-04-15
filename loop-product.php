<div class="loop-product">

	<?php
	// Product
	$rel_terms = get_the_terms( get_the_ID(), 'product_cat' );
	$rel_cat = '';

	if ( $rel_terms && ! is_wp_error( $rel_terms ) ) :
		foreach ( $rel_terms as $rel_term ) {
			$rel_cat = $rel_term;
			$rel_cat_id = $rel_term->term_id;
			break;
		}
	endif;

	$link = get_permalink();

	// thumb
	$thumb = get_field('thumb');

	echo '<a href="' . $link . '" class="cat-col-' . $rel_cat_id . ' cc-border cc-color-hover"><img src="' . $thumb['sizes']['thumbnail'] . '" alt="' . get_the_title() . '" /><span class="title">' . get_the_title() . '</span></a>';
	?>

</div>
