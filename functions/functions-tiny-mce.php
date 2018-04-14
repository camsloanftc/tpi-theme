<?php
// ================================== //
// ============ TINY MCE ============ //
// ================================== //

// Edit second row button
function custom_mce_buttons_2($buttons){

	// Add buttons
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';
	$buttons[] = 'styleselect';

	// Remove buttons
	$remove = array('forecolor');
	return array_diff($buttons,$remove);

	return $buttons;
}
add_filter('mce_buttons_2', 'custom_mce_buttons_2');


// Add Formats button custom content
function custom_tinymce_settings($settings){
	$new_styles = array(

		// Colours
		array(
			'title'	=> 'Colour',
			'items'	=> array(
				array(
					'title'		=> 'Disable Auto Colourize',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'no-auto-color',
				),
				array(
					'title'		=> 'Gold',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'gold',
				),
				array(
					'title'		=> 'Black',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'black',
				),
				array(
					'title'		=> 'Grey',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'grey',
				),
				array(
					'title'		=> 'Pale Grey',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'palegrey',
				),
				array(
					'title'		=> 'Blue',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'blue',
				),
				array(
					'title'		=> 'Green',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'green',
				),
				array(
					'title'		=> 'Orange',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'orange',
				),
			),
		),

		// Decorations (lines)
		array(
			'title'	=> 'Heading Decorations',
			'items'	=> array(
				array(
					'title'		=> 'Black Glow',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'black-glow',
				),
				array(
					'title'		=> 'Gold Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'gold-line line',
				),
				array(
					'title'		=> 'Black Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'black-line line',
				),
				array(
					'title'		=> 'Grey Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'grey-line line',
				),
				array(
					'title'		=> 'Pale Grey Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'palegrey-line line',
				),
				array(
					'title'		=> 'Blue Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'blue-line line',
				),
				array(
					'title'		=> 'Green Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'green-line line',
				),
				array(
					'title'		=> 'Orange Line',
					'selector'	=> 'h1,h2,h3,h4,h5,h6',
					'classes'	=> 'orange-line line',
				),
			),
		),

		// Size
		array(
			'title'	=> 'Size',
			'items'	=> array(
				array(
					'title'		=> 'Small',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'small',
				),
				array(
					'title'		=> 'Large',
					'selector'	=> 'h1,p,ol,ul',
					'classes'	=> 'large',
				),
			),
		),

		// Weight
		array(
			'title'	=> 'Weight',
			'items'	=> array(
				array(
					'title'		=> 'Thin',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'thin',
				),
				array(
					'title'		=> 'Normal',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'normal',
				),
				array(
					'title'		=> 'Bold',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p,li',
					'classes'	=> 'bold',
				),
				array(
					'title'		=> 'Thin (select span)',
					'inline'	=> 'span',
					'classes'	=> 'thin',
				),
				array(
					'title'		=> 'Normal (select span)',
					'inline'	=> 'span',
					'classes'	=> 'normal',
				),
				array(
					'title'		=> 'Bold (select span)',
					'inline'	=> 'span',
					'classes'	=> 'bold',
				),
			),
		),

		// Spacing
		array(
			'title'	=> 'Spacing',
			'items'	=> array(
				array(
					'title'		=> 'More Bottom Spacing',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p',
					'classes'	=> 'more-bottom-spacing',
				),
				array(
					'title'		=> 'Less Bottom Spacing',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p',
					'classes'	=> 'less-bottom-spacing',
				),
				array(
					'title'		=> 'No Bottom Spacing',
					'selector'	=> 'h1,h2,h3,h4,h5,h6,p',
					'classes'	=> 'no-bottom-spacing',
				),
			),
		),

		// Images
		array(
			'title'	=> 'Images',
			'items'	=> array(
				array(
					'title'		=> 'Image Shadow',
					'selector'	=> 'img',
					'classes'	=> 'shadow',
				),
				array(
					'title'		=> 'Image Border',
					'selector'	=> 'img',
					'classes'	=> 'border',
				),
			),
		),

		// Lists
		array(
			'title'	=> 'Lists',
			'items'	=> array(
				array(
					'title'		=> 'Large List',
					'selector'	=> 'ul',
					'classes'	=> 'large',
				),
			),
		),

		// Links
		array(
			'title'	=> 'Links',
			'items'	=> array(
				array(
					'title'		=> 'Button (auto colour)',
					'selector'	=> 'a',
					'classes'	=> 'button',
				),
				array(
					'title'		=> 'Blue Button',
					'selector'	=> 'a',
					'classes'	=> 'button blue-button',
				),
				array(
					'title'		=> 'Green Button',
					'selector'	=> 'a',
					'classes'	=> 'button green-button',
				),
				array(
					'title'		=> 'Orange Button',
					'selector'	=> 'a',
					'classes'	=> 'button orange-button',
				),
			),
		),
	);

	$settings['style_formats_merge'] = false;
	$settings['style_formats'] = json_encode($new_styles);

	// Toggle second row of buttons by default
	$settings['wordpress_adv_hidden'] = false;

	return $settings;
}
add_filter('tiny_mce_before_init', 'custom_tinymce_settings');
?>
