<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php');

	$date = ($_GET['date']) ? esc_attr($_GET['date']) : date( 'Y-m-d' );
	$room = ($_GET['room']) ? esc_attr($_GET['room']) : null;
	$capacity = ($_GET['capacity']) ? esc_attr($_GET['capacity']) : null;
?>

<?php
	$args = array (
		'post_type' => 'product',
		'meta_query' => array(
			array(
				'key'     => '_wc_booking_availability',
			),
		),
		'orderby' => 'title',
		'order' => 'ASC'
	);
	
	if($room && $room != 'none') {
		$room_array = explode("_", $room);
		$room_slug = $room_array[0];
		$args = array (
			'post_type' => 'product',
			'name' => $room_slug,
			'meta_query' => array(
				array(
					'key'     => '_wc_booking_availability',
				),
			),
			'orderby' => 'title',
			'order' => 'ASC'
		);
	} else if($capacity && $capacity != 'none') {
		$capacity_array = explode("-", $capacity);
		$capacity_floor = intval($capacity_array[0]);
		$capacity_ceiling = intval($capacity_array[1]);
		if($capacity_ceiling == 1000) {
			$capacity_ceiling == 999999;
		}
		
		$args = array (
			'post_type' => 'product',
			'meta_query' => array(
				'relation' => 'AND',
				array(
					'key'     => '_wc_booking_availability',
				),
				array(
					'key'  => 'capacity',
					'value' => 	$capacity_floor,
					'type' => 'NUMERIC',
					'compare' => '>=',
				),
				array(
					'key'  => 'capacity',
					'value' => 	$capacity_ceiling,
					'type' => 'NUMERIC',
					'compare' => '<=',
				),
			),
			'orderby' => 'title',
			'order' => 'ASC'
		);
	}
	

	$booked = new WP_Query($args);
	
	$bookedProducts = array();
	
	while( $booked->have_posts() ) : $booked->the_post();
?>
	<?php 
		$product = get_product($post->ID);
		$book_product = new WC_Product_Booking($product);
		
		$startDate = date( 'Y-m-d H:i:s', strtotime( "+8 HOUR", strtotime($date)) );
		$endDate = date( 'Y-m-d H:i:s', strtotime( "+16 HOUR", strtotime($date) )  );
		
		$resources = $book_product->get_resources();
		$hasAvailable = false;
		if($resources) {
			foreach($resources as $resource) {
				$bookings = $book_product->get_available_bookings(strtotime($startDate), strtotime($endDate), $resource->ID);
				if($bookings) {
					$hasAvailable = true;
				}
			}
		} else {
			$bookings = $book_product->get_available_bookings(strtotime($startDate), strtotime($endDate));
			if($bookings) {
				$hasAvailable = true;
			}
		}
		$productAvailibility = $hasAvailable;
		
		$bookedProducts[$post->ID] = $productAvailibility;
	endwhile; 
	wp_reset_postdata();
?>

<?php foreach($bookedProducts as $product_id => $bookedProduct) { ?>
	<?php 
		if($bookedProduct) {
			$product = get_product($product_id);		
	?>
		<div class="bookable_product">
			<div class="left_content">
				<h3><a href="<?php echo get_the_permalink($product_id); ?>"><?php echo get_the_title($product_id); ?></a></h3>
			</div>
			<div class="right_content">
				<?php $post = get_post($product_id); setup_postdata($post); ?>
				<p>Location: <?php the_field('location', $product_id); ?></p>
				<p>Capacity: <?php the_field('capacity', $product_id); ?> People</p>
				<p>Equipment includes: <?php the_field('included_equipment', $product_id); ?></p>
				<?php 
					/*$add_ons = get_product_addons($product_id); 
					if($add_ons) { 
						for($i = 0; $i < count($add_ons); $i++) { 
							$add_on_array = $add_ons[$i];
							if($add_on_array['name'] == 'Equipment') {
								$options = $add_on_array['options'];
								if($options) {
									for($j = 0; $j < count($options); $j++) {
										if($j == 0) { 
											echo $options[$j]['label']; 
										} else { 
											echo ', '.$options[$j]['label']; 
										}
									}
								}
							}
						}
					} */
				?>
				<p>Description: <?php echo $post->post_excerpt; ?></p>
				<div class="standard_btn"><a href="<?php echo get_the_permalink($product_id); ?>?date=<?php echo esc_attr($date); ?>">Reserve this Room</a></div>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>
	<?php } ?>
<?php } ?>