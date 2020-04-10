<?php
	define('WP_USE_THEMES', false);  
	require_once('../../../wp-load.php');
	$sqft = ($_GET['sqft']) ? esc_attr($_GET['sqft']) : null;
?>

<?php
if($sqft) {
	$range = explode(' ', $sqft);
	if($range[0] === '20,000') {
		$range[2] = '9999999';
	}
} ?>
	
<?php
	if(!$sqft) {
		$amenities = get_field('default_amenities', 'options');
	} else if($range[0] == '0' && $range[2] == '1,000' ) {
		$amenities = get_field('range_1', 'options');
	} else if ($range[0] == '1,000' && $range[2] == '2,500') {
		$amenities = get_field('range_2', 'options');
	} else if ($range[0] == '2,500' && $range[2] == '5,000') {
		$amenities = get_field('range_3', 'options');
	} else if ($range[0] == '5,000' && $range[2] == '20,000') {
		$amenities = get_field('range_4', 'options');
	} else if ($range[0] == '20,000' && $range[2] == '99999999') {
		$amenities = get_field('range_5', 'options');
	}
?>

<?php if($amenities) : ?>
	<?php foreach($amenities as $amenity) : ?>
		<div class="highlights">
			<?php $threeColConImage = get_field('amenity_image', $amenity->ID); ?>
			<a href="<?php the_field('amenity_link', $amenity->ID); ?>"><img src="<?php echo $threeColConImage['sizes']['thumb-180-135']; ?>" alt="<?php echo $threeColConImage['alt']; ?>" /></a>
			<div class="highlight_content">
				<h3><a href="<?php echo the_field('amenity_link', $amenity->ID); ?>"><?php echo $amenity->post_title; ?></a></h3>
				<?php the_field('amenity_description', $amenity->ID); ?>
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
