<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<?php wc_print_notices(); ?>

	<?php 
		global $profileUserID;
		global $current_user;
		get_currentuserinfo();
		$profileUserID = $current_user->ID;
	?>

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>
	
	<h3>Profile</h3>
	<div class="profile_container">
		<div class="prof_image_container">
			<img src="<?php the_field('profile_image', $user); ?>" alt="profile"/>
			<form action="<?php echo bloginfo('template_url'); ?>/woocommerce/myaccount/uploads.php" method="post" enctype="multipart/form-data">
			    <p>Select image to upload (Limit 2MB, jpg, png, gif)</p>
			    <input class="upload_field" type="file" name="fileToUpload" id="fileToUpload" required="required">
			    <input class="image_upload_submit" type="submit" value="Upload Image" name="submit">
			</form>
		</div>
		<form action="" method="post">
		<div class="profile_info">
			<div class="info_row">
				<label for="account_name"><?php _e( 'Name', 'woocommerce' ); ?></label>
				<input type="text" class="input-text" name="account_name" id="account_name" value="<?php the_field('name', $user); ?>" />
			</div>
			<div class="info_row">
				<label for="account_building"><?php _e( 'Building', 'woocommerce' ); ?></label>
				<input type="text" class="input-text" name="account_building" id="account_building" value="<?php the_field('building', $user); ?>" />
			</div>
			<div class="info_row">
				<label for="account_floor_suite"><?php _e( 'Floor & Suite', 'woocommerce' ); ?></label>
				<input type="text" class="input-text" name="account_floor_suite" id="account_floor_suite" value="<?php the_field('floor_suite', $user); ?>" />
			</div>
			<div class="info_row">
				<label for="account_company"><?php _e( 'Company', 'woocommerce' ); ?></label>
				<input type="text" class="input-text" name="account_company" id="account_company" value="<?php the_field('company', $user); ?>" />
			</div>
			<div class="info_row">
				<label for="account_title"><?php _e( 'Title', 'woocommerce' ); ?></label>
				<input type="text" class="input-text" name="account_title" id="account_title" value="<?php the_field('title', $user); ?>" />
			</div>
		</div>
	</div>

	<h3>General Information</h3>
	<div class="general_information">
		<div class="general_info_row">
			<div class="additional_information">
				<h4>Additional Information</h4>
				<div class="info_row">
					<label for="account_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_phone" id="account_phone" value="<?php the_field('phone_number', $user); ?>" />
				</div>
				<div class="info_row">
					<label for="account_fax"><?php _e( 'Fax', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_fax" id="account_fax" value="<?php the_field('fax_number', $user); ?>" />
				</div>
				<div class="info_row">
					<label for="account_email"><?php _e( 'Email', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_email" id="account_email" value="<?php the_field('email_address', $user); ?>" />
				</div>
				<div class="info_row">
					<label for="account_cc"><?php _e( 'CC', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_cc" id="account_cc" value="<?php the_field('cc_address', $user); ?>" />
				</div>
			</div>	
			<div class="spacer"></div>	
			<div class="emergency_contact">
				<h4>Emergency Contact</h4>
				<div class="info_row">
					<label for="account_emergency_phone_one"><?php _e( 'Phone 1', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_emergency_phone_one" id="account_emergency_phone_one" value="<?php the_field('emergency_phone_one', $user); ?>" />
				</div>
				<div class="info_row">
					<label for="account_emergency_phone_two"><?php _e( 'Phone 2', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_emergency_phone_two" id="account_emergency_phone_two" value="<?php the_field('emergency_phone_two', $user); ?>" />
				</div>
				<div class="info_row">
					<label for="account_emergency_email"><?php _e( 'Email', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_emergency_email" id="account_emergency_email" value="<?php the_field('emergency_email', $user); ?>" />
				</div>
				<div class="info_row">
					<label for="account_emergency_sms"><?php _e( 'SMS', 'woocommerce' ); ?></label>
					<input type="text" class="input-text" name="account_emergency_sms" id="account_emergency_sms" value="<?php the_field('emergency_sms', $user); ?>" />
				</div>
			</div>
		</div>
		<div class="general_info_row">
			<div class="login_info">
				<h4>Login</h4>
				<div class="info_row">
					<label for="password_current"><?php _e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_current" id="password_current" />
				</div>
				<div class="info_row">
					<label for="password_1"><?php _e( 'New Password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_1" id="password_1" />
				</div>
				<div class="info_row">
					<label for="password_2"><?php _e( 'Confirm New Password', 'woocommerce' ); ?></label>
					<input type="password" class="input-text" name="password_2" id="password_2" />
				</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p class="clear">
		<?php wp_nonce_field( 'bishopranch_update_account_details' ); ?>
		<input type="submit" class="button" name="bishopranch_update_account_details" value="<?php _e( 'Save', 'woocommerce' ); ?>" />
		<input type="hidden" name="action" value="bishopranch_update_account_details" />
	</p>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
	
</form>