<?php 
/* *
 * Template Name: Template 6
 */
get_header(); ?>

<section class="history wrapper">
	<div class="container">
		<div class="title_row">
			<h1 class="page_title"><?php the_title(); ?></h1>
		</div>
		<?php if(get_field('top_content')) : ?>
			<div class="top_content">
				<?php the_field('top_content'); ?>
			</div>
		<?php endif; ?>
		<div class="featured_timeline">
		<?php while(has_sub_field('featured_timeline')) : ?>
			<div class="ft_timeline_event">
			<?php $image = get_sub_field('featured_timeline_image'); ?>
				<a class="fancybox" href="<?php echo $image['url']; ?>"><img src="<?php echo $image['sizes']['thumb-180-150']; ?>" alt="<?php echo $image['alt']; ?>" /></a>
				<div class="ft_timeline_content">
					<h3><?php the_sub_field('featured_timeline_year'); ?></h3>
					<?php the_sub_field('featured_timeline_content'); ?>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
		
		<?php 
			$repeater = get_field('normal_timeline');
			$repeaterNum = count($repeater); 
		?>
		
		<h2 class="page_title alt_title">Bishop Ranch Timeline</h2>
		<div class="timeline">
			<ul class="timeline_events">
				<?php //Ajaxing from timeline-loop-handler.php ?>
			</ul>
			<div class="load_more">
				<a class="js-ajax" href="#">Load More</a>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	jQuery(document).ready(function($){
		// Ajax loop for timeline
		var events = 5;
		var loading = true;
		var $data;
		var page = 0;
		var eventCount = 0;
		var $content = $(".timeline_events");
		var load_posts = function() {
			$.ajax({
				type		: "GET",
				data		: {numEvents : 5, pageNumber : page},
				dataType	: "html",
				url			: "http://" + top.location.host.toString() + "/wp-content/themes/bishopranch/timeline-loop-handler.php",
				beforeSend	: function() {
					
				},
				success		: function(data) {
					$data = $(data);
					if($data.length){  
	                    $data.hide();  
	                    $content.append($data);  
	                    $data.fadeIn(500, function(){  
	                        $("#temp_load").remove();  
	                        loading = false;  
	                    });
	                    page++;
	                    eventCount += 5;
	                    if (eventCount >= <?php echo $repeaterNum; ?>) {
							$('.load_more').css('display', 'none');
						}
	                } else {  
	                    $("#temp_load").remove();
	                } 
				},
				error		: function(jqXHR, textStatus, errorThrown) {
					$("#temp_load").remove();  
					alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
				}
			});
		};		
		load_posts();
		
		$('.js-ajax').click(function(e){
			e.preventDefault();
			load_posts();
			
			//if(events >= eventCount){
				//$(this).css('display', 'none');
			//}
		});
	});
</script>

<?php get_footer(); ?>