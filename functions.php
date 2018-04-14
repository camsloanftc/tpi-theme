<?php
// Google API Key
global $google_api_key;
$google_api_key = 'AIzaSyASBgZVVSdzRuW_4No6M-JXToKDoEZcS9U';


// Scripts & Styles Enqueues
require_once(locate_template('functions/functions-enqueues.php'));

// CPTs
require_once(locate_template('functions/functions-cpts.php'));

// Theme
require_once(locate_template('functions/functions-theme.php'));

// Core Functions
require_once(locate_template('functions/functions-core.php'));

// Tiny MCE
require_once(locate_template('functions/functions-tiny-mce.php'));

// Flexible Content
require_once(locate_template('functions/functions-flexible-content.php'));
?>
