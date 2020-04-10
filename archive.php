<?php
/**
 * Template Name: Archives
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package boiler
 */

get_header(); ?>

	<section class="press_releases wrapper">
		<div class="container">

		<?php if ( have_posts() ) : ?>

			<div class="title_row">
				<h1 class="page-title">
					<?php
						if ( is_category() ) :
							printf( __( 'Category Archives: %s', 'boiler' ), '<span>' . single_cat_title( '', false ) . '</span>' );

						elseif ( is_tag() ) :
							printf( __( 'Tag Archives: %s', 'boiler' ), '<span>' . single_tag_title( '', false ) . '</span>' );

						elseif ( is_author() ) :
							/* Queue the first post, that way we know
							 * what author we're dealing with (if that is the case).
							*/
							the_post();
							printf( __( 'Author Archives: %s', 'boiler' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
							/* Since we called the_post() above, we need to
							 * rewind the loop back to the beginning that way
							 * we can run the loop properly, in full.
							 */
							rewind_posts();

						elseif ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'boiler' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'boiler' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'boiler' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( 'Asides', 'boiler' );

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( 'Images', 'boiler');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( 'Videos', 'boiler' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( 'Quotes', 'boiler' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( 'Links', 'boiler' );

						else :
							_e( 'Archives', 'boiler' );

						endif;
					?>
				</h1>
                </div><!-- end of title row -->
				<?php
					if ( is_category() ) :
						// show an optional category description
						$category_description = category_description();
						if ( ! empty( $category_description ) ) :
							echo apply_filters( 'category_archive_meta', '<div class="taxonomy-description">' . $category_description . '</div>' );
						endif;

					elseif ( is_tag() ) :
						// show an optional tag description
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) ) :
							echo apply_filters( 'tag_archive_meta', '<div class="taxonomy-description">' . $tag_description . '</div>' );
						endif;

					endif;
				?>
			</div>
            <div class="container press_release_wrap">
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to overload this in a child theme then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					// get_template_part( 'content', get_post_format() );

				?>
                <div class="press_release">
                    <div class="pr_image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="pr_content">
                        <p class="garamond date"><?php the_time('j F Y'); ?></p>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_excerpt(); ?></p>
                        <a class="read_full" href="<?php the_permalink(); ?>">Read Full Story</a>
                    </div>
                </div><!-- end of press release -->

			<?php endwhile; ?>
                <div class="pagination">
                    <?php br_pagination(); ?>
                </div>

			<?php//boiler_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</div>

		
	</section>

<?php get_footer(); ?>