<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php'); 
	
	$videoID = $_GET['video'];
	
	$embed_code = wp_oembed_get( $videoID );
	
	echo $embed_code;
	
?>