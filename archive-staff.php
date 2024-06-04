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
			   $terms = get_terms( 
				array(
					'taxonomy' => 'school-Staff-Taxonomy',
				
				) 
			);
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$args = array(
						'post_type' 	 => 'staff',
						'posts_per_page' => -1,
						'tax_query'		 => array(
							array(
								'taxonomy' => 'school-Staff-Taxonomy',
								'field'	   => 'slug',
								'terms' => $term->slug
							)
						)
					);
					$query = new WP_Query( $args );
					if( $query -> have_posts() ) {
						echo'<section><h2>' . esc_html__($term->name) . '</h2>';
						while ( $query -> have_posts() ) {
							$query -> the_post();
							?>
							<article>
									<h2><?php esc_html(the_title()); ?></h2>
									<?php
									if ( function_exists( 'get_field' ) ) {
										if ( get_field( 'staff_biography' ) ) {
											
											the_field( 'staff_biography' );
										}
										if ( get_field( 'course' ) ) {
											
											the_field( 'course' );
										}
										if ( get_field( 'instructor_website' ) ) {
											
											the_field( 'instructor_website' );
										}
										}
										?>
						  
						</article>
						
							<?php
						}
						wp_reset_postdata();
						echo'</section>';
					}
				}
			}
			?>



			

<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
