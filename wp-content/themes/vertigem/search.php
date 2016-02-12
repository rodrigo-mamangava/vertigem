<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package vertigem
 */

get_header(); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-18">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
                    
                    <?php get_search_form_small(); ?>

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Resultado para | %s |', 'vertigem' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'archive' );
			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'sem-resultado' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
        
        </div>
    </div>
</div>

<?php

get_footer();
