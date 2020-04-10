<?php get_header(); ?>

<section class="directory wrapper">
	<div class="container">
		<div class="title_row">
			<h1 class="page_title">Business Directory</h1>
			<div class="standard_btn">
				<a href="#">View Events Calendar</a>
			</div>
		</div>
		<div class="top_content">
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas risus magna, vulputate at elementum vel, feugiat vitae tortor. Donec vitae nisi eu metus facilisis rutrum. </p>
		</div>
		<div class="business_wrap">
			<ul class="featured_business">
				<li>
					<a href="#"><img src="<?php echo bloginfo('template_url'); ?>/images/grid_image.jpg" /></a>
				</li>
			</ul>
		</div>
		<div class="business_sort">
			<div class="business_form">
				<select>
					<option>View by Industry</option>
				</select>
				<select>
					<option>View by Alphabets</option>
				</select>
				<div class="standard_btn"><a href="#">SEARCH</a></div>
			</div>
			<ul>
				
				<?php 
					$alphabet = range('a', 'z');
					array_unshift($alphabet, '1-9');
					for($i = 0; $i < count($alphabet); $i++) : 
				?>
					<li><a href="/alpha/<?php echo $alphabet[$i]; ?>"><?php echo $alphabet[$i]; ?></a></li>
				<?php endfor; ?>
			</ul>
		</div>
		<div class="business_listing">
			<ul>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			
				<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				
			<?php endwhile; else: ?>
			
			<?php endif; ?>
			</ul>
		</div>
	</div>
</section>

<?php get_footer(); ?>