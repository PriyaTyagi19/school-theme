<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header(); ?>

<main id="primary" class="site-main page-schedule">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            </header>

            <div class="entry-content">
                <?php
                the_content();

                // https://www.advancedcustomfields.com/resources/repeater/
                if( have_rows('schedule') ): ?>
                    <h2>Weekly Course Schedule</h2>
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Course</th>
                                <th>Instructor</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        while( have_rows('schedule') ) : the_row(); ?>
                            <tr>
                            <!-- Display subfields -->
                            <td><?php the_sub_field('date'); ?></td>
                            <td><?php the_sub_field('course'); ?></td>
                            <td><?php the_sub_field('instructor'); ?></td>
                            </tr>

                        <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
            ?>
        </article> <?php the_ID(); ?>

    <?php
    endwhile;
    ?>

</main><!-- #main -->

<?php
get_footer();
