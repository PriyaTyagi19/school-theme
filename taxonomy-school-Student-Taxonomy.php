<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
        </header><!-- .page-header -->

        <?php
        /* Start the Loop */
        // while ( have_posts() ) :
        //     the_post();
            // Retrieve terms of the taxonomy attached to the post
            $terms = wp_get_post_terms( get_the_ID(), 'school-Student-Taxonomy' );
            if ( $terms && ! is_wp_error( $terms ) ) :
                // Loop through each term and display links to other students in the same category
                foreach ( $terms as $term ) {
                    $term_args = array(
                        'post_type'      => 'students',
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'school-Student-Taxonomy',
                                'field'    => 'slug',
                                'terms'    => $term->slug,
                            ),
                        ),
                    );
                    $term_query = new WP_Query( $term_args );
                    if ( $term_query->have_posts() ) :
                        while ( $term_query->have_posts() ) :
                            $term_query->the_post();
                            ?>
                            <article>
                                <a href="<?php the_permalink(); ?>">
                                    <h2><?php the_title(); ?></h2>
                                </a>
                                <?php
                                // Display featured image at 200x300 size
                                if ( has_post_thumbnail() ) {
                                    the_post_thumbnail( 'image-size' );
                                }
                                ?>
                                <p><?php the_content(); ?></p>
                            </article>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                }
            endif;
        // endwhile;

        the_posts_navigation();

    else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();
?>