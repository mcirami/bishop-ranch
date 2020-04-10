<nav>
	<?php $post_id = get_the_ID(); ?>
    <?php if ( have_rows('sub_nav_pages')) : ?>
        <?php while ( have_rows('sub_nav_pages') ) : the_row(); ?>
            <a href="<?php the_sub_field('page_link'); ?>" <?php if($post_id === url_to_postid(get_sub_field('page_link'))) { echo 'class="current_page"'; } ?>><?php the_sub_field('page_title'); ?></a>
        <?php endwhile; ?>
    <?php endif; ?>
</nav>