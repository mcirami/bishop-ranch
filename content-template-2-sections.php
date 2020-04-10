<?php while(has_sub_field('template_2_sections')) : ?>

<div class="container">

	<?php if(get_row_layout() == 'one_column') : ?>
	
		<div class="hero_box">
			<?php $res1 = get_sub_field('image'); ?>
			<?php /*<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $res1['ID']; ?>"><img src="<?php echo $res1['sizes']['thumb-940-300']; ?>" alt="<?php echo $res1['alt']; ?>" /></a>*/ ?>
			<a href="<?php the_sub_field('image_link'); ?>"><img src="<?php echo $res1['url']; ?>" alt="<?php echo $res1['alt']; ?>"></a>
			<div class="box_content">
				<h2 style="background: url('<?php the_sub_field("section_icon"); ?>') no-repeat white -9px center; background-position-y: -2px;"><?php the_sub_field('section_title'); ?></h2>
				<?php the_sub_field('section_content'); ?>
				<?php if(have_rows('resource_features')) : ?>
					<div class="box_content_bottom">
						<ul>
							<?php while(have_rows('resource_features')) : the_row(); ?>
								<li><a href="<?php the_sub_field('feature_link'); ?>"><?php the_sub_field('feature_title'); ?></a></li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif; ?>
			</div>
		</div>

	
	<?php elseif(get_row_layout() == 'two_column') : ?>
	

		<div class="two_column_boxes">
			<?php while(has_sub_field('column')) : ?>
				<div class="box">
					<?php $res2 = get_sub_field('image'); ?>
					<?php /*<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $res2['ID']; ?>"><img src="<?php echo $res2['sizes']['thumb-460-214']; ?>" alt="<?php echo $res2['alt']; ?>" /></a>*/ ?>
					<a href="<?php the_sub_field('image_link'); ?>"><img src="<?php echo $res2['url']; ?>" alt="<?php echo $res2['alt']; ?>"></a>
					<?php $hasRows = get_sub_field('resource_features'); ?>
					<div class="box_content <?php if(!$hasRows){ echo 'box_content_nolink'; } ?>">
						<h2 style="background: url('<?php the_sub_field("section_icon"); ?>') no-repeat white -2px center; background-position-y: -2px;" ><?php the_sub_field('section_title'); ?></h2>
						<?php the_sub_field('section_content'); ?>
						<?php if(have_rows('resource_features')) : ?>
							<div class="box_content_bottom">
								<ul>
								<?php while(have_rows('resource_features')) : the_row(); ?>
									<?php if(get_sub_field('custom_link')) : ?>
										<li><a href="<?php the_sub_field('custom_link'); ?>"><?php the_sub_field('feature_title'); ?></a></li>
									<?php else : ?>
										<li><a href="<?php the_sub_field('feature_link'); ?>"><?php the_sub_field('feature_title'); ?></a></li>
									<?php endif; ?>	
								<?php endwhile; ?>
								</ul>
							</div>
						<?php endif; ?>	
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		
	<?php elseif(get_row_layout() == 'three_column') : ?>
	
		<div class="three_column_boxes">
			<?php while(has_sub_field('column')) : ?>
				<div class="box">
					<div class="box_content <?php if(!get_sub_field('feature_title')) : ?><?php echo 'box_content_nolink'; ?><?php endif; ?>">
						<h2 style="background: url('<?php the_sub_field("section_icon"); ?>') no-repeat white -2px center; background-position-y: -2px;"><?php the_sub_field('section_title'); ?></h2>
						<?php the_sub_field('section_content'); ?>
						<?php if(get_sub_field('feature_link')) { ?>
							<a href="<?php the_sub_field('feature_link'); ?>"><?php the_sub_field('feature_title'); ?></a>
						<?php } ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		
	<?php endif; ?>
	
</div>
	
	<?php if(get_row_layout() == 'additional_resources') : ?>
	
	<div class="container-880">
		<?php while(has_sub_field('resource')) : ?>
			<div class="links">
				<h2><?php the_sub_field('resource_title'); ?></h2>
				<?php the_sub_field('resource_content'); ?>
			</div>
		<?php endwhile; ?>
	</div>
	
	<?php endif; ?>

<?php endwhile; ?>