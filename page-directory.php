<?php 
/* *
 * Template Name: Directory
 */
get_header(); ?>

<?php $directory_type = get_field('directory_type'); ?>

<section class="directory wrapper">
	<div class="container">
		<div class="title_row">
			<h1 class="page_title"><?php the_title(); ?></h1>
			<div class="standard_btn">
				<a href="<?php the_field('button_link'); ?>"><?php the_field('button_title'); ?></a>
			</div>
		</div>
		<?php if (get_the_content()) : ?>
		<div class="top_content">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>
		<div class="business_wrap">
			<?php if(have_rows('featured_items')) : ?>
				<?php $businesses = get_field('featured_items'); ?>
				<?php $leftover = 7-(count($businesses)%7); ?>
				<ul class="featured_business">
				<?php $row = 1; ?>
				<?php while(have_rows('featured_items')) : the_row(); ?>
					<?php if($counter > 7) { $row++; $counter = 1; } ?>
					<?php $featured_image = get_sub_field('featured_image'); ?>
					<li>
						<a href="<?php the_sub_field('featured_url'); ?>"><img src="<?php echo $featured_image['url']; ?>" alt="<?php echo $featured_image['alt']; ?>"/></a>
					</li>
					<?php $counter++; ?>
				<?php endwhile; ?>
				<?php for($i = 0; $i < $leftover; $i++) { ?>
					<li class="leftover_spaces"></li>
				<?php } ?>
				</ul>
			<?php endif; ?>	
		</div>
		<div class="business_sort">
			<div class="business_form">
				<select id="business_industry">
					<option value="" selected="selected">View by Industry</option>
					<?php 
						$taxonomies = array('industry');
						$args = array(
									'orderby' => 'name', 
									'order' => 'ASC', 
									'hide_empty' => false
								);
						
						$terms = get_terms($taxonomies, $args);
						
						foreach($terms as $term) {
							$term_type = get_field('industry_type', $term);
							if($term_type->slug == $directory_type->slug) {
					?>
						<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php 
							}
						}
					?>
				</select>
				<?php 
					$alphabet = range('a', 'z');
					array_unshift($alphabet, '1-9');
					
					$alphaCounts = array();
					for($i = 0; $i < count($alphabet); $i++) {
						$alphaCounts[$alphabet[$i]] = array();
					}
					
					$args = array (
						'post_type' => 'business',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy' => 'directory-type',
								'field'    => 'slug',
								'terms'    => $directory_type->slug,
							),
						),
					);
					
					$all_business = new WP_Query($args); 
						
					if ( $all_business->have_posts() ) : 	
						while( $all_business->have_posts() ) : $all_business->the_post();
							$alphaObjects = get_the_terms(get_the_ID(), 'alpha');
							foreach($alphaObjects as $alphaObject) {
								$alpha = strtolower($alphaObject->name);
							}
							
							$alphaCounts[$alpha][] = 1;
						endwhile;
					endif; 
					wp_reset_postdata();
				?>
				<select id="business_sortby">
					<option value="" selected="selected">View Alphabetically</option>
					<?php for($i = 0; $i < count($alphabet); $i++) { ?>
						<?php if(count($alphaCounts[$alphabet[$i]]) > 0) { ?>
							<option value="<?php echo strtoupper($alphabet[$i]); ?>"><?php echo strtoupper($alphabet[$i]); ?></option>
						<?php } ?>
					<?php } ?>
				</select>
				<div class="standard_btn"><a href="#">SEARCH</a></div>
			</div>
			
			<ul class="alpha_list">
				<?php 					
					for($i = 0; $i < count($alphabet); $i++) : 
						if(count($alphaCounts[$alphabet[$i]]) == 0) {
				?>	
						<li><p><?php echo strtoupper($alphabet[$i]); ?></p></li>
					<?php } else { ?>
						<li><a class="alpha <?php if($alphabet[$i] === 'a') { echo 'current_alpha'; } ?>" href="#"><?php echo strtoupper($alphabet[$i]); ?></a></li>
					<?php } ?>
				<?php endfor; ?>
			</ul>
			
			<div class="swiper-container letter_slider">
				<div class="swiper-wrapper">
					<?php 					
						for($i = 0; $i < count($alphabet); $i++) : 
							if(count($alphaCounts[$alphabet[$i]]) == 0) {
					?>	
							<div class="swiper-slide"><p><?php echo strtoupper($alphabet[$i]); ?></p></div>
						<?php } else { ?>
							<div class="swiper-slide"><a class="alpha <?php if($alphabet[$i] === 'a') { echo 'current_alpha'; } ?>" href="#"><?php echo strtoupper($alphabet[$i]); ?></a></div>
						<?php } ?>
					<?php endfor; ?>
				</div>
			</div>
			<div class="directory_nav">
				<div class="directory_left"><img src="<?php echo bloginfo('template_url'); ?>/images/directory_arrow_left.png" /></div>
				<div class="directory_right"><img src="<?php echo bloginfo('template_url'); ?>/images/directory_arrow_right.png" /></div>
			</div>
		</div>
		<div class="business_listing">
			<?php 
				
			?>
			
			
			<?php 
				$args = array (
					'post_type' => 'business',
					'posts_per_page' => -1,
					'orderby' => 'title',
					'order' => 'ASC',
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'directory-type',
							'field'    => 'slug',
							'terms'    => $directory_type->slug,
						),
						array(
							'taxonomy' => 'alpha',
							'field'    => 'slug',
							'terms'    => 'a',
						),
					),
				);
				
				$business = new WP_Query($args); 
					
				if ( $business->have_posts() ) : 	
			?>
				<ul>
					<?php while( $business->have_posts() ) : $business->the_post(); ?>
		
						<li><a href="<?php the_field('site_link'); ?>"><?php the_title(); ?></a><div class="business_content hidden_content"><?php the_content(); ?></div></li>
					
					<?php endwhile; ?>
				</ul>
				
			<?php 
				endif; 
				wp_reset_postdata(); 
			?>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function($){
		// Ajax loop for listings
		var loading = true;
		var $data;
		var $content = $(".business_listing");
		var letter = 'A';
		var industry;
		var postType = "<?php echo $directory_type->slug; ?>";
		var load_businesses = function() {
			$.ajax({
				type		: "GET",
				data		: {letter : letter, industry: industry, postType: postType},
				dataType	: "html",
				url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/business-directory-loop-handler.php",
				beforeSend	: function() {
					$content.empty();
				},
				success		: function(data) {
					$data = $(data);
					if($data.length){  
	                    $data.hide();
	                    $content.empty();  
	                    $content.append($data);  
	                    $data.fadeIn(500, function(){  
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
		
		$('.business_sort .alpha').click(function(e){
			e.preventDefault();
			if(!$(this).hasClass('no_results')) {
				letter = $(this).text();
				$('.current_alpha').removeClass('current_alpha');
				$(this).addClass('current_alpha');
				
				industry = $('#business_industry .dd-selected-value').val();
				
				
				load_businesses();
			}
		});
		
		$('.business_form .standard_btn a').click(function(e) {
			industry = $('#business_industry .dd-selected-value').val();
			var alphaLetter = $('#business_sortby .dd-selected-value').val();
			if(alphaLetter != '') {
				letter = alphaLetter;
				$('.current_alpha').removeClass('current_alpha');
				$('.business_sort .alpha').each(function(e) {
					if($(this).text() == letter) {
						$(this).addClass('current_alpha');
					}
				});
			}
			load_businesses();
		});
		
		$('.business_listing li a').live('click', function(e) {
			if($(this).siblings('.business_content').hasClass('hidden_content')) {
				e.preventDefault();
				$('.business_listing li .business_content').addClass('hidden_content');
				$(this).siblings('.business_content').removeClass('hidden_content');
			}
		});
	});
</script>

<?php get_footer(); ?>