<?php 
/* *
 * Template Name: Template 4
 */
get_header(); ?>

<section class="events wrapper">
	<div class="container">
		<div class="title_row">
			<h1 class="page_title"><?php the_title(); ?></h1>
			<?php if(get_field('button_link')) : ?>
			<div class="standard_btn">
				<a href="<?php the_field('button_link'); ?>"><?php the_field('button_text'); ?></a>
			</div>
			<?php endif; ?>
		</div>
		<?php if (get_field('page_description')) : ?>
			<div class="top_content">
				<?php the_field('page_description'); ?>
			</div>
		<?php endif; ?>

		<?php if (have_rows('slides')) : ?>
		<div class="special_events">
			<h2 class="page_title"><?php the_field('slide_title'); ?></h2>
			<div class="flexslider_events">
				<ul class="slides">
					<?php while (have_rows('slides')) : the_row(); ?>
						<li>
							<div class="slide_image">
								<?php $eventImage = get_sub_field('slide_image'); ?>
								<?php /*<a class="fancybox" data-fancybox-type="ajax" href="<?php bloginfo('template_url'); ?>/ajax-image.php?image=<?php echo $eventImage['ID']; ?>"><img src="<?php echo $eventImage['url']; ?>" alt="<?php echo $eventImage['alt']; ?>" /></a>*/ ?>
								<img src="<?php echo $eventImage['url']; ?>" alt="<?php echo $eventImage['alt']; ?>" />
							</div>
							<div class="slide_content">
								<?php the_sub_field('slide_content'); ?>			
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		</div>
		<?php endif; ?>
		<?php get_template_part('content', 'sections'); ?>
	</div>
</section>

<?php get_footer(); ?>