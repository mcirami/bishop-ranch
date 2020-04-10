<div class="features">

<?php if(have_rows('template_3_content')) : ?>

	<?php while(have_rows('template_3_content')) : the_row(); ?>
		
		<?php if(get_row_layout() == 'general_content') : ?>
		
			<div class="avail_info">
				<h3 class="garamond"><?php the_sub_field('section_title'); ?></h3>
				<div class="right_content">
					<?php the_sub_field('section_copy'); ?>
				</div>
			</div>
				
		<?php elseif(get_row_layout() == 'two_column_images') : ?>
			
			<div class="avail_info">
				<h3 class="garamond"><?php the_sub_field('section_title'); ?></h3>
				<div class="plans">
					<?php while(has_sub_field('two_column_images')) : ?>
						<div class="plan">
							<?php $twoColImage = get_sub_field('image'); ?>
							<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $twoColImage['ID']; ?>"><img src="<?php echo $twoColImage['sizes']['thumb-277-190']; ?>" alt="<?php echo $twoColImage['alt']; ?>" /></a>
							<?php if(get_sub_field('image_caption')) : ?>
								<p><?php the_sub_field('image_caption'); ?></p>
							<?php endif; ?>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
				
		<?php elseif(get_row_layout() == 'three_column_image_copy') : ?>

			<div class="avail_info">
				<h3 class="garamond"><?php the_sub_field('section_title'); ?></h3>
				<div class="highlight_wrap">
					<?php while(has_sub_field('three_column_copy')) : ?>
						<div class="highlights">
							<?php $threeColConImage = get_sub_field('image'); ?>
							<a href="<?php the_sub_field('link_location'); ?>"><img src="<?php echo $threeColConImage['sizes']['thumb-180-135']; ?>" alt="<?php echo $threeColConImage['alt']; ?>" /></a>
							<div class="highlight_content">
								<h3><a href="<?php echo the_sub_field('link_location'); ?>"><?php the_sub_field('section_title'); ?></a></h3>
								<?php the_sub_field('three_column_copy'); ?>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			
		<?php elseif(get_row_layout() == 'three_column_images') : ?>
		
			<div class="avail_info">
				<h3 class="garamond"><?php the_sub_field('section_title'); ?></h3>
				<div class="images">
					<?php while(has_sub_field('three_column_images')) : ?>
						<div class="image">
							<?php $threeColImage = get_sub_field('image'); ?>
							<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $threeColImage['ID']; ?>"><img src="<?php echo $threeColImage['sizes']['thumb-180-135']; ?>" alt="<?php echo $threeColImage['alt']; ?>" /></a>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			
		<?php endif; ?>
					
	<?php endwhile; ?>
		
<?php endif; ?>

</div>