<?php
/**
 * The Template for displaying all events posts.
 *
 * @package boiler
 */

get_header(); ?>

	
	<section class="single_event wrapper">
		
		<article class="container">
			
			<div class="single_header">
				<h2 class="page_title"><?php the_title(); ?></h2>
				
				<div class="tribe-events-schedule updated published tribe-clearfix">
					<h3>Time: <?php echo tribe_get_start_date( $event, false, 'h:i A' ) . ' - ' . tribe_get_end_date( $event, false, 'h:i A' ); ?><span class="title_divider">|</span>Location: <?php echo tribe_get_venue( $event->ID ); ?> <?php if(get_field('suite_number', $event->ID)) { echo '- '.get_field('suite_number', $event->ID); } ?> (<a href="#">View Map</a>)</h3>
					<?php //echo tribe_events_event_schedule_details( $event_id, '<h3>', '</h3>' ); ?>
					<div class="feeds">
						<a href="<?php get_category_feed_link( get_query_var( 'cat' ) ); ?>feed"> Subscribe</a>
					</div>
					<div class="tribe-events-cal-links">
						<p class="add_to_calendar">Add to Calendar<i class="fa fa-chevron-down"></i></p>
						<div class="calendar_links">
							<a class="tribe-events-gcal tribe-events-button" href="<?php echo tribe_get_gcal_link(); ?>" title="<?php echo __( 'Add to Google Calendar', 'tribe-events-calendar' ); ?>"><?php echo __( 'Google Calendar', 'tribe-events-calendar-pro' ); ?></a>
							<a class="tribe-events-ical tribe-events-button" href="<?php echo tribe_get_single_ical_link(); ?>"><?php echo __( 'iCal Import', 'tribe-events-calendar' ); ?></a>
						</div>
					</div><!-- .tribe-events-cal-links -->
				</div>
				
				<?php echo do_shortcode('[button link="/events-calendar"]View Events Calendar[/button]'); ?>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>
	
				<?php get_template_part( 'content', 'single' ); ?>
	
			<?php endwhile; // end of the loop. ?>
			
			<div class="mobile_view_events_calendar">
				<?php echo do_shortcode('[button link="/events-calendar"]View Events Calendar[/button]'); ?>
			</div>
		
		</article>

	</section>

<?php get_footer(); ?>