<div class="top_icons">
	<a href="/my-account" class="top_icon">
		<img src="<?php echo bloginfo('template_url'); ?>/images/profile_home_icon.png" alt="home"/>
		<p>Home</p>
	</a>
	<?php 
		global $current_user;
		get_currentuserinfo();
		$user_id = $current_user->ID;
		$user_info = get_userdata($user_id);
		$user_role = implode(',', $user_info->roles);
	?>
	<?php if($user_role === 'angus-user' || $user_role === 'administrator') : ?>
	<?php $serviceLink = get_permalink(4383); ?>
	<a href="<?php echo $serviceLink; ?>" class="top_icon">
		<img src="<?php echo bloginfo('template_url'); ?>/images/profile_service_req_icon.png" alt="service-request"/>
		<p>Service Request</p>
	</a>
	<?php endif; ?>
	<a href="/profile" class="top_icon">
		<img src="<?php echo bloginfo('template_url'); ?>/images/profile_profile_icon.png" alt="profile"/>
		<p>Profile</p>
	</a>	
	<a href="/payment" class="top_icon">
		<img src="<?php echo bloginfo('template_url'); ?>/images/profile_payment_icon.png" alt="payment"/>
		<p>Payment</p>
	</a>		
</div>