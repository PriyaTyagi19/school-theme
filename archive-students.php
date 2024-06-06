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

    <main id="primary" class="site-main archive-page">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                the_archive_title( '<h1 class="page-title">', '</h1>' );
                the_archive_description( '<div class="archive-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <?php
            // Custom query to retrieve all students
            $args = array(
                'post_type'      => 'students', 
                'posts_per_page' => -1, // Retrieve all posts
                'orderby' => 'title',
                'order' => 'ASC',
            );
            $query = new WP_Query( $args );
            
             while ( have_posts() ) :
                the_post();
    
                // Display student content
            ?>
                <div class="student-list">
                    <article class="student-item">
                        
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    
                        <div class="student-image">
                            <?php
                            // Display featured image
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'image-size');
                            }
                            ?>
                        </div>
    
                        <div class="student-excerpt">
                            <?php
                            // Display excerpt wth custom length
                            if ( is_archive() ) {
                                echo wp_trim_words( get_the_excerpt(), 25 );
                                echo '<p><a class="read-more" href="' . get_permalink() . '">Read More about the Student</a></p>';
                            } else {
                                the_content();
                            }
                            ?>
                        </div>

                        <div class="student-speciality">
                            <?php
                            // Display taxonomy terms
                            $terms = get_the_terms( get_the_ID(), 'school-Student-Taxonomy' ); 
                            if ( $terms && ! is_wp_error( $terms ) ) {
                                echo '<div>';
                                foreach ( $terms as $term ) {
                                    echo "<p>Speciality:</p>";
                                    echo '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a> ';
                                }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </article> 
                </div>
            
            <?php
            endwhile;

            the_posts_navigation();

        else :

            get_template_part( 'template-parts/content', 'none' );

        endif;
        ?>

    </main><!-- #main -->

<?php
get_footer();
?>
