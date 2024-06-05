<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			
			
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-theme' ), 'school-theme', '<a href="https://tylerjwhitman.com/school">Priya Tyagi & Tyler Whitman</a>' );
				?>
		</div><!-- .site-info -->
		<nav>
		<?php wp_nav_menu( array( 'theme_location' => 'footer-right' ) ); ?>
		</nav>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
