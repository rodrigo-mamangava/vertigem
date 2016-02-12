<?php
/*
 * Template name: Colunistas
 */

get_header();


$args = array(
    'post_type' => 'coluna',
    'posts_per_page' => -1,
    'order' => 'asc',
    'orderby' => 'name',
);

// The Query
$the_query = new WP_Query($args);

//debug($the_query);
?>
<div class="container">
    <div class="row">
        <div class="col-sm-18 col-md-15">

            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
                    <div class="page-colunistas">                       
                        <?php include 'template-parts/colunista-descricao.php'; ?>
                    </div>

            </div>
        </div>
    </div>
</div>

<?php
/* Restore original Post Data */
wp_reset_postdata();
?>

<?php
get_footer();
