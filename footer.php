<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores_Bootstrap
 */

?>
	<a href="#page" class="btn btn-warning" id="up-button" title="Clic pour remonter en haut de cette satanée page">Go back up</a>

	<footer id="colophon" class="site-footer  bg-success text-white">

		<div class="container">
				<div class="row">

				<div class="site-info col-8">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'underscores-bootstrap' ) ); ?>">
						<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( 'Proudly powered by %s', 'underscores-bootstrap' ), 'WordPress' );
						?>
					</a>
					<span class="sep"> | </span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'underscores-bootstrap' ), 'underscores-bootstrap', '<a href="http://underscores.me/">Thierry Charriot</a>' );
						?>
				</div><!-- .site-info -->

				<div class="col-4">
					<?php 
						// https://developer.wordpress.org/reference/functions/is_active_sidebar/
						// is_active_sidebar( string|int $index )
						// Determines whether a sidebar contains widgets.
						if( ! is_active_sidebar( 'sidebar-2' ) ) {
							#return;
						} 
						dynamic_sidebar( 'sidebar-2' );
					?>
				</div><!--/col-4-->

			</div><!-- row -->
		</div><!-- container -->

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script>      
	window.onscroll = function () {
		showButton()
	};

	function showButton() {	
		let elem = document.getElementById( 'up-button' );
		let nombrePixels = window.pageYOffset | document.body.scrollTop;
		
		if ( nombrePixels > 360 ) {
			elem.style.display = 'block';
		} else if ( nombrePixels <= 360 ) {
			elem.style.display = 'none';
		}
	}
</script>

</body>
</html>
