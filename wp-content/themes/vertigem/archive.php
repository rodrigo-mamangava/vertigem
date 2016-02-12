<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vertigem
 */
get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-sm-18">

            <div id="primary" class="content-area">
                <main id="main" class="site-main categorias" role="main">

                    <?php if (have_posts()) : ?>

                        <?php
                        /* Start the Loop */
                        while (have_posts()) : the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part('template-parts/content', 'archive');

                        endwhile;

                        custom_pagination_mmgv(3);

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>

                </main><!-- #main -->
            </div><!-- #primary -->

        </div>
    </div>
</div>

<?php
get_footer();
