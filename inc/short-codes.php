<?php
/**
 * boiler Custom Short Codes
 *
 * @package boiler
 */


function stand_button($atts, $content = null){
	extract (shortcode_atts(array(
		'link' => 'null',
	), $atts));
	
	return "<div class='standard_btn'><a href='$link'>".$content."</a></div>";
}
add_shortcode('button', 'stand_button');


function caption_image($atts, $content = null) {
	extract (shortcode_atts(array(
		'caption' => 'null',
	), $atts));
	
	return "<div class='caption_image'>".$content."<h3>$caption</h3></div>";
}
add_shortcode('caption_image', 'caption_image');

function br_login_form($atts, $content = null){
	extract (shortcode_atts(array(
	
	), $atts));
	
	return '<a href="#login" class="log_in">' . $content . '</a>';
}
add_shortcode('login', 'br_login_form');

function br_whitebox($atts, $content = null) {
	extract (shortcode_atts(array(
		
	), $atts));
	
	return '<div class="white_box">' . $content . '</div>';
}
add_shortcode('white_box', 'br_whitebox');

function br_google_map($atts, $latitude, $longitude) {
	extract (shortcode_atts(array(
		'height'	=> 'null',
		'latitude' => 'null',
		'longitude' => 'null'
	), $atts));
	
	$markers;
	
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	
	if(have_rows('dn_markers', 'options')) {
		while(have_rows('dn_markers', 'options')) { the_row();
			$latLng = '[' . get_sub_field('latitude') . ',' . get_sub_field('longitude') . '],';
			$markers .= $latLng;
		}
	}
	
	endwhile; else:
	
	endif;
	
	return "<div id='map-canvas' style='height:$height;'></div>
	<script type='text/javascript'
	src='https://maps.googleapis.com/maps/api/js?key=AIzaSyBxiMWbAoYB8myIF-SNdXYR9krn53Tb5hw'>
	</script>
	
	<script type='text/javascript'>
      function initialize() {
        var mapOptions = {
          center: { lat: $latitude, lng: $longitude},
          zoom: 16
        };
        
        var marker;
        
        function setMarkers(map, marker) {
		var markerArray = [$markers];
	        for (var i = 0; i < markerArray.length; i++) {
	            var sites = markerArray[i];
	            var siteLatLng = new google.maps.LatLng(sites[0], sites[1]);
	            marker = new google.maps.Marker({
	                position: siteLatLng,
	                map: map
	            });
	        }
        }

        var map = new google.maps.Map(document.getElementById('map-canvas'),
            mapOptions);
            
        setMarkers(map, marker);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>";
}
add_shortcode('google_map', 'br_google_map');