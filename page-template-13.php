<?php
/* *
 * Template Name: Template 13
 */
get_header(); ?>



<section class="template_13 wrapper">
    <div class="container">
        <h2 class="page_title"><?php the_title(); ?></h2>
        <?php $showNav = get_field('show_sub_navigation'); if ($showNav == TRUE) { ?>
            <div class="sub_nav">
                <?php get_template_part('content', 'sub-nav'); ?>
            </div>
        <?php } ?>
        <div class="content_container">
            <?php the_field('top_content'); ?>
        </div>
    </div>

    <?php get_template_part('content','template-13-sections'); ?>

</section>


<?php get_footer(); ?>