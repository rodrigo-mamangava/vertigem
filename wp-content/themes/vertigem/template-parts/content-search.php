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

    <div class="capa-single">
        <?php the_post_thumbnail() ?>
        <?php if (getOneCat()) : ?>
            <p class="cat-flag tipo9 <?php echo getOneCat(); ?>"><?php echo getOneCat(); ?></p> 
        <?php endif; ?>
    </div>


    <?php the_title('<h1 class="">', '</h1>') ?>
    
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_sharing_toolbox"></div>

    <?php if (get_field('sub_titulo')) : ?>
        <h2><?php echo get_field('sub_titulo'); ?></h2>
    <?php endif; ?>

    <p class="post-meta-data item-hover">
        <?php vertigemMetaData(); ?>
    </p>


    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_sharing_toolbox"></div>

    <div class="row">

        <div class="col-sm-11">

            <div class="conteudo">
                <?php the_content(); ?>
            </div>

            <div class="dados-autor">
                <div class="descricao-autor">
                    <?php the_author_description(); ?> 
                </div>

            </div>
        
        </div>

    </div>



</article><!-- #post-## -->
