<?php
global $page_layout;
global $term_id;

// ========== Flexible Content Panels Loop ========== //
echo '<div class="p-panels">';

if( have_rows('p_panels') ) :

	while ( have_rows('p_panels') ) : the_row();

		$layout = get_row_layout();

		switch( $layout ){



			// Content - Full
			case 'content_full':

				$content = get_sub_field('content');
				echo '<div class="p-panel pp-content-full">' . $content . '</div>';

				break;



			// Content - Split
			case 'content_split':

				$content_left = get_sub_field('content_left');
				$content_right = get_sub_field('content_right');

				echo '<div class="p-panel pp-content-split">';
					echo '<div class="content-left">' . $content_left . '</div>';
					echo '<div class="content-right">' . $content_right . '</div>';
				echo '</div>';

				break;


			// Specs Table
			case 'specs_table':

				echo '<div class="p-panel pp-specs-table">';

					// Table Heading
					$table_title = get_sub_field('table_title');
					if( $table_title ) echo '<span class="st-title">' . $table_title . '</span>';

					// Table
					include(locate_template('flexible/fl-product_table.php'));


				echo '</div>';

				break;



			// PDF Download Buttons
			case 'pdf_buttons':

				$buttons = get_sub_field('buttons', 'options');
				echo '<div class="p-panel pp-pdf-buttons">';

					echo '<ul class="pdf-buttons-list">';

					foreach($buttons as $button){
						$label = $button['label'];
						$file = $button['file'];

						echo '<li><a class="button" href="' . $file . '" target="_blank">' . $label . '</a></li>';
					}

					echo '</ul>';

				echo '</div>';

				break;



			// Photo Gallery
			case 'photo_gallery':

				// enqueue scripts
				wp_enqueue_style('lightgallery-css');
				wp_enqueue_script('theme-lightgallery');

				echo '<div class="p-panel pp-photo-gallery">';

					$images = get_sub_field('gallery');

					if( $images ){

						// Heading
						echo '<h3>Gallery</h3>';

						echo '<ul class="product-gallery lightgallery-gallery">';

							foreach( $images as $image ){

								$caption = $image['caption'];

								echo '<li><a class="lightgallery-item cat-col-' . $term_id . ' cc-border" href="' . $image['url'] . '"' . ($caption ? ' data-sub-html="' . $caption . '"' : '') . '><img src="' . $image['sizes']['thumbnail'] . '" alt="' . $image['alt'] . '" /><span class="view">' . svgi('search') . '</span></a></li>';
							}

						echo '</ul>';

					}

				echo '</div>';

				break;



			// "Read More"
			case 'read_more':

				if( $page_layout == 'tabs' ){

					// Show button
					$button_text = get_sub_field('button_text');
					echo '<div class="p-panel pp-read-more">';
						echo '<a class="button" href="' . get_permalink() . '">' . $button_text . '</a>';
					echo '</div>';

					// Exit switch, then while loop
					break 2;

				}

				break;



		}

	endwhile;

endif;

echo '</div>';
?>
