<?php
/**
 * Month View Content Template
 * The content template for the month view of events. This template is also used for
 * the response that is returned on month view ajax requests.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/content.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div id="tribe-events-content" class="tribe-events-month">

	<!-- Month Title -->
	<!--<?php do_action( 'tribe_events_before_the_title' ) ?>
	<h2 class="tribe-events-page-title"><?php tribe_events_title() ?></h2>
	<?php do_action( 'tribe_events_after_the_title' ) ?>-->

	<!-- Notices -->
	<!--<?php tribe_events_the_notices() ?>-->
	
	<div class="event_filters">
		<?php 
			$taxonomies = array('tribe_events_cat');
			$args = array('orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false);
			
			$terms = get_terms($taxonomies, $args);
			
			if($terms) {
				foreach($terms as $term) {
		?>
			<div class="filter"><input type="checkbox" class="input-checkbox" id="<?php echo $term->slug; ?>" name="<?php echo $term->slug; ?>"><label for="<?php echo $term->slug; ?>"><?php echo $term->name; ?></label></div>
		<?php 
				}
		?>
				<a href="#" class="clear_event_filters">Clear All</a>
		<?php
			}
		?>
	</div>
	<div class="mobile_event_filters">
		<select id="mobile_select">
			<option value ="all_events">Filter event</option>
		<?php foreach($terms as $term) : ?>
			<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
		<?php endforeach; ?>
		</select>
	</div>

	<!-- Month Header -->
	<?php do_action( 'tribe_events_before_header' ) ?>
	<div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
		<?php $header_image = get_field(strtolower(tribe_get_current_month_text()).'_header', 'options'); ?>
		<img src="<?php echo $header_image['url']; ?>" alt="<?php echo $header_image['alt']; ?>">

		<div class="header_navigation">
			<!-- Header Navigation -->
			<?php tribe_get_template_part( 'month/nav' ); ?>
		</div>

	</div>
	<!-- #tribe-events-header -->
	<?php do_action( 'tribe_events_after_header' ) ?>

	<!-- Month Grid -->
	<?php tribe_get_template_part( 'month/loop', 'grid' ) ?>
	
	<!-- Where the event data will go when a day is clicked on -->
	<div class="events_detail">
		<h2></h2>
		<div class="events_container">
		
		</div>
	</div>

	<!-- Month Footer -->
	<?php do_action( 'tribe_events_before_footer' ) ?>
	<div id="tribe-events-footer">

		<!-- Footer Navigation -->
		<?php //do_action( 'tribe_events_before_footer_nav' ); ?>
		<?php //tribe_get_template_part( 'month/nav' ); ?>
		<?php //do_action( 'tribe_events_after_footer_nav' ); ?>

	</div>
	<!-- #tribe-events-footer -->
	<?php //do_action( 'tribe_events_after_footer' ) ?>

	<?php tribe_get_template_part( 'month/mobile' ); ?>
	<?php //tribe_get_template_part( 'month/tooltip' ); ?>

</div><!-- #tribe-events-content -->

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#mobile_select').ddslick({
			data: selectedOption
		});
		
		var filter = '<?php if($_GET['event_type']) { echo esc_attr($_GET['event_type']); } else { echo 'none'; } ?>';
		
		if(filter != 'none') {
			$('.event_filters .filter input[type="checkbox"]#'+filter).attr('checked', true);
			
			var categories = new Array(filter);
			
			$('.tribe-events-calendar .day_content .tribe_events').removeClass('filter_hidden_event');
			
			$('.tribe-events-calendar .day_content .tribe_events').each(function(e) {
				var hasCategory = false;
				
				if(categories.length == 0) {
					hasCategory = true;
				}
				
				for(var i = 0; i < categories.length; i++) {
					var category = categories[i];
					if($(this).hasClass('tribe-events-category-'+category)) {
						hasCategory = true;
					}
				}
				
				if(!hasCategory) {
					$(this).addClass('filter_hidden_event');
				}
			});
		}
		
		var selectedOption = $('#mobile_select').data('ddslick');
		
		$('#mobile_select').on('click', function(e) {
			
			console.log(selectedOption);
		});
		
		var select = '<?php if($_GET['event_type']) { echo esc_attr($_GET['event_type']); } else { echo 'all_events'; } ?>';
		
		if(select != 'all_events') {
			$('.event_filters .filter input[type="select"]#'+select).attr('selected', true);
			
			var mobileCategories = new Array(select);
			
			$('.tribe-events-calendar .day_content .tribe_events').removeClass('filter_hidden_event');
			
			$('.tribe-events-calendar .day_content .tribe_events').each(function(e) {
				var hasMobileCategory = false;
				
				if(mobileCategories.length == 0) {
					hasMobileCategory = true;
				}
				
				for(var i = 0; i < mobileCategories.length; i++) {
					var mobileCategory = mobileCategories[i];
					if($(this).hasClass('tribe-events-category-'+mobileCategory)) {
						hasMobileCategory = true;
					}
				}
				
				if(!hasMobileCategory) {
					$(this).addClass('filter_hidden_event');
				}
			});
		}
	});
</script>
	