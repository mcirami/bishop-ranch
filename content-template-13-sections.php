<?php if(have_rows('content_section')) : ?>
<article class="content_section">
    <div class="container">
        <?php while (has_sub_field('content_section') ) : ?>
            <div class="subject_section">
                <h3 class="subject_section_title"><?php the_sub_field('content_title');?></h3>
                <?php $drop_shadows = get_sub_field('drop_shadows'); ?>
                <?php if(get_sub_field('subject_matter') ) : ?>
                <ul>
                    <?php while(has_sub_field('subject_matter') ) :?>
                        <?php
                            $memberImg = get_sub_field('subject_image');
                            $memberName = get_sub_field('subject_name');
                            $memberTitle = get_sub_field('subject_title');
                        ?>
                        <li <?php if($drop_shadows) { echo 'class="br_shadow"'; } ?>>
                        <?php if ( get_sub_field('link_type') === '_self' ) : ?>
	                        <a href="<?php the_sub_field('link_page'); ?>" target="<?php the_sub_field('link_type'); ?>">
		                        <img src="<?php echo $memberImg['sizes']['thumb-214-131']; ?>" alt="<?php echo $memberName; ?>" title="<?php echo $memberName; ?>"/>
		                     </a>
                        <?php elseif ( get_sub_field('link_type') === '_blank' ) : ?>
                        	<?php $file = get_sub_field('link_file'); ?>
                        	<a href="<?php echo $file['url']; ?>" target="<?php the_sub_field('link_type'); ?>">
	                        	<img src="<?php echo $memberImg['sizes']['thumb-214-131']; ?>" alt="<?php echo $memberName; ?>" title="<?php echo $memberName; ?>"/>
	                        </a>
                        <?php elseif ( get_sub_field('link_type') === 'full_image'  ) : ?>
                        	<a href="<?php echo $memberImg['url']; ?>" target="_blank">
	                        	<img src="<?php echo $memberImg['sizes']['thumb-214-131']; ?>" alt="<?php echo $memberName; ?>" title="<?php echo $memberName; ?>"/>
                        	</a>
                        <?php else : ?>
                        	<img src="<?php echo $memberImg['sizes']['thumb-214-131']; ?>" alt="<?php echo $memberName; ?>" title="<?php echo $memberName; ?>"/>
                        <?php endif; ?>
                            <div class="subject_info">
                                <span class="subject_name">
                                    <p><?php echo $memberName; ?></p>
                                </span>
                                <span class="subject_title">
                                    <p><?php echo $memberTitle; ?></p>
                                </span>
                            </div>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <?php endif; ?>
            </div><!-- end of subject section -->
        <?php endwhile; ?>
    </div>
</article><!-- end of content section -->
<?php endif; ?>