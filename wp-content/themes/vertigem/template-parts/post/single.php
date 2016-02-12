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
    <header class="entry-header">
        <?php
        if (has_post_thumbnail()) {
            the_post_thumbnail('capa-post');
        }

        the_title('<h2 class="entry-title">', '</h2>');
        the_excerpt();
        ?>
        <p class="cat-flag <?php echo getOneCat(); ?>"><?php echo getOneCat(); ?></p>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <p class="post-meta-data item-hover">
            <?php vertigemMetaData(); ?>
        </p>
        <?php
        the_content(sprintf(
                        /* translators: %s: Name of current post. */
                        wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'vertigem'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
        ));

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'vertigem'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <div class="entry-footer">
        <p><?php the_author_description(); ?></p>
    </div>


</article><!-- #post-## -->
