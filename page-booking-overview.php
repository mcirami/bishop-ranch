<?php 
/* *
 * Template Name: Bookings Overview
 *	
 * @package boiler
 */

 get_header(); ?>
	<section class="page wrapper calendar">
		<div class="container">
			<div class="title_row">
				<h1 class="page_title"><?php the_title(); ?></h1>
			</div>
			
			<div class="top_content">
				<?php the_content(); ?>
			</div>
			
			<?php 
				$month          = isset( $_REQUEST['calendar_month'] ) ? absint( $_REQUEST['calendar_month'] ) : date( 'n' );
				$year           = isset( $_REQUEST['calendar_year'] ) ? absint( $_REQUEST['calendar_year'] ) : date( 'Y' );
				
				$monthName = date('F', strtotime("$year-$month-1"));
	
				if ( $year < ( date( 'Y' ) - 10 ) || $year > 2100 )
					$year = date( 'Y' );
	
				if ( $month > 12 ) {
					$month = 1;
					$year ++;
				}
	
				if ( $month < 1 ) {
					$month = 1;
					$year --;
				}
				
				$nextMonth = $month+1;
				$prevMonth = $month-1;
				$nextMonthYear = $year;
				$prevMonthYear = $year;
				
				if($nextMonth > 12) {
					$nextMonth = 1;
					$nextMonthYear++;
				}
				
				if($prevMonth <= 0) {
					$prevMonth = 12;
					$prevMonthYear--;
				}
				
				$nextMonthName = date('F', strtotime("$year-$nextMonth-1"));
				$prevMonthName = date('F', strtotime("$year-$prevMonth-1"));
	
				$start_week = (int) date( 'W', strtotime( "first day of $year-$month" ) );
				$end_week   = (int) date( 'W', strtotime( "last day of $year-$month" ) );
	
				if ( $end_week == 1 )
					$end_week = 53;			
			?>
			
			<?php
				$args = array (
					'post_type' => 'product',
					'meta_query' => array(
						array(
							'key'     => '_wc_booking_availability',
						),
					),
				);
			
				$booked = new WP_Query($args);
				
				$bookedProducts = array();
				$capacities = array();
			
				while( $booked->have_posts() ) : $booked->the_post();
			?>
				<?php
					$product = get_product($post->ID);
					$book_product = new WC_Product_Booking($product);
					
					$productArray = array();
					
					for ( $i = $start_week; $i <= $end_week; $i ++ ) :
						for ( $ii = 0; $ii < 7; $ii ++ ) :
							$startDate = date( 'Y-m-d H:i:s', strtotime( "+8 HOUR", strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ) );
							$endDate = date( 'Y-m-d H:i:s', strtotime( "+16 HOUR", strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ) );
							
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
					endfor;
					
					$bookedProducts[$post->post_name] = $productArray;
					$capacities[$post->post_name] = get_field('capacity');
				endwhile; 
				wp_reset_postdata();
			?>
			
			<div class="bookings_calendar_container">
				<div class="bookings_filter">
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
					
						$booked = new WP_Query($args);
					?>
					
					<select id="conference_room">
						<option value="none" selected="selected">Select Room</option>
						<?php
							while( $booked->have_posts() ) : $booked->the_post();
						?>
							<option value="<?php echo $post->post_name.'_'.get_field('capacity', $post->ID); ?>"><?php the_title(); ?></option>
							
						<?php endwhile; wp_reset_postdata(); ?>
					</select>
					<select id="room_capacity">
						<option value="none" selected="">Select Capacity</option>
						<option value="0-19">0-19</option>
						<option value="20-49">20-49</option>
						<option value="50-99">50-99</option>
						<option value="100-199">100-199</option>
						<option value="200-1000">200+</option>
					</select>
					<button class="standard_btn">Search</button>
				</div>
				
				<div class="bookings_header">
		
					<?php $header_image = get_field(strtolower($monthName).'_booking_header', 'options'); ?>
					<img src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>">
			
					<div class="header_navigation">
						<ul class="bookings_sub_nav">
							<li class="previous_button">
								<a href="?calendar_year=<?php echo $prevMonthYear; ?>&calendar_month=<?php echo $prevMonth; ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/chevron_left.png"/></a>
							</li>
							<li class="bookings_nav_previous">
								<a href="?calendar_year=<?php echo $prevMonthYear; ?>&calendar_month=<?php echo $prevMonth; ?>"><?php echo $prevMonthName; ?></a>
							</li>
							<li class="current_month"><a href="#"><?php echo $monthName; ?></a></li>
							<li class="bookings_nav_next">
								<a href="?calendar_year=<?php echo $nextMonthYear; ?>&calendar_month=<?php echo $nextMonth; ?>"><?php echo $nextMonthName; ?></a>
							</li>
							<li class="next_button">
								<a href="?calendar_year=<?php echo $nextMonthYear; ?>&calendar_month=<?php echo $nextMonth; ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/chevron_right.png"/></a>
							</li>
						</ul>
					</div>
                    <div class="cal_month">
                        <p><a href="#"><?php echo $monthName; ?></a></p>
                    </div><!-- end of cal month -->
				</div>
				<table class="wc_bookings_calendar widefat">
					<thead>
						<tr>
							<th><?php _e( 'Mon', 'woocommerce-bookings' ); ?></th>
							<th><?php _e( 'Tue', 'woocommerce-bookings' ); ?></th>
							<th><?php _e( 'Wed', 'woocommerce-bookings' ); ?></th>
							<th><?php _e( 'Thu', 'woocommerce-bookings' ); ?></th>
							<th><?php _e( 'Fri', 'woocommerce-bookings' ); ?></th>
							<th><?php _e( 'Sat', 'woocommerce-bookings' ); ?></th>
							<th><?php _e( 'Sun', 'woocommerce-bookings' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $counter = 0; ?>
						<?php for ( $i = $start_week; $i <= $end_week; $i ++ ) : ?>
							<tr>
								<?php for ( $ii = 0; $ii < 7; $ii ++ ) : ?>
									<?php 
										$hasAvailable = false;
										$product_class = '';
										$capacity_class = '';
										if($bookedProducts) {
											foreach($bookedProducts as $product_slug => $bookedProduct) {
												$book_product = $bookedProduct[$counter];
												if($book_product) {
													$hasAvailable = true;
													$product_class .= $product_slug.' ';
													
													$capacity = $capacities[$product_slug];
													$capacity_class .= $capacity.' ';
												}
											}
										}
									?>
								
									<td class="<?php if($product_class != '') { echo $product_class; } ?> <?php
		
									if ( date( 'n', strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ) != absint( $month ) )
										echo 'calendar-diff-month';
		
									?>" data-capacity="<?php if($capacity_class) { echo $capacity_class; } ?>">
										<div class="day_content <?php if($hasAvailable) { echo 'available_bookings'; } ?>" data-date="<?php echo date( 'Ymd', strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ); ?>">
											<p><?php echo date( 'd', strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ); ?></p>
											<div class="bookings">
												<ul>
													<?php /*$this->list_bookings(
														date( 'd', strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ),
														date( 'm', strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) ),
														date( 'Y', strtotime( "+{$ii} DAY", strtotime( $year . "W" . str_pad( $i, 2, '0', STR_PAD_LEFT ) ) ) )
													);*/ ?>
												</ul>
											</div>
										</div>
									</td>
									<?php $counter++; ?>
								<?php endfor; ?>
							</tr>
						<?php endfor; ?>
					</tbody>
				</table>
				
				<div id="available_bookings_container">
					
				</div>
			</div>
		</div>	
	</section>
 
 <?php get_footer(); ?>