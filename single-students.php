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

	<main id="primary" class="site-main single-student">

	<?php
		while ( have_posts() ) :
			the_post();
			$curren_post_id = get_the_ID(); // Store the current post's ID

			// get_template_part( 'template-parts/content', get_post_type() );

			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h1><?php the_title(); ?></h1>
				<div class="post-thumbnail">
					<?php the_post_thumbnail('image-size'); ?>
				</div>
				<p><?php the_content();?></p>
			</article>

			<article>
			<?php
            // Retrieve terms of the taxonomy attached to the post
			$terms = wp_get_post_terms($curren_post_id, 'student-taxonomy');
			if( $terms && !is_wp_error( $terms )) :

				// Loop through each term and display links to other students in the same category
				foreach ( $terms as $term ) {
					$term_args = array(
						'post_type'      => 'students', 
						'posts_per_page' => -1, 
						'tax_query'      => array(
							array(
								'taxonomy' => 'student-taxonomy', 
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
						),
					);
					$term_query = new WP_Query( $term_args );
					if ( $term_query->have_posts() ) :
			?>
			<h3>Meet other <?php echo esc_html($term->name); ?> students:</h3>
			<ul>
			<?php
						while ( $term_query->have_posts() ) : $term_query->the_post();
							if (get_the_ID() == $curren_post_id) {
								continue;
							}
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
get_footer();
?>
