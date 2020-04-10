<?php 
/* *
 * Template Name: Template 3 - Small Business
 */
get_header(); ?>

<section class="single_listing single_space wrapper">
	<div class="container">
		<div class="info_wrap">
			<div class="listing_info">
				<h1 class="page_title"><?php the_title(); ?></h1>
			</div>
		</div>
		<div class="listing_hero">
			<?php $featuredImage = get_field('featured_image'); ?>
			<img src="<?php echo $featuredImage['sizes']['thumb-940-437']; ?>" alt="<?php echo $featuredImage['alt']; ?>" />
			<p><?php the_field('featured_caption'); ?></p>
		</div>
		
		<div class="features">
			<div class="avail_info listing_summary">
				<?php the_field('listing_summary'); ?>
			</div>
			
			<div class="avail_info available_spaces small_bus_calc">
				<h3 class="garamond">Small Business Spaces</h3>
				<div class="right_content">
					<div class="left_calc">
						<h3>Use space calculator to get the right office for you</h3>
						<ul>
							<li>
								<p>Private Offices</p>
								<div id="private_offices"></div>
							</li>
							<li>
								<p>Work Stations</p>
								<div id="work_stations"></div>
							</li>
							<li>
								<p>Small Conference (4-6 ppl)</p>
								<div id="small_conference"></div>
							</li>
							<li>
								<p>Large Conference (12 ppl)</p>
								<div id="large_conference"></div>
							</li>
						</ul>
						<div class="calc_buttons">
							<a class="clear_results clear_left" href="#">Clear Results</a>
							<button class="js-ajax_small_business_left">Calculate</button>
						</div>
					</div>
					<div class="calc_spacer"></div>
					<div class="right_calc">
						<h3>Select your office sizes below to see available listings</h3>
						<div class="checkboxes">

							<input type="checkbox" name="office_sizes" value="0" id="office_0">
                            <label for="office_0">0-1,000 Sq. Ft.</label>
							<input type="checkbox" name="office_sizes" value="1000" id="office_1000">
                            <label for="office_1000">1,000-2,500 Sq. Ft.</label>
							<input type="checkbox" name="office_sizes" value="2500" id="office_2500">
                            <label for="office_2500">2,500-5,000 Sq. Ft.</label>
						</div>
						<div class="calc_buttons">
							<a class="clear_results clear_right" href="#">Clear Results</a>
							<button class="js-ajax_small_business_right">Calculate</button>
						</div>
					</div>
					<div class="or_button">
						<p>or</p>
					</div>
				</div>
			</div>

			<div class="avail_info available_listings">
				<h3 class="garamond">Listings</h3>
				<div class="right_content">
					<ul class="available_table">
						
						<?php
							$args = array (
								'post_type' => 'listings',
								'listing-type' => 'small-business',
								'posts_per_page' => 11,
								'paged' => 1,
								'meta_key' => 'square_footage',
								'orderby' => 'meta_value_num',
								'order' => 'ASC',
								'meta_query' => array(
									array(
										'key' => 'availability',
										'value' => true,
										'compare' => '='
									),
								)
							);
						
							$postCount = 0;
							$medical = new WP_Query($args); 
							
							if ( $medical->have_posts() ) : 
						?>
							<li class="available_label">
								<ul>
									<li class="complex">Complex</li>
									<li class="suite">Suite</li>
									<li class="square_feet">Sq. Ft.</li>
									<li class="address">Address</li>
									<li class="price">Prices*</li>
								</ul>
							</li>
							
							<?php while( $medical->have_posts() ) : $medical->the_post(); ?>
							<?php if($postCount < 10) : ?>
								<?php $complex = get_field('complex'); ?>
								
								<li class="available_item">
									<a href="<?php the_permalink(); ?>">
										<ul>
											<li class="complex"><?php echo $complex->post_title; ?><?php if(get_field('coming_soon')) { echo '**'; } ?></li>
											<li class="suite"><?php the_field('suite_number'); ?></li>
											<li class="square_feet"><?php the_field('square_footage'); ?></li>
											<li class="address"><?php the_field('address_line_1'); ?></li>
											<li class="price">$<?php the_field('price'); ?></li>
										</ul>
									</a>
								</li>
							<?php endif; ?>
							<?php $postCount++; ?>
							<?php endwhile; wp_reset_postdata(); ?>
					</ul>
					<a href="#" class="view_more_listings" <?php if($postCount != 11) { echo 'style="display: none;"'; } ?>>View All Small Business Listings</a>
					<?php $infoPhone = get_field('call_for_info_phone_#', 'options'); ?>
					<?php if($infoPhone) : ?>
						<a class="info_number" href="tel:<?php echo $infoPhone; ?>"><div class="call_for_info"><?php echo $infoPhone; ?></div></a>
					<?php endif; ?>
					<?php if(get_field('disclaimer_one')) { ?>
						<p class="disclaimer_one disclaimer">*<?php the_field('disclaimer_one'); ?></p>
					<?php } ?>
					<?php if(get_field('disclaimer_two')) { ?>
						<p class="disclaimer_two disclaimer">**<?php the_field('disclaimer_two'); ?></p>
					<?php } ?>
						
						<?php else: ?>
						
						<li class="available_item">No listings available</li>
					</ul>
						
						<?php endif; ?>
					
				</div>
			</div>
		</div>
		
		<div class="small_business_features">
			<?php get_template_part('content', 'template-3-sections'); ?>
			
			<?php if(get_field('leasing_address','options')) : ?>
			<div class="features leasing_info">
				<div class="avail_info">
					<h3 class="garamond">Bishop Ranch Leasing</h3>
					<div class="right_content">
						<?php the_field('leasing_address', 'options'); ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function($){
		// Ajax loop for listings
		var loading = false;
		var $data;
		var $content = $(".available_table");
		var sqftLow;
		var sqftHigh;
		var offset = 10;
		var load_posts = function() {
			$.ajax({
				type		: "GET",
				data		: {sqftLow : sqftLow, sqftHigh : sqftHigh, offset: offset},
				dataType	: "html",
				url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/availability-small-business-loop-handler.php",
				beforeSend	: function() {
					loading = true;
				},
				success		: function(data) {
					$data = $(data);
					if($data.length){  
	                    $data.hide(); 
	                    $content.append($data);  
	                    $data.fadeIn(500, function(){
		                    
	                    });
	                    
	                    if(offset == 0) {
		                    var numberOfBusinesses = $('.number_small_businesses').val();
		                    if(numberOfBusinesses == 11) {
		                    	$('.view_more_listings').css('display', 'block');
		                    }
	                    }
	                }
	                loading = false;
				},
				error		: function(jqXHR, textStatus, errorThrown) {
					alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		};		
		
		$('.js-ajax_small_business_left').click(function(e){
			e.preventDefault();
			
			if(!loading) {
				var privateOffices = $('#private_offices .dd-selected-value').val();
				var workStations = $('#work_stations .dd-selected-value').val();
				var smallConferences = $('#small_conference .dd-selected-value').val();
				var largeConferences = $('#large_conference .dd-selected-value').val();
				
				sqftLow = (privateOffices*180)+(workStations*90)+(smallConferences*175)+(largeConferences*280);
				sqftHigh = (privateOffices*275)+(workStations*175)+(smallConferences*275)+(largeConferences*400);
				
				offset = 0;
				
				$('.view_more_listings').css('display', 'none');
				
				$content.empty(); 

				load_posts();
			}
		});
		
		
		$('.js-ajax_small_business_right').click(function(e){
			e.preventDefault();
	
			if(!loading) {
				sqftLow = null;
				sqftHigh = null;
				$('.available_spaces .right_calc input[type="checkbox"]').each(function(e) {
					if($(this).is(':checked')) {
						if($(this).val() == 0) {
							sqftLow = 1;
							if(!sqftHigh) {
								sqftHigh = 1000;
							}
						} else if($(this).val() == 1000) {
							if(!sqftHigh || sqftHigh < 2500) {
								sqftHigh = 2500;
							}
							if(!sqftLow || sqftLow > 1000) {
								sqftLow = 1000;
							}
						} else if($(this).val() == 2500) {
							sqftHigh = 5000;
							if(!sqftLow) {
								sqftLow = 2500;
							}
						}
					}
				});
				
				$('.view_more_listings').css('display', 'none');
				
				offset = 0;
				
				$content.empty(); 
				
				load_posts();
			}
		});
		
		$('.view_more_listings').click(function(e) {
			e.preventDefault();
			
			$('.view_more_listings').css('display', 'none');
			
			offset = 10;
			load_posts();
		});
	});
</script>

<?php get_footer(); ?>