<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

	<?php
		while ( have_posts() ) :
			the_post();

			// get_template_part( 'template-parts/content', get_post_type() );

			?>

			<article id="post-<?php the_ID(); ?>">
				<h1><?php the_title(); ?></h1>
				<?php the_post_thumbnail('image-size'); ?>
				<p><?php the_content();?></p>
			</arcticle>

			<article>
			<?php
            // Retrieve terms of the taxonomy attached to the post
			$terms = get_the_terms(get_the_ID(), 'student-taxonomy');
			if( $terms && ! is_wp_error( $terms )) :

			?>
			<h3>Meet other <?php ($terms); ?>students:</h3>
			<ul>
			<?php
				// Loop through each term and display links to other students in the same category
				foreach ( $terms as $term ) {
					$term_args = array(
						'post_type'      => 'students', 
						'posts_per_page' => 2, 
						'tax_query'      => array(
							array(
								'taxonomy' => 'student-taxonomy', // Replace 'student_category' with your taxonomy slug
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
						),
					);
					$term_query = new WP_Query( $term_args );
					if ( $term_query->have_posts() ) :
						while ( $term_query->have_posts() ) : $term_query->the_post();
							?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php
						endwhile;
					endif;
					wp_reset_postdata();
				}
				?>
			</ul>
			<?php  endif; ?>
			</article>

			<?php
		endwhile; // End of the loop.
		?>
		


	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
