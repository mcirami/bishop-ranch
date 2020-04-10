<?php
/**
 * @package boiler
 */
?>

	<?php $post_type = get_post_type(get_the_ID()); ?>

	<div class="single_post">
		<div class="main_image">
			<?php if (has_post_thumbnail() || get_field('main_image') ) : ?>
				<?php if($post_type === 'press-release' || $post_type === 'new-projects' ) : ?>
					<?php $main_image = get_the_post_thumbnail(get_the_ID(), 'large'); ?>
					<?php if (get_field('image_caption')) : ?>
						<?php echo do_shortcode('[caption_image caption="'.get_field('image_caption').'"]'.$main_image.'[/caption_image]'); ?>
					<?php else : ?>
						<?php echo $main_image; ?>
					<?php endif; ?>
				<?php else : ?>
					<?php $main_image = get_field('main_image'); ?>
					<?php if (get_field('image_caption')) : ?>
						<?php echo do_shortcode('[caption_image caption="'.get_field('image_caption').'"]<img src="'.$main_image['url'].'" alt="'.$main_image['alt'].'">[/caption_image]'); ?>
					<?php else : ?>
						<img src="<?php echo $main_image['url']; ?>" alt="<?php echo $main_image['alt']; ?>" />
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<div class="post_content">
			<?php if($post_type === 'press-release' || $post_type === 'new-projects' ) : ?>
				<div class="press_content">
					<?php the_field('top_content'); ?>
                    <div class="tags_border">
                        <p><?php the_tags(); ?></p>
                    </div>
				</div>
			<?php else : ?>
				<h2><?php the_field('main_header'); ?></h2>
				<?php if(have_rows('sections')) : ?>
					<?php while(have_rows('sections')) : the_row(); ?>
						<div class="post_section">
							<div class="section_left">
								<h3 class="garamond"><?php the_sub_field('section_title'); ?></h3>
							</div>
							<div class="section_right">
								<?php the_sub_field('section_content'); ?>
							</div>		
						</div>
					<?php endwhile; ?>				
					<?php if($post_type === 'tribe_events') : ?>			
						<?php 
							$related_events = tribe_get_related_posts(6);
							$time_format = get_option( 'time_format' );
						?>
						<?php if (is_array($related_events) && !empty($related_events)) : ?>	
							<div class="post_section related_events">
								<div class="section_left">
									<h3 class="garamond">Related Events</h3>
								</div>
								<div class="section_right">
									<?php foreach ($related_events as $related_event) : ?>
										<?php 
											$event_date = strtotime($related_event->EventStartDate);
											$event_week_day = date("l", $event_date);
										 ?>
										 <?php if ($event_date < strtotime('+7 day')) : ?>
											<?php if ($day_of_week != $event_week_day) : ?>
												<p><?php echo (empty($day_of_week) ? $event_week_day : '<br>' . $event_week_day) . ', ' . date("F jS", $event_date); ?></p>
												<?php $day_of_week = $event_week_day; ?>
											<?php endif; ?>
											<p><?php echo $related_event->post_title . ': ' . tribe_get_start_date($related_event, false, $time_format) . ' - ' . tribe_get_end_date($related_event, false, $time_format); ?></p>
										<?php endif; ?>										
									<?php endforeach; ?>										
								</div>		
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>	
			<?php endif; ?>
		</div>
	</div>
