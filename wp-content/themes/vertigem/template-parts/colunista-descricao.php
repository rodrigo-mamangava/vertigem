<?php
// The Loop
if ($the_query->have_posts()) {

    while ($the_query->have_posts()) {
        $the_query->the_post();
        ?>

        <?php
        $autorColuna = get_field('autor_da_coluna');
        $nomeColuna = get_field('nome_coluna');
        $descricaoColuna = get_field('descricao');

        $urlColuna = site_url("/coluna/{$nomeColuna->slug}");
        ?>

        <div class="row item-colunista">
            <div class="col-sm-15">
                <div class="colunista-wrap">
                    <div class="dados-coluna">
                        <a href="<?php echo $urlColuna; ?>">
                            <div class="foto">
                                <?php echo($autorColuna['user_avatar']); ?>
                            </div>
                            <div class="nome">
                                <h2 class="tipo2">
                                    <?php echo($autorColuna['display_name']); ?>
                                </h2>
                                <p class="nome-coluna tipo4">
                                    <samp class="extra2">:</samp>
                                    <?php echo($nomeColuna->name); ?>
                                    <samp class="extra2">:</samp>
                                </p>
                            </div>

                    </div>
                    <div class="descricao-coluna tipo50">
                        <?php echo $descricaoColuna; ?>
                    </div>
                    </a>
                </div>
            </div>
        </div>

        <?php
    }
} else {
    // no posts found
}