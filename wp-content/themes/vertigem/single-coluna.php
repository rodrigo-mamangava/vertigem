<?php

/* 
 * Página adaptada para o LOOP de de colunas por nome-coluna
 */


get_header();

get_template_part( 'template-parts/colunista' );


$nomeCuluno = get_query_var('coluna');




$args = array(
    'post_type' => 'artigo',
    'posts_per_page' => 20,
    'order' => 'DESC',
    'orderby' => 'date',
    'paged' => $paged,
    'tax_query' => array(//(array) - use taxonomy parameters (available with Version 3.1).
        array(
            'taxonomy' => 'nome-coluna', //(string) - Taxonomy.
            'field' => 'slug', //(string) - Select taxonomy term by ('id' or 'slug')
            'terms' => $nomeCuluno, //(int/string/array) - Taxonomy term(s).
            'include_children' => true, //(bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
        ),
    ),
);

// The Query
$the_query = new WP_Query($args);



?>

<div class="container">
    <div class="row">
        <div class="col-sm-18">

            <div id="primary" class="content-area">
                <main id="main" class="site-main colunistas" role="main">

                    <?php if ($the_query->have_posts()) : ?>

                        <?php
                        /* Start the Loop */
                        while ($the_query->have_posts()) : $the_query->the_post();

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



