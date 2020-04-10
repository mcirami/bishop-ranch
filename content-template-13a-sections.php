<?php if( have_rows('content_section2')) : ?>
    <article class="content_section">
        <div class="container">
            <?php while(has_sub_field('alternative_content_section')) : ?>
                <div class="subject_section">
                    <div class="content_container">
                        <h3 class="subject_section_title"><?php the_sub_field('alt_title'); ?></h3>
                        <?php the_sub_field('alt_content'); ?>                        
                        <div class="standard_btn green_bttn">
                            <a href="<?php the_sub_field('alt_downloads'); ?>" download><p><?php the_sub_field('alt_download_content_title'); ?></p><img src="<?php echo bloginfo('template_url'); ?>/images/handbooks_download_icon.png"></a>
                        </div>
                    </div>
                    <div class="download_section">
                        <h4>Download PDF</h4>
                        <?php if( get_sub_field('alt_download_list' )) : ?>
                            <ul>
                                <?php while ( has_sub_field('alt_download_list' ) ) : ?>
                                    <?php
                                    $downloadFile = get_sub_field('download_file');
                                    $downloadTitle = get_sub_field('download_file_title');
                                    ?>
                                    <li><a href="<?php echo $downloadFile; ?>" download><?php echo $downloadTitle; ?></a></li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </article><!-- end of alternative section -->
<?php endif; ?>


<?php $altSec = get_field('show_alternative_content_section'); if( $altSec == TRUE) { ?>
<?php if( have_rows('alternative_content_section')) : ?>
        <article class="content_section">
            <div class="container">
                <?php while(has_sub_field('content_section2')) : ?>
                    <div class="subject_section">
                        <h3 class="subject_section_title"><?php the_sub_field('content_title2');?></h3>
                        <?php if(get_sub_field('image_gallery')) : ?>
                            <ul>
                                <?php while(has_sub_field('image_gallery')) : ?>
                                    <?php
                                    $galImg = get_sub_field('gal_img');
                                    $galTitle = get_sub_field('gal_img_title');
                                    ?>
                                    <li>
                                        <a href="<?php echo $galImg['url']; ?>" download><img src="<?php echo $galImg['sizes']['thumb-214-131']; ?>" alt="<?php echo $galTitle; ?>" title="<?php echo $galTitle; ?>"/></a>
                                        <div class="subject_info">
                        <span class="subject_name">
                            <p><?php echo $galTitle; ?></p>
                        </span>
                                            <?php  //print_r($galImg); ?>
                                        </div><!-- end of subject info -->
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>                        
                        <div class="standard_btn green_bttn">
                            <a href="<?php the_sub_field('download'); ?>" download><p><?php the_sub_field('download_content_title'); ?></p><img src="<?php echo bloginfo('template_url'); ?>/images/handbooks_download_icon.png"></a>
                        </div>
                    </div><!-- end of subject section -->
                <?php endwhile; ?>
            </div>
        </article><!-- end of content section -->
<?php endif; ?>
<?php } ?>