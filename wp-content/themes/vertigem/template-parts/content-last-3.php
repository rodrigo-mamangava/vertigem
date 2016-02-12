<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $post;

$cat = getOneCat();

$categories = get_the_category();
$nomeCat = $categories[0];
$nomeCat = $nomeCat->name;
//debug($nomeCat);

$args = array(
    'post_type' => array('post', 'artigo'),
    'posts_per_page' => 3,
    'order' => 'DESC',
    'orderby' => 'date',
    'category_name' => $nomeCat,
);

// The Query
$the_query = new WP_Query($args);
?>
<div class="last-3">
    <?php if ($the_query->have_posts()) : ?>
        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <a href="<?php echo get_permalink() ?>">
                <div class="item ">

                    <?php the_post_thumbnail('thumb') ?>

                    <?php the_title('<h2 class="titulo-post cat-' . $cat . '">', '</h2>'); ?>

                    <div class="conteudo-post">
                        <?php the_special_excerpt(get_the_ID(), 150, ' <span class="extra">{...}</span>'); ?>
                    </div>
                </div>
            </a>

        <?php endwhile ?>

    <?php else : ?>

        <p>Nenhum artigo foi encontrado!</p>

    <?php endif; ?>

</div>

<?php
wp_reset_postdata();

