<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php'); 
	
	$image = $_GET['image'];

	echo wp_get_attachment_image($image, 'full');
?>