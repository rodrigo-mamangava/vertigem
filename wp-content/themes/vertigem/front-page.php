<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vertigem
 */
get_header();
?>

<div class="container">
    <div class="row">
        <div class="col-sm-18 col-md-15">

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                    <!-- tres primeiros posts -->
                    <div class="row">
                        <?php $count = 0; ?>

                        <?php while (have_posts()) : the_post(); ?>
                            <?php if ($count == 0) : ?>

                                <div class="col-xs-18 col-sm-12">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if (has_post_thumbnail()) : ?>

                                            <div class="post-with-thumb post-destaque">
                                                <?php the_post_thumbnail('destaque-mobile-thumb', array('class' => 'visible-xs img-responsive')) ?>
                                                <?php the_post_thumbnail('destaque-thumb', array('class' => 'hidden-xs img-responsive')) ?>
                                                <div class="wrap-float">
                                                   <?php the_title('<h2 class="tipo31">', '</h2>') ?> 
                                                </div>
                                                
                                                <p class="cat-flag tipo9 <?php echo getOneCat(); ?>"><?php echo getOneCat(); ?></p>                                                    
                                            </div>
                                            
                                        <?php else: ?>
                                            <div class="post-no-thumb">
                                                <?php the_title('<h2 class="tipo30">', '</h2>') ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                            <?php elseif ($count == 1 || $count == 2): ?>                               
                                <div class="col-sm-6">
                                    <?php getPost(get_the_ID()); ?>
                                </div>

                            <?php else: ?>
                                <div class="col-sm-6">
                                    <?php getPost(get_the_ID()); ?>
                                </div>
                            <?php endif; ?>

                            <?php $count++; ?>

                        <?php endwhile; ?>
                        <!-- end of the loop -->
                    </div>


                    <!-- pagination here -->
                    <?php custom_pagination_mmgv(3); ?>

                    <?php wp_reset_postdata(); ?>


                </main><!-- #main -->
            </div><!-- #primary -->
        </div>
        <div class="col-xs-18 col-md-3 area-widget ">
            <?php get_sidebar(); ?>

        </div><!--sidebar-->
    </div>
</div><!-- .container -->

<?php
get_footer();
