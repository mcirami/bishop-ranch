<?php
/**
 * My Bookings
 *
 * Shows bookings on the account page
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<h2 class="activities_header">Conference Room Booking</h2>

<table class="shop_table my_account_bookings">
	<thead>
		<tr>
			<th scope="col">Room #</th>
			<th scope="col">Date</th>
			<th scope="col">Time</th>
		</tr>
	</thead>
	<tbody>
		<?php $bookings = WC_Bookings_Controller::get_bookings_for_user( get_current_user_id() ); ?>
		<?php if($bookings) : ?>
			<?php foreach ( $bookings as $booking ) : ?>
				<tr>
					<td>
						<?php if ( $booking->get_product() ) : ?>
							<a href="<?php echo get_permalink( $booking->get_product()->id ); ?>">
								<?php echo $booking->get_product()->get_title(); ?>
							</a>
						 <?php endif; ?>
					</td>
					<td>
						<?php if ( $booking->get_product() ) : ?>
							<a href="<?php echo get_permalink( $booking->get_product()->id ); ?>">
								<?php echo date('F d, Y', $booking->start); ?>
							</a>
						 <?php endif; ?>
					</td>
					<td>
						<?php if ( $booking->get_product() ) : ?>
							<a href="<?php echo get_permalink( $booking->get_product()->id ); ?>">
								<?php echo date('g:ia', $booking->start) . "-" . date('g:ia', $booking->end); ?>
							</a>
						 <?php endif; ?>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>

<table class="shop_table my_account_bookings_mobile">
	<?php if($bookings) : ?>
		<?php foreach ( $bookings as $booking ) : ?>
			<tr>
				<th scope="row">Room #</th>
				<td>
					<?php if ( $booking->get_product() ) : ?>
						<a href="<?php echo get_permalink( $booking->get_product()->id ); ?>">
							<?php echo $booking->get_product()->get_title(); ?>
						</a>
					 <?php endif; ?>
				</td>
			</tr>
			<tr>
				<th scope="row">Date</th>
				<td>
					<?php if ( $booking->get_product() ) : ?>
						<a href="<?php echo get_permalink( $booking->get_product()->id ); ?>">
							<?php echo date('F d, Y', $booking->start); ?>
						</a>
					 <?php endif; ?>
				</td>
			</tr>
			<tr>
				<th scope="row">Time</th>
				<td>
					<?php if ( $booking->get_product() ) : ?>
						<a href="<?php echo get_permalink( $booking->get_product()->id ); ?>">
							<?php echo date('g:ia', $booking->start) . "-" . date('g:ia', $booking->end); ?>
						</a>
					 <?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>			
</table>