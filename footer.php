<?php
/**
 * The template for displaying the footer.
 *
 * @package boiler
 */
?>
	<div id="login">
		<?php if(!is_user_logged_in()) : ?>
			<?php echo do_shortcode('[woocommerce_my_account]'); ?>
		<?php else : ?>
			<div>You are already logged in.</div>
		<?php endif; ?>
	</div>
	
	<footer id="global_footer" class="site_footer">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
					} ?>
				</ul>
			</div>
			<div class="footer_content">
				<div class="footer_right">
					<div class="social_icons">
						<ul>
							<li><a href="<?php the_field('facebook_link', 'options'); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/facebook_icon.png" /></a></li>
							<li><a href="<?php the_field('linkedin_link', 'options'); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/linkedin_icon.png" /></a></li>
							<li><a href="<?php the_field('youtube_link', 'options'); ?>"><img src="<?php echo bloginfo('template_url'); ?>/images/youtube_icon.png" /></a></li>
						</ul>
					</div>
					<div class="news_signup">
						<?php gravity_form(2, false, false, false, '', false); // constant contact signup form ?>
					</div>
				</div>
				<div class="footer_left">
					<div class="ft_logo">
						<img src="<?php echo bloginfo('template_url'); ?>/images/footer_logo.png" />
					</div>
					<div class="content_left">
						<?php the_field('email_address', 'options'); ?>
					</div>
					<div class="copyright">
						<?php the_field('copyright', 'options'); ?>
					</div>
				</div>
			</div>
		</div>
	</footer>

<?php wp_footer(); ?>

</body>
</html>