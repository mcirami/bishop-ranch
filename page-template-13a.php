<?php
/* *
 * Template Name: Template 13a
 */
get_header(); ?>

<section class="template_13a wrapper">
    <div class="container">
        <div class="title_container">
            <div class="half">
                <h1 class="page_title"><?php the_title(); ?></h1>
            </div>
            <div class="half">
            </div>
        </div>
        <div class="content_container">
            <?php the_content(); ?>
        </div>
    </div>

    <?php get_template_part('content', 'template-13a-sections'); ?>

</section>


<?php get_footer(); ?>