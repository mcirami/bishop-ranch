<?php 

get_header(); ?>

<section class="homepage wrapper">
	<div class="container">
		<div class="homepage_grid">
			<div class="row">
				<div class="one_col">
					<form id="avail_form" class="form" action="/availability" method="post">
						<h2>Available Space</h2>
						<label>Select Size</label>
						<div id="home_sqft"></div>
						<input type="hidden" name="sqft" id="sqft" value="">
						<input type="hidden" name="complex" id="complex" value="">
						<button class="standard_btn">Search</button>
						<button class="mobile_btn">Search Available Space</button>
						<hr>
						<h2 class="cust_title"><?php the_field('available_space_title'); ?></h2>
						<ul class="custom_spaces">
							<?php if (have_rows('available_space_sub_section_link')) : ?>
								<?php while (have_rows('available_space_sub_section_link')) : the_row(); ?>
									<li><a href="<?php the_sub_field('space_link'); ?>"><?php the_sub_field('space_link_title'); ?></a></li>
								<?php endwhile; ?>
							<?php endif; ?>
						</ul>
					</form>
				</div>
				<?php if(get_field('section_1_link')) : ?>
					<div class="two_col">
						<?php $image1 = get_field('section_1_image'); ?>
						<a href="<?php the_field('section_1_link'); ?>"><img src="<?php echo $image1['url']; ?>" alt="<?php echo $image1['alt']; ?>" /></a>
						<div class="content_overlay">
							<a href="<?php the_field('section_1_link'); ?>"><p><?php the_field('section_1_title'); ?></p></a>
						</div>
					</div>
				<?php else : ?>
					<div class="two_col">
						<?php $image1 = get_field('section_1_image'); ?>
						<img src="<?php echo $image1['url']; ?>" alt="<?php echo $image1['alt']; ?>" />
						<div class="content_overlay">
							<a href="#"><p><?php the_field('section_1_title'); ?></p></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="row">
				<?php if(get_field('section_2_link')) : ?>
					<div class="one_col">
						<?php $image2 = get_field('section_2_image'); ?>
						<a href="<?php the_field('section_2_link'); ?>"><img src="<?php echo $image2['url']; ?>" alt="<?php echo $image2['alt']; ?>" /></a>
						<div class="content_overlay">
							<a href="<?php the_field('section_2_link'); ?>"><p><?php the_field('section_2_title'); ?></p></a>
						</div>
					</div>
				<?php else : ?>
					<div class="one_col">
						<?php $image2 = get_field('section_2_image'); ?>
						<img src="<?php echo $image2['url']; ?>" alt="<?php echo $image2['alt']; ?>" />
						<div class="content_overlay">
							<a href="#"><p><?php the_field('section_2_title'); ?></p></a>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if(get_field('section_3_link')) : ?>
					<div class="one_col">
						<?php $image3 = get_field('section_3_image'); ?>
						<a href="<?php the_field('section_3_link'); ?>"><img src="<?php echo $image3['url']; ?>" alt="<?php echo $image3['alt']; ?>" /></a>
						<div class="content_overlay">
							<a href="<?php the_field('section_3_link'); ?>"><p><?php the_field('section_3_title'); ?></p></a>
						</div>
					</div>
				<?php else : ?>
					<div class="one_col">
						<?php $image3 = get_field('section_3_image'); ?>
						<img src="<?php echo $image3['url']; ?>" alt="<?php echo $image3['alt']; ?>" />
						<div class="content_overlay">
							<a href="#"><p><?php the_field('section_3_title'); ?></p></a>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if(get_field('section_4_link')) : ?>
					<div class="one_col">
						<?php $image4 = get_field('section_4_image'); ?>
						<a href="<?php the_field('section_4_link'); ?>"><img src="<?php echo $image4['url']; ?>" alt="<?php echo $image4['alt']; ?>" /></a>
						<div class="content_overlay">
							<a href="<?php the_field('section_4_link'); ?>"><p><?php the_field('section_4_title'); ?></p></a>
						</div>
					</div>
				<?php else : ?>
					<div class="one_col">
						<?php $image4 = get_field('section_4_image'); ?>
						<img src="<?php echo $image4['url']; ?>" alt="<?php echo $image4['alt']; ?>" />
						<div class="content_overlay">
							<a href="#"><p><?php the_field('section_4_title'); ?></p></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
			<div class="row">
				<?php if(get_field('section_5_link')) : ?>
					<div class="one_col">
						<?php $image5 = get_field('section_5_image'); ?>
						<a href="<?php the_field('section_5_link'); ?>"><img src="<?php echo $image5['url']; ?>" alt="<?php echo $image5['alt']; ?>" /></a>
						<div class="content_overlay">
							<a href="<?php the_field('section_5_link'); ?>"><p><?php the_field('section_5_title'); ?></p></a>
						</div>
					</div>
				<?php else : ?>
					<div class="one_col">
						<?php $image5 = get_field('section_5_image'); ?>
						<img src="<?php echo $image5['url']; ?>" alt="<?php echo $image5['alt']; ?>" />
						<div class="content_overlay">
							<a href="#"><p><?php the_field('section_5_title'); ?></p></a>
						</div>
					</div>
				<?php endif; ?>
				
				<?php if(get_field('section_6_link')) : ?>
					<div class="two_col">
						<?php $image6 = get_field('section_6_image'); ?>
						<a href="<?php the_field('section_6_link'); ?>"><img src="<?php echo $image6['url']; ?>" alt="<?php echo $image6['alt']; ?>" /></a>
						<div class="content_overlay">
							<a href="<?php the_field('section_6_link'); ?>"><p><?php the_field('section_6_title'); ?></p></a>
						</div>
					</div>
				<?php else : ?>
					<div class="two_col">
						<?php $image6 = get_field('section_6_image'); ?>
						<img src="<?php echo $image6['url']; ?>" alt="<?php echo $image6['alt']; ?>" />
						<div class="content_overlay">
							<a href="#"><p><?php the_field('section_6_title'); ?></p></a>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php if(preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) : ?>
	<script type="text/javascript">
		jQuery(document).ready(function($){
			
			$(window).load(function(){
				var rowHeight = $('.homepage_grid .row:first-child .two_col').height();
				var windowWidth = $(window).width();
				
				if(windowWidth > 670) {
					$('.homepage_grid .row:first-child .one_col').height(rowHeight);
				}
			});
			
			$(window).resize(function(){
				var rowHeight = $('.homepage_grid .row:first-child .two_col').height();
				var windowWidth = $(window).width();
				
				if(windowWidth > 670) {
					$('.homepage_grid .row:first-child .one_col').height(rowHeight);
				}
			});
		});
	</script>
<?php endif; ?>

<?php get_footer(); ?>