<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row item-colunista">
    <div class="col-sm-18">
        <div class="colunista-wrap">
            <div class="dados-coluna">
                <div class="foto-equipe">
                    <?php the_post_thumbnail('foto-equipe') ?>
                </div>
                <div class="nome-equipe">
                    <?php the_title('<h2 class="tipo2">', '</h2>'); ?>
                </div>

            </div>
            <div class="descricao-coluna tipo50">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>