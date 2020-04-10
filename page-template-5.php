<?php 
/* *
 * Template Name: Template 5
 */
get_header(); ?>

<section class="template_5 wrapper">
	<div class="container">
		
		<?php if(get_field('active', 'options') && get_field('transportation_alerts')) : ?>
			<div class="transportation_alert">
				<h3><?php the_field('alert_text', 'options'); ?></h3>
				<img src="<?php echo bloginfo('template_url'); ?>/images/alert_close.png" alt="close_button">
			</div>
		<?php endif; ?>
		
		<?php get_template_part('content', 'template-5-sections'); ?>
	</div>
</section>

<?php get_footer(); ?>