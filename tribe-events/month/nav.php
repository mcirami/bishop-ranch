<?php
/**
 * Month View Nav Template
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php do_action( 'tribe_events_before_nav' ) ?>

<h3 class="tribe-events-visuallyhidden"><?php _e( 'Calendar Month Navigation', 'tribe-events-calendar' ) ?></h3>

<ul class="tribe-events-sub-nav">
	<li class="previous_button">
		<a href="<?php echo tribe_get_previous_month_link(); ?>"><img class="previous_desktop" src="<?php echo bloginfo('template_url'); ?>/images/chevron_left.png"/><img class="previous_mobile" src="<?php echo bloginfo('template_url'); ?>/images/chevron_left_dark.png"/></a>
	</li>
	<li class="tribe-events-nav-previous">
		<?php tribe_events_the_previous_month_link(); ?>
	</li>
	<li class="current_month"><a href="#"><?php echo tribe_get_current_month_text(); ?></a></li>
	<!-- .tribe-events-nav-previous -->
	<li class="tribe-events-nav-next">
		<?php tribe_events_the_next_month_link(); ?>
	</li>
	<li class="next_button">
		<a href="<?php echo tribe_get_next_month_link(); ?>"><img class="next_desktop" src="<?php echo bloginfo('template_url'); ?>/images/chevron_right.png"/><img class="next_mobile" src="<?php echo bloginfo('template_url'); ?>/images/chevron_right_dark.png"/></a>
	</li>
	<!-- .tribe-events-nav-next -->
</ul><!-- .tribe-events-sub-nav -->

<?php do_action( 'tribe_events_after_nav' ) ?>
