<?php
/**
 * Booking product add to cart
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) {
	return;
}

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<noscript><?php _e( 'Your browser must support JavaScript in order to make a booking.', 'woocommerce-bookings' ); ?></noscript>

<form class="cart" method="post" enctype='multipart/form-data'>

 	<div id="wc-bookings-booking-form" class="wc-bookings-booking-form">
	 	
	 	<?php 
		 	$date = isset( $_REQUEST['date'] ) ? absint( $_REQUEST['date'] ) : date( 'Ymd' );
		 	
		 	/*$prevDate1 = date('Y-m-d', strtotime("-1 DAY", strtotime($date)));
		 	$prevDate2 = date('Y-m-d', strtotime("-2 DAY", strtotime($date)));
		 	$nextDate1 = date('Y-m-d', strtotime("+1 DAY", strtotime($date)));
		 	$nextDate2 = date('Y-m-d', strtotime("+2 DAY", strtotime($date)));
		 	
		 	$dates = [$prevDate2, $prevDate1, $date, $nextDate1, $nextDate2];*/
	 	?>
	 	
		<?php 
			/*$book_product = new WC_Product_Booking($product);
			
			$bookedProducts = array();
			
			for ( $i = 0; $i < 5; $i ++ ) :
				$currentDate = $dates[$i];
				$productArray = array();
				for ( $ii = 8; $ii < 18; $ii ++ ) :
					$j = $ii+1;
					$startDate = date( 'Y-m-d H:i:s', strtotime( "+$ii HOUR", strtotime( $currentDate ) ) );
					$endDate = date( 'Y-m-d H:i:s', strtotime( "+$j HOUR", strtotime( $currentDate ) ) );
					
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
					$productArray[] = $hasAvailable;
				endfor;
				
				$bookedProducts[$i] = $productArray;
			endfor;*/
		?>
	 	
	 	<?php 
	 	/*<!--<div class="time_filter">
		 	<select id="start_time">
			 	<option value="8">8:00 AM</option>
			 	<option value="9">9:00 AM</option>
			 	<option value="10">10:00 AM</option>
			 	<option value="11">11:00 AM</option>
			 	<option value="12">12:00 PM</option>
			 	<option value="13">1:00 PM</option>
			 	<option value="14">2:00 PM</option>
			 	<option value="15">3:00 PM</option>
			 	<option value="16">4:00 PM</option>
			 	<option value="17">5:00 PM</option>
		 	</select>
		 	<select id="duration">
			 	<option value="1">1 Hour</option>
			 	<option value="2">2 Hours</option>
			 	<option value="3">3 Hours</option>
			 	<option value="4">4 Hours</option>
			 	<option value="5">5 Hours</option>
			 	<option value="6">6 Hours</option>
		 	</select>
		 	<div class="standard_btn"><a href="#">Reserve</a></div>
	 	</div>
	 	
	 	<div class="bookings_header">
			<ul class="bookings_sub_nav">
				<li class="previous_button">
					<a href="?date=<?php echo $prevDate1; ?>"><i class="fa fa-chevron-left"></i></a>
				</li>
				<li class="bookings_nav_previous">
					<a href="?date=<?php echo $prevDate2; ?>"><?php echo date('F d', strtotime($prevDate2)); ?></a>
				</li>
				<li class="bookings_nav_previous">
					<a href="?date=<?php echo $prevDate1; ?>"><?php echo date('F d', strtotime($prevDate1)); ?></a>
				</li>
				<li class="current_month"><a href="#"><?php echo date('F d', strtotime($date)); ?></a></li>
				<li class="bookings_nav_next">
					<a href="?date=<?php echo $nextDate1; ?>"><?php echo date('F d', strtotime($nextDate1)); ?></a>
				</li>
				<li class="bookings_nav_next">
					<a href="?date=<?php echo $nextDate2; ?>"><?php echo date('F d', strtotime($nextDate2)); ?></a>
				</li>
				<li class="next_button">
					<a href="?date=<?php echo $nextDate1; ?>"><i class="fa fa-chevron-right"></i></a>
				</li>
			</ul>
	 	</div>
	 	
	 	<div class="time_table">
		 	<div class="left_column">
			 	<ul>
				 	<li>8 AM</li>
				 	<li>9 AM</li>
				 	<li>10 AM</li>
				 	<li>11 AM</li>
				 	<li>12 PM</li>
				 	<li>1 PM</li>
				 	<li>2 PM</li>
				 	<li>3 PM</li>
				 	<li>4 PM</li>
				 	<li>5 PM</li>
				 	<li>6 PM</li>
			 	</ul>
		 	</div>
		 	<div class="right_column">
			 	<?php for($i = 0; $i < 10; $i++) : ?>
			 		<?php for($ii = 0; $ii < 5; $ii++) : ?>
			 			<?php $hasAvailable = $bookedProducts[$ii][$i]; ?>
			 			<div class="bookable_time <?php if($hasAvailable) { echo 'available_time'; } ?>"></div>
			 		<?php endfor; ?>
			 	<?php endfor; ?>
		 	</div>
	 	</div>*/
	 	?>

 		<?php $booking_form->output(); ?>

 		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

 		<div class="wc-bookings-booking-cost" style="display:none"></div>

	</div>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

 	<button disabled="disabled" type="submit" class="wc-bookings-booking-form-button single_add_to_cart_button button alt" style="display:none"><?php echo $product->single_add_to_cart_text(); ?></button>

 	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<script defer type="text/javascript">
	jQuery(document).ready(function($){
		
		var page_title = $('.product_title').text();
		console.log(page_title);
		
		var productDuration = '<?php if($product->get_duration()) { echo $product->get_duration(); } ?>';
		
		$(window).bind('load', function(e) {		
			var date = '<?php echo $date; ?>';
			var dateArray = date.substring(0, 4);
			var year = date.substring(0, 4);
			var month = date.substring(4, 6);
			var day = date.substring(6, 8);
		
			$('input[name="wc_bookings_field_start_date_year"]').val(year);
			$('input[name="wc_bookings_field_start_date_month"]').val(month);
			$('input[name="wc_bookings_field_start_date_day"]').val(day).trigger('change');
			
			$('input[name="wc_bookings_field_start_date_day"]').trigger('input');			
		});
		
		$('.block-picker').on('click', 'a', function(){
			var startTime = $(this).text();
			var endTime;
			if($('input[name="wc_bookings_field_duration"]').val()) {
				var currentDate = new Date();
				var currentHour = $(this).attr('data-value');
				var hours = parseInt(currentHour.split(':')[0]);
				var duration = parseInt($('input[name="wc_bookings_field_duration"]').val());
				hours = hours+duration;
				currentDate.setHours(hours);
				currentDate.setMinutes(0);
				
				var currentHours = currentDate.getHours();
				var morning = 'am';
				if(currentHours >= 12) {
					if(currentHours > 12) {
						currentHours = currentHours-12;
					}
					morning = 'pm';
				}
				endTime = currentHours+':00 '+morning;
			} else {
				var currentDate = new Date();
				var currentHour = $(this).attr('data-value');
				var hours = parseInt(currentHour.split(':')[0]);
				hours = hours+parseInt(productDuration);
				currentDate.setHours(hours);
				currentDate.setMinutes(0);
				
				var currentHours = currentDate.getHours();
				var morning = 'am';
				if(currentHours >= 12) {
					if(currentHours > 12) {
						currentHours = currentHours-12;
					}
					morning = 'pm';
				} else if(currentHours == 0) {
					currentHours = 12;
				}
				endTime = currentHours+':00 '+morning;
			}
			
			$('.title_row .page_title').text('Select Preferred Time: '+page_title+' ( '+startTime+' - '+endTime+' )');
		});
		
		$('input[name="wc_bookings_field_duration"]').on('change', function(e) {
			$('.title_row .page_title').text('Select Preferred Time: '+page_title);
		});
		
		$('button').text('Reserve');
		
		$('label[for="wc_bookings_field_start_date"]').text('Start Time:');
	});
</script>