<?php 
/* *
 * Template Name: Template 3
 */
get_header(); ?>

<section class="availability wrapper">
	<div class="container">
		<h1 class="page_title">Available Space for Lease</h1>
		<div class="top_wrap">
			<div class="availability_form">
				<h3>To view office space currently available, select a space range</h3>
				<p>Select Size</p>
				<div id="form_sqft"></div>
				
				<?php
					$args = array (
						'post_type' => 'property',
						'posts_per_page' => -1,
						'orderby' => 'meta_value_num',
						'meta_key' => 'post_order',
						'order' => 'ASC',
					);
				
					$complexes = new WP_Query($args);
				?>
				
				<select id="form_complex">
					<option value="" selected="">All Complexes</option>
					<?php
						while( $complexes->have_posts() ) : $complexes->the_post();
					?>
						<?php $postid = get_the_ID(); ?>
						<option value="<?php echo $postid; ?>"><?php the_title(); ?></option>
						
					<?php endwhile; wp_reset_postdata(); ?>
				</select>
				
				<button class="js-ajax">Search</button>
				<a class="mobile_map_link" href="<?php bloginfo('template_url'); ?>/images/availability_map.jpg" alt="Bishop Ranch map">View Bishop Ranch Map</a>
			</div>
			<div class="other_space">
				<?php the_field('other_space_content'); ?>
			</div>
		</div>
		<div class="map">
			<div class="map_overlays">
				<img class="br_1" src="<?php echo bloginfo('template_url'); ?>/images/br_1_overlay.png" />
				<img class="br_3" src="<?php echo bloginfo('template_url'); ?>/images/br_3_overlay.png" />
				<img class="br_6" src="<?php echo bloginfo('template_url'); ?>/images/br_6_overlay.png" />
				<img class="br_7" src="<?php echo bloginfo('template_url'); ?>/images/br_7_overlay.png" />
				<img class="br_8" src="<?php echo bloginfo('template_url'); ?>/images/br_8_overlay.png" />
				<img class="br_9" src="<?php echo bloginfo('template_url'); ?>/images/br_9_overlay.png" />
				<img class="br_11" src="<?php echo bloginfo('template_url'); ?>/images/br_11_overlay.png" />
				<img class="br_12" src="<?php echo bloginfo('template_url'); ?>/images/br_12_overlay.png" />
				<img class="br_15" src="<?php echo bloginfo('template_url'); ?>/images/br_15_overlay.png" />
				<img class="br_2600" src="<?php echo bloginfo('template_url'); ?>/images/br_2600_overlay.png" />
			</div>
			<img name="BR_imagemap" src="<?php echo bloginfo('template_url'); ?>/images/availability_map.jpg" width="940" height="437" border="0" id="BR_imagemap" usemap="#m_BR_imagemap" alt="" />
			
			<?php get_template_part('content', 'image-map'); ?>
			
			<div class="map_overlay_box">
				<?php //ajaxing from complex-loop-handler.php ?>
			</div>
		</div>
		<div class="listing_results">
			<?php //ajaxing from availability-loop-handler.php ?>
		</div>
		
		<div class="features">
			<?php if(get_field('why_lease_with_us', 'options')) : ?>
				<div class="avail_info">
					<h3 class="garamond">Why Lease With Us</h3>
					<div class="right_content">
						<?php the_field('why_lease_with_us', 'options'); ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="avail_info">
				<h3 class="garamond">Featured Amenities</h3>
				<div class="highlight_wrap">
					<?php $amenities = get_field('default_amenities', 'options'); ?>
					<?php if($amenities) : ?>
						<?php foreach($amenities as $amenity) : ?>
							<div class="highlights">
								<?php $threeColConImage = get_field('amenity_image', $amenity->ID); ?>
								<a href="<?php the_field('amenity_link', $amenity->ID); ?>"><img src="<?php echo $threeColConImage['url']; ?>" alt="<?php echo $threeColConImage['alt']; ?>" /></a>
								<div class="highlight_content">
									<h3><a href="<?php echo the_field('amenity_link', $amenity->ID); ?>"><?php echo $amenity->post_title; ?></a></h3>
									<?php the_field('amenity_description', $amenity->ID); ?>
								</div>
							</div>
						<?php endforeach; ?>
				<?php endif; ?>
				<?php //defaults overwritten from availability-loop-handler.php ?>
				</div>
			</div>
		</div>
		<?php get_template_part('content', 'template-3-sections'); ?>

	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		var sqftArray = [
			{ text: "Sq. Ft.", value: null },
		    { text: "0 - 1,000 Sq. Ft.", value: '0 - 1,000', },
		    { text: "1,000 - 2,500 Sq. Ft.", value: '1,000 - 2,500', },
		    { text: "2,500 - 5,000 Sq. Ft.", value: '2,500 - 5,000', },
		    { text: "5,000 - 20,000 Sq. Ft.", value: '5,000 - 20,000', },
		    { text: "20,000+ Sq. Ft.", value: '20,000', }
		];
		
		// Ajax loop for listings
		var loading = true;
		var $data;
		var $content = $(".listing_results");
		var complexIndex = <?php if($_POST['complex']) { echo esc_attr($_POST['complex']); } else if($_GET['complex']) { echo esc_attr($_GET['complex']); } else { echo -1; } ?>;
		var sqftIndex = <?php if($_POST['sqft']) { echo esc_attr($_POST['sqft']); } else if($_GET['sqft']) { echo esc_attr($_GET['sqft']); } else { echo -1; } ?>;
		var sqft;
		var complex;
		var page = 1;
		var initial = 1;
		if(!isNaN(sqftIndex) && sqftIndex != -1 && sqftIndex >= 0 && sqftIndex < sqftArray.length) {
			sqft = sqftArray[sqftIndex]["value"];
			$('#form_sqft').ddslick({
		    	data: sqftArray,
				defaultSelectedIndex: sqftIndex,
				onSelected: function(data) {
					sqftIndex = data.selectedIndex;
				}
			});
		} else {
			$('#form_sqft').ddslick({
		    	data: sqftArray,
				selectText: "Sq. Ft.",
				onSelected: function(data) {
					sqftIndex = data.selectedIndex;
				}
			});
		}
		
		if(!isNaN(complexIndex) && complexIndex != -1 && complexIndex >= 0) {
			var sIndex = complexIndex+1;
			complex = $("#form_complex option:nth-child("+sIndex+")").val();
			
			$('#form_complex').ddslick({
				defaultSelectedIndex: parseInt(complexIndex),
				onSelected: function(data) {
					complexIndex = data.selectedIndex;
				}	
			});
			var i = sIndex-1;
			$('#form_complex').ddslick('select', {index: i});
		} else {
			$('#form_complex').ddslick({
				onSelected: function(data) {
					complexIndex = data.selectedIndex;
				}	
			});
		}
		
		var load_results = function() {
			$.ajax({
				type		: "GET",
				data		: {sqft : sqft, complex : complex, paged: page, initial: initial, complexIndex: complexIndex, sqftIndex: sqftIndex},
				dataType	: "html",
				url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/availability-loop-handler.php",
				beforeSend	: function(data) {
					
				},
				success		: function(data) {
					$data = $(data);
					if($data.length){  
	                    $data.hide();
	                    $content.css('display', 'block');
	                    
	                    if(initial == 1) {
	                    	$content.append($data);
	                    } else {
		                    $('.listing_list .current_listings').append($data);
	                    }
	                    $data.fadeIn(500, function(){  
	                        $("#temp_load").remove();  
	                        loading = false;  
	                    });
	                } else {  
	                    $("#temp_load").remove();
	                    if(initial == 1) {
	                   		$content.css('display', 'none');
	                    }
	                } 
				},
				error		: function(jqXHR, textStatus, errorThrown) {
					$("#temp_load").remove();  
					alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		};
		
		var windowWidth = $(window).width();
		var mobile;
		
		if(windowWidth <= 670) {
			mobile = true;
		} else {
			mobile = false;
		}
		
		$(window).resize(function(){
			windowWidth = $(window).width();
			if(windowWidth <= 670) {
				mobile = true;
			} else {
				mobile = false;
			}
		});
		
		$('.js-ajax').click(function(e){
			e.preventDefault();
			
			var offset;
			if(mobile === false) {
				offset = ($('.map').offset().top - 10) + 'px';
				$('html, body').animate({
					scrollTop: offset,
				}, 1500);
			} else if(mobile === true) {
				offset = ($('.other_space').offset().top + 215) + 'px';
				$('html, body').animate({
					scrollTop: offset,
				}, 1500);
			}
			
			sqft = $('#form_sqft .dd-selected-value').val();
			complex = $('#form_complex .dd-selected-value').val();
			slctComplex = $('#form_complex .dd-selected-value').val();
			var post_ids = [];
			var hrefs = [];
			$('.js-ajax-complex').each(function(){
				post_ids.push($(this).attr('data-post-id'));
				hrefs.push($(this).attr('href'));
			});
			
			var indexCheck = post_ids.indexOf(slctComplex);
			
			if(indexCheck != -1) {
				slctComplex = hrefs[indexCheck];
				complexID = post_ids[indexCheck];
				$('.map_overlays img').fadeOut(500);
				$('.' + slctComplex).fadeOut(500);
				$('.' + slctComplex).fadeIn(500);
			}
			
			page = 1;
			
			initial = 1;
			
			$content.empty();
			
			if(sqft || complex){
				load_results();
			}
			load_amenities();
		});
		
		$('.view_more_listings').live('click', function(e) {
			e.preventDefault();
			page++;
			initial = 0;
			$('.view_more_listings').css('display', 'none');
			load_results();
		});
	
		// Ajax loop for complex
		var loading = true;
		var $dataComplex;
		var $contentComplex = $(".map_overlay_box");
		var slctComplex;
		var complexID;
		var load_complex = function() {
			$.ajax({
				type		: "GET",
				data		: {slctComplex : slctComplex, complexID : complexID},
				dataType	: "html",
				url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/complex-loop-handler.php",
				beforeSend	: function() {
					$contentComplex.empty();
					$content.empty();
				},
				success		: function(data) {
					$dataComplex = $(data);
					if($dataComplex.length){  
	                    $contentComplex.hide(); 
	                    $contentComplex.append($dataComplex);  
	                    $contentComplex.fadeIn(500, function(){  
	                        $("#temp_load").remove();  
	                        loading = false;
	                        $contentComplex.addClass('open');
	                    });
	                } else {  
	                    $("#temp_load").remove();
	                } 
				},
				error		: function(jqXHR, textStatus, errorThrown) {
					$("#temp_load").remove();  
					alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		};		
		
		$('.js-ajax-complex').click(function(e){
			e.preventDefault();
			slctComplex = $(this).attr('href');
			complex = $(this).attr('data-post-id');
			complexID = $(this).attr('data-post-id');
			sqft = $('#form_sqft .dd-selected-value').val();
			load_results();
			load_complex();
			$('.' + slctComplex).fadeIn(500);
		});
		
		$('.map_overlay_close_btn').live('click', function(){
			$('.map_overlay_box').fadeOut(500);
			$('.' + slctComplex).fadeOut(500);
		});
		
		$('.map').click(function(){
			if($('.map_overlay_box').hasClass('open')){
				$('.map_overlay_box').fadeOut(500);
				$('.map_overlay_box').removeClass('open');
				$('img[class*=br_]').fadeOut(500);
			}
		});
			
		//Ajax loop for featured amenities
		var loading = true;
		var $dataAmenity;
		var $contentAmenity = $('.highlight_wrap');
		var load_amenities = function() {
			$.ajax({
				type		: "GET",
				data		: {sqft : sqft},
				dataType	: "html",
				url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/amenity-loop-handler.php",
				beforeSend	: function() {
					$contentAmenity.empty();
				},
				success		: function(data) {
					$dataAmenity = $(data);
					if($dataAmenity.length){  
	                    $contentAmenity.hide(); 
	                    $contentAmenity.append($dataAmenity);  
	                    $contentAmenity.fadeIn(500, function(){  
	                        $("#temp_load").remove();  
	                        loading = false;  
	                    });
	                } else {  
	                    $("#temp_load").remove();
	                } 
				},
				error		: function(jqXHR, textStatus, errorThrown) {
					$("#temp_load").remove();  
					alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		};
		
		if(sqft || complex){
			load_results();
			load_amenities();
			
			if(complex) {
				slctComplex = $('#form_complex .dd-selected-value').val();
				var post_ids = [];
				var hrefs = [];
				$('.js-ajax-complex').each(function(){
					post_ids.push($(this).attr('data-post-id'));
					hrefs.push($(this).attr('href'));
				});
				
				var indexCheck = post_ids.indexOf(slctComplex);
				
				if(indexCheck != -1) {
					slctComplex = hrefs[indexCheck];
					complexID = post_ids[indexCheck];
					$('.map_overlays img').fadeOut(500);
					$('.' + slctComplex).fadeOut(500);
					$('.' + slctComplex).fadeIn(500);
				}
				
				load_complex(slctComplex, complexID);
			}
		}
	});
</script>

<?php get_footer(); ?>