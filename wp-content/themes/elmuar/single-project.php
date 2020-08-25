<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Elisa_Murcia_Artengo
 */
get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main one-column" role="main">
			<nav class="navigation back-to">
				<?php
					printf( __( '<a class="back-to__link" href="%1$s"><div class="cross-container"><span class="cross"></span></div></a>', 'elmuar' ),
				        esc_url( jrltt_back_to() )
				    );
				?>
			</nav>
			<?php
			while (have_posts()) : the_post();
				get_template_part('template-parts/content-project-single');
			endwhile; // End of the loop.
			?>
		</main>
	</div>

<?php
get_footer();
