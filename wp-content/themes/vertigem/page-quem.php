<?php
/*
 * Template name: Quem somos
 */

get_header();

$args = array(
    'post_type' => 'equipe',
    'posts_per_page' => -1,
    'order' => 'asc',
    'orderby' => 'name',
);

// The Query
$the_query = new WP_Query($args);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-18 col-md-15">

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">


                    <?php if ($the_query->have_posts()) : ?>

                        <?php
                        /* Start the Loop */
                        while ($the_query->have_posts()) : $the_query->the_post();

                            get_template_part('template-parts/content', 'quem-somos');

                        endwhile;

                        custom_pagination_mmgv(3);

                    else :

                        get_template_part('template-parts/content', 'none');

                    endif;
                    ?>




                </main>

            </div>
        </div>
    </div>
</div>


<?php wp_reset_postdata(); ?>



<?php
get_footer();
