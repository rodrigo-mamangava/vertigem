<?php

$nomeCuluno = get_query_var('coluna');

$args = array(
    'post_type' => 'coluna',
    'posts_per_page' => 1,
    'name' => $nomeCuluno
    
);

// The Query
$the_query = new WP_Query($args);

//debug($the_query);


?>
    <div class="container">
    <div class="row">
        <div class="col-sm-18 col-md-16">

            <div id="primary" class="content-area">
                <main id="main" class="site-main page-coluna" role="main">

                    <?php include 'colunista-descricao.php'; ?>

                    </div>

            </div>
        </div>
    </div>
</div>
    <?php



/* Restore original Post Data */
wp_reset_postdata();