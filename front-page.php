<?php
/**
* The template for displaying the Home page
*
* This is the template that displays the home page.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site may use a
* different template.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package School_Theme
*/

get_header();
?>

<main id="primary" class="site-main">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();

        endif;

    endwhile; // End of the loop.
    ?>

    <section class="recent-posts">
        <h2>Recent News</h2>
        <ul>
        <?php
        $recent_posts = new WP_Query(array(
            'posts_per_page' => 3,
            'post_status' => 'publish'
        ));

        if ( $recent_posts->have_posts() ) :
            while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail('thumbnail'); ?>
                            <?php endif; ?>
                            <span><?php the_title(); ?></span>
                            
                        </a>
                    </li>
                <?php
            endwhile;

            wp_reset_postdata();

        else :
            ?>
            <li><?php esc_html_e( 'There are no posts available.', 'school-theme' ); ?></li>
            <?php
        endif;
        ?>

        </ul>
        <a href="<?php echo get_permalink(get_option( 'page_for_posts' )); ?>" class="see-all-news">See All News</a>

    </section>

</main>

<?php
get_footer();
?>
