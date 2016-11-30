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
			&copy; <?php _e( 'Tous les droits sont réservés', 'elmuar' ); ?><br/>
			<?php
			    printf( __( '<a href="%1$s">Contacto</a>', 'elmuar' ),
			        esc_url( (ICL_LANGUAGE_CODE == 'fr') ? '/fr/contact' : '/contacto' )
			    );
			?>
			<span class="sep"> – </span>
			<?php printf( esc_html__( 'Website %1$s.', 'elmuar' ), '<a href="https://jrltt.net" rel="develop">jrltt</a>' ); ?></p>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	</div><!-- #content -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
