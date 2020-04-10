<?php
/**
 * Template Name: Payment
 *
 * @package boiler
 */
 
if ( !is_user_logged_in() ) {
	wp_safe_redirect( get_permalink( wc_get_page_id( 'myaccount' ) ) );
}

get_header('shop'); ?>

	<section class="page wrapper">
		<div class="container">
			<div class="top_row">
				<div class="title_row">
					<h1 class="page_title">Welcome</h1>
				</div>
				<?php get_template_part('woocommerce/content', 'account-icons'); ?>
				<div class="page_content"><?php the_content(); ?></div>
				<div class="standard_btn handbooks"><a href="#"><p>Download Handbooks</p><img src="<?php echo bloginfo('template_url'); ?>/images/handbooks_download_icon.png"></a></div>
			</div>
			
			<section class="profile_section">
	
				<?php //do_action( 'woocommerce_before_my_account' ); ?>
	
				<?php global $current_user; get_currentuserinfo(); ?>
				
				<h3>Payment Methods</h3>
				<div class="current_payment_methods">
					<?php do_action( 'woocommerce_after_my_account' ); ?>
				</div>
				
				<h3>Add a New Payment</h3>
				<div class="add_payment">
					<?php wc_get_template('myaccount/form-add-payment-method.php'); ?>
				</div>
			</section>
		</div>	
	</section>

<?php get_footer('shop'); ?>
