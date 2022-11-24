<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Underscores_Bootstrap
 */

get_header();
?>

<div class="container">
	<div class="h-100 p-3 bg-light border rounded-3 m-3">
		<div class="text-center">
		<img src="<?php echo get_theme_file_uri( 'datas/Thierry_Charriot.jpg' ); ?>" alt="" style="max-width: 180px; height: auto; border-radius: 50% / 50%;" class="m-3">
		<h1 class="fw-bold text-secondary">Développeur Web Web Mobile</h1>
		<p class="fw-bold">Thierry Charriot</p>
		<a href="<?php echo get_theme_file_uri( 'datas/CV_Thierry_Charriot.pdf' ); ?>" class="btn btn-success" type="button">Télécharger mon CV!</a>
		</div>
	</div>
</div>

<div class="container">
<div class="row">

	<main id="primary" class="site-main col-12 col-md-12">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				* Include the Post-Type-specific template for the content.
				* If you want to override this in a child theme, then include a file
				* called content-___.php (where ___ is the Post Type name) and that will be used instead.
				*/
				get_template_part( 'template-parts/content-portfolio', get_post_type() );

			endwhile;

			//the_posts_navigation();
			/**
			 * Load pagination in functions.php
			 */
			underscores_pagination ();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

	<?php
	//get_sidebar();
	?>

</div><!-- row-->
</div><!-- container -->

<div class="parallax parallax-001 mt-3 mb-3"></div>

<h2 class="fw-bold text-secondary text-center">Réalisations</h2>

<div class="container-md">
	<div class="row">

		<?php
			/**
			 * https://developer.wordpress.org/reference/classes/wp_query/
			 * WP_Query
			 * The WordPress Query class.
			 */
			$args = array(
				'post_type' => 'realisation',
				'posts_per_page' => 18,
				'orderby' => 'title',
				'order'   => 'DESC', 
				#'order'   => 'ASC',
			);
			// The Query
			$loop = new WP_Query( $args );
			//var_dump( $loop->get_posts() ); // Debug OK
			/**
			 * https://developer.wordpress.org/reference/functions/have_posts/
			 * have_posts()
			 * Determines whether current WordPress query has posts to loop over.
			 */
			while( $loop->have_posts() ): $loop->the_post();
		?>

		<div class="col-md-4">
			<div class="card border-dark mb-3">
				<?php 
					/**
					 * https://developer.wordpress.org/reference/functions/the_post_thumbnail/
					 * the_post_thumbnail( string|int[] $size = 'post-thumbnail', string|array $attr = '' )
					 * Displays the post thumbnail.
					 */
					if ( has_post_thumbnail() ) : 
				?>
					<!--<a href="<?php #the_permalink(); ?>" title="<?php #the_title_attribute(); ?>">-->
						<?php the_post_thumbnail(); ?>
					<!--</a>-->
				<?php endif; ?>
				<div class="card-body">
					<h3 class="card-title"><?php the_title(); ?></h3>
					<p class="card-text"><?php the_content(); ?></p>
				</div><!--/card-body-->
			</div>
		</div><!--/col-md-4-->

		<?php
			/**
			 * https://developer.wordpress.org/reference/functions/wp_reset_postdata/
			 * wp_reset_postdata()
			 * After looping through a separate query, this function restores the $post global to the current post in the main query
			 */
			endwhile; wp_reset_postdata();
		?>

	</div><!--/row-->
</div><!--/container-md-->

<div class="parallax parallax-002 mt-3 mb-3"></div>

<h2 class="fw-bold text-secondary text-center">Formations</h2>

<div class="container-md">
	<div class="row">

		<?php
			/**
			 * https://developer.wordpress.org/reference/classes/wp_query/
			 * WP_Query
			 * The WordPress Query class.
			 */
			$args = array(
				'post_type' => 'formation',
				'posts_per_page' => 18,
				'orderby' => 'date',
				'order'   => 'DESC', 
				#'order'   => 'ASC',
			);
			// The Query
			$loop = new WP_Query( $args );
			//var_dump( $loop->get_posts() ); // Debug OK
			/**
			 * https://developer.wordpress.org/reference/functions/have_posts/
			 * have_posts()
			 * Determines whether current WordPress query has posts to loop over.
			 */
			while( $loop->have_posts() ): $loop->the_post();
		?>

		<div class="col-md-6">
			<div class="card border-success mb-3">
				<div class="card-body">
					<h3 class="card-title"><?php the_title(); ?></h3>							
					<span class="entry-date"><?php echo get_the_date(); ?></span>
					<p class="card-text"><?php the_content(); ?></p>
				</div><!--/card-body-->
			</div>
		</div><!--/col-md-4-->

		<?php
			/**
			 * https://developer.wordpress.org/reference/functions/wp_reset_postdata/
			 * wp_reset_postdata()
			 * After looping through a separate query, this function restores the $post global to the current post in the main query
			 */
			endwhile; wp_reset_postdata();
		?>

	</div><!--/row-->
</div><!--/container-md-->

<div class="parallax parallax-005 mt-3"></div>

<?php
get_footer();
