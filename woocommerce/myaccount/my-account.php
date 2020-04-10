<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

//wc_print_notices(); ?>

<div class="top_row">
	<div class="title_row">
		<h1 class="page_title"><?php the_title(); ?></h1>
	</div>
	<?php get_template_part('woocommerce/content', 'account-icons'); ?>
	<div class="page_content">
        <p>Bishop Ranch is easily accessible for commuters, customers, and visitors. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas risus magna, vulputate at elementum vel, feugiat vitae tortor. Donec vitae.</p>
	</div>
</div>

<section class="profile_section">
	
	<?php //do_action( 'woocommerce_before_my_account' ); ?>
	
	<?php global $current_user; get_currentuserinfo(); ?>
	
	<h3>Profile</h3>
	<div class="profile_container">
		<div class="prof_image_container">
			<img src="<?php the_field('profile_image', $current_user); ?>" />
		</div>
		<div class="profile_info">
			<div class="info_row"><p>Name:</p><p><?php the_field('name', $current_user); ?></p></div>
			<div class="info_row"><p>Building:</p><p><?php the_field('building', $current_user); ?></p></div>
			<div class="info_row"><p>Floor & Suite:</p><p><?php the_field('floor_suite', $current_user); ?></p></div>
			<div class="info_row"><p>Company:</p><p><?php the_field('company', $current_user); ?></p></div>
			<div class="info_row"><p>Title:</p><p><?php the_field('title', $current_user); ?></p></div>
		</div>
	</div>
	
	<h3>Activities</h3>
	<div class="activities_container">
		<?php do_action( 'woocommerce_before_my_account' ); ?>
	</div>
	
	<div class="activities_container">
		
		<div class="profile_table">
			<?php wc_get_template( 'myaccount/my-bookings.php' ); ?>
		</div>
		<div class="profile_table">
			<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>
		</div>

	</div>
	
	
	<?php //wc_get_template( 'myaccount/my-downloads.php' ); ?>

	<?php //do_action( 'woocommerce_after_my_account' ); ?>
	
	<?php //wc_get_template( 'myaccount/form-edit-account.php', array( 'user' => get_user_by( 'id', get_current_user_id() ) ) ); ?>

</section>
