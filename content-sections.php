<?php while(has_sub_field('content_sections')) : ?>

	<?php if(get_row_layout() == 'event_two_column') : ?>
		<div class="two_column_wrap">
			<?php if(get_sub_field('section_title')) : ?>
				<h2 class="page_title"><?php the_sub_field('section_title'); ?></h2>
			<?php endif; ?>
			<?php while(has_sub_field('two_column_row')) : ?>
				<div class="two_column_section">
					<?php if(get_sub_field('image_or_video') === "image") : ?>
						<?php $image = get_sub_field('column_image'); ?>
						<div class="column_image">
							<?php if(get_sub_field('image_link')) : ?>
								<a href="<?php the_sub_field('image_link'); ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
							<?php else : ?>
								<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
							<?php endif; ?>
						</div>
					<?php else :  ?>
						<?php 
							$video = get_sub_field('column_video');
							$image = get_sub_field('column_image');
						?>
						<div class="column_image">
							<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-video.php?video=<?php echo $video; ?>"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" /><div class="ajax_play_button"></div></a>
							<!-- <div class="video_column"><?php echo $videoContent; ?></div> -->
						</div>
					<?php endif; ?>
					<div class="column_copy">
						<?php the_sub_field('column_copy'); ?>
                        <?php
                            $pageLink = get_sub_field('column_button_link');
                            $pageTitle = get_sub_field('column_button_title');
                        ?>
                        <?php if(get_sub_field('add_button') == TRUE ) { ?>
                            <div class="standard_btn">
                                <a href="<?php echo $pageLink; ?>"><?php echo $pageTitle; ?></a>
                            </div>
                        <?php } ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
		
		
	<?php endif; ?>
<?php endwhile; ?>