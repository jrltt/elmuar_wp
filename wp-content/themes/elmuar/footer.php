<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Elisa_Murcia_Artengo
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php echo date(Y); ?>
			<span class="sep"> – </span>
			<?php bloginfo('name'); ?>
			<span class="sep"> – </span>
			&copy; All Rights Reserverd
			<span class="sep"> – </span>
			<a href="/info/contact">Contact</a>
			<span class="sep"> – </span>
			<?php printf( esc_html__( 'Website by %1$s.', 'elmuar' ), '<a href="http://jrltt.net" rel="designer">jrltt</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
