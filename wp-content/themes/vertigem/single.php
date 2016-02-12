<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package teste
 */
get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-sm-18 col-md-15">

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                    <?php
                    while (have_posts()) : the_post();

                        get_template_part('template-parts/content', get_post_format());
                        ?>
<!--                        <div class="pull-left passador-unico">
                            <?php //previous_post_link(); ?>    
                        </div>
                        <div class="pull-right passador-unico">
                            <?php //next_post_link(); ?>
                        </div>-->


                        <div class="clearfix"></div>
                        <?php
                    endwhile; // End of the loop.
                    ?>

                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
        <div class="col-sm-18 col-md-3 last-five">
            
            <?php get_template_part('template-parts/content', 'last-3'); ?>


        </div><!--sidebar-->
    </div>
</div><!-- .container -->

<?php
//get_sidebar();
get_footer();
