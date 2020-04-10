<article class="header_section">
    <div class="container">
        <div class="temp_12_header">
            <div class="temp_half">
                <?php if( have_rows('icons_titles_links')) : ?>
                    <ul>
                        <?php while( have_rows('icons_titles_links')) : the_row(); ?>
                            <li>
                                <img src="<?php the_sub_field('icon_image'); ?>" alt="<?php the_sub_field('icon_title'); ?>"/>
                                <a href="<?php the_sub_field('icon_page_link'); ?>"><p><?php the_sub_field('icon_title'); ?></p></a>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="temp_half">
                <a href="<?php the_field('download_all'); ?>" download>
                    <div class="green_bttn">
                        <p><?php the_field('download_all_title'); ?></p>
                    </div>
                </a>
            </div>
            <div class="header_content">
                <?php the_content(); ?>
            </div>
        </div><!-- end of template header -->
    </div>
</article><!-- end of header section -->