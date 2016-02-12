<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package vertigem
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content">
        <a href="<?php the_permalink(); ?>">
            <div class="row">

                <?php if (has_post_thumbnail()) : ?>

                    <div class="col-sm-11">
                        <?php the_post_thumbnail('capa-post-medio'); ?>

                        <?php if (getOneCat()) : ?>
                            <p class="cat-flag tipo9 <?php echo getOneCat(); ?>"><?php echo getOneCat(); ?></p> 
                        <?php endif; ?>

                    </div>  
                    <div class="col-sm-7">
                        <?php the_title('<h2>', '</h2>'); ?>
                        <p class="post-meta-data">
                            <?php vertigemMetaData(); ?>
                        </p>
                        <div class="conteudo">
                            <?php the_special_excerpt($post->ID, 340, '<span class="extra">{...}</span>'); ?>
                        </div>

                    </div>
                <?php else : ?>

                    <div class="col-sm-18">
                        <?php the_title('<h2>', '</h2>'); ?>
                        <p class="post-meta-data">
                            <?php vertigemMetaData(); ?>
                        </p>

                        <div class="conteudo">
                            <?php the_special_excerpt($post->ID, 450, '<span class="extra">{...}</span>'); ?>
                        </div>

                    </div>
                <?php endif; ?>

            </div>
        </a>


    </div><!-- .entry-content -->


</article><!-- #post-## -->
