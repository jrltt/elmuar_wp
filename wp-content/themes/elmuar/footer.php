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
<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				layer = document.getElementById( 'layer' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.getElementById( 'content' );

			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( layer, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			layer.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}

			}
		</script>
</body>
</html>
