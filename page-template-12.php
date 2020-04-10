<?php
/* *
 * Template Name: Template 12
 */
get_header(); ?>

<section class="template_12 wrapper">
    <div class="container">
<!--        <div class="temp_12_header">-->
<!--            <div class="temp_half">-->
<!--                <h2>Welcome</h2>-->
<!--                --><?php //if( have_rows('icons_and_link')) : ?>
<!--                <ul>-->
<!--                    --><?php //while( have_rows('icons_and_link')) : the_row(); ?>
<!--                    <li>-->
<!--                        <img src="--><?php //the_sub_field('icon_image'); ?><!--" alt="--><?php //the_sub_field('icon_title'); ?><!--"/>-->
<!--                        <a href="--><?php //the_sub_field('page_link'); ?><!--"><p>--><?php //the_sub_field('icon_title'); ?><!--</p></a>-->
<!--                    </li>-->
<!--                    --><?php //endwhile; ?>
<!--                </ul>-->
<!--                --><?php //endif; ?>
<!--            </div>-->
<!---->
<!--            <div class="temp_half">-->
<!--                <a href="--><?php //the_field('download_handbook'); ?><!--" download>-->
<!--                    <div class="green_bttn">-->
<!--                        <p>--><?php //the_field('downloads_handbook_title'); ?><!--</p>-->
<!--                    </div>-->
<!--                </a>-->
<!--            </div>-->
<!--            <div class="header_content">-->
<!--                --><?php //the_content(); ?>
<!--            </div>-->
<!--        </div><!-- end of template header -->-->

        <div class="profile_container container">
            <h3>Profile</h3>

            <div class="container_info">
                <div class="member_img">
                    <img src="http://dummyimage.com/212x150/000/fff" alt="make sure you add this in!"/>
                </div>

                <div class="member_content">
                    <?php if( have_rows('profile_info')) : ?>
                    <ul class="labels">
                        <?php while( have_rows('profile_info')) : the_row();
                            $profileLabel = get_sub_field('profile_info_label');
                            $profileInput = get_sub_field('profile_info_input');
                            ?>
                        <li><?php echo $profileLabel; ?></li>
                        <?php endwhile; ?>
                    </ul>
                    <ul class="label_info">
                        <li><?php echo $profileInput; ?></li>
                    <?php endif; ?>
                    </ul>
                </div><!-- end of member content -->
            </div><!-- end of member info -->
            <div class="activities_container">
                <h3>Actives</h3>

                <div class="activities_table">
                    <table>
                        <caption>Conference Room Booking</caption>
                        <thead>
                            <tr>
                                <td>Room #</td>
                                <td>Date</td>
                                <td>Time</td>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Meeting 1</td>
                            <td>August 25, 2014</td>
                            <td>9am - 5pm</td>
                        </tr>
                        <tr>
                            <td>Meeting 1</td>
                            <td>August 25, 2014</td>
                            <td>9am - 5pm</td>
                        </tr>
                        <tr>
                            <td>Meeting 1</td>
                            <td>August 25, 2014</td>
                            <td>9am - 5pm</td>
                        </tr>
                        </tbody>
                    </table><!-- end of table -->
                </div><!-- end of activities container -->
            </div><!-- end of activities container -->
        </div><!-- end of profile container -->
    </div>
</section><!-- end of section -->

<?php get_footer(); ?>