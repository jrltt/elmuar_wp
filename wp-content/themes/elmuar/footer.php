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
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<p><?php echo date(Y); ?>
			<span class="sep"> – </span>
			<?php bloginfo('name'); ?>
			&copy; All Rights Reserverd<br/>
			<a href="/info/contact">Contact</a>
			<span class="sep"> – </span>
			<?php printf( esc_html__( 'Website by %1$s.', 'elmuar' ), '<a href="http://jrltt.net" rel="designer">jrltt</a>' ); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div><!-- #content -->
</div><!-- #page -->
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.js"></script>

<!-- <script src="<?php //echo get_template_directory_uri() . '/js/jquery.zoomooz.js' ?>"></script> -->
<?php wp_footer(); ?>
</body>
</html>
