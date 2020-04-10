<?php if(have_rows('template_5_content')) : ?>

	<?php while(have_rows('template_5_content')) : the_row(); ?>
		
		<?php if(get_row_layout() == 'top_content') : ?>
		
			<div class="title_row">
				<h1 class="page_title"><?php the_sub_field('title'); ?></h1>
			</div>
			
			<?php if(have_rows('icons')) : ?>
			<div class="top_icons">
				<div class="top_icon">
					<ul>
						<?php if(have_rows('icons')) : ?>
							<?php while(have_rows('icons')) : the_row(); ?>
								<?php $icon_image = get_sub_field('icon_image'); ?>
								<li><a href="<?php echo get_sub_field('icon_link'); ?>"><img src="<?php echo $icon_image['url']; ?>" alt="<?php echo $icon_image['alt']; ?>"/></a>
									<p><a href="<?php echo get_sub_field('icon_link'); ?>"><?php echo get_sub_field('icon_title'); ?></a></p></li>	
							<?php endwhile; ?>
						<?php endif; ?>	
					</ul>
				</div>
			</div>
			<?php endif; ?>
			<?php if(get_sub_field('top_copy')) : ?>
				<div class="top_content">
					<?php the_sub_field('top_copy'); ?>
				</div>
			<?php endif; ?>
			
		<?php elseif(get_row_layout() == 'one_column') : ?>
			
			<div class="template_5_one_column">
				<h2 class="page_title"><?php the_sub_field('title'); ?></h2>
				<div class="one_column_content">
					<?php the_sub_field('content'); ?>
					<div class="standard_btn">
						<?php if(get_sub_field('button_link')) : ?>
							<a href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('button_title'); ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
				
		<?php elseif(get_row_layout() == 'two_columns') : ?>

			<div class="template_5_two_column">
				<h2 class="page_title"><?php the_sub_field('title'); ?></h2>
				<div class="two_column_content">
					<?php the_sub_field('content'); ?>
				</div>
				<?php $column_image = get_sub_field('image'); ?>
				<?php if($column_image) : ?>
					<div class="two_columns">
						<div class="two_column_left">
							<img src="<?php echo $column_image['url']; ?>" alt="<?php echo $column_image['alt']; ?>" />
						</div>
						<div class="two_column_right">
							<?php if(get_sub_field('link_header')) : ?>
								<p><?php the_sub_field('link_header'); ?></p>
							<?php endif; ?>
							<ul class="column_links">
								<?php if(have_rows('links')) : ?>
									<?php while(have_rows('links')) : the_row(); ?>
											<li><a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_title'); ?></a></li>		
									<?php endwhile; ?>
								<?php endif; ?>	
							</ul>
						</div>
					</div>
				<?php else : ?>
					<div class="two_column_no_image">
						<?php if(get_sub_field('link_header')) : ?>
							<p><?php the_sub_field('link_header'); ?></p>
						<?php endif; ?>
						<ul class="column_links">
							<?php if(have_rows('links')) : ?>
								<?php while(have_rows('links')) : the_row(); ?>
										<li><a href="<?php the_sub_field('link_url'); ?>"><?php the_sub_field('link_title'); ?></a></li>		
								<?php endwhile; ?>
							<?php endif; ?>	
						</ul>
					</div>
				<?php endif; ?>
			</div>
			
		<?php elseif(get_row_layout() == 'contact') : ?>
		
			<div class="template_5_contact">
				<h3 class="page_title"><?php the_sub_field('contact_header'); ?></h3>
				<?php the_sub_field('contact_info'); ?>
			</div>
			
		<?php endif; ?>
		
	<?php endwhile; ?>
		
<?php endif; ?>