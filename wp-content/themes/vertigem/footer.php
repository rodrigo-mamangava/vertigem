<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package vertigem
 */
?>

<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="footer-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <img 
                                src="<?php echo get_template_directory_uri() ?>/img/logo/logo_footer.png" 
                                alt="Vertigem" 
                                id="logo-footer"
                                >
                        </div>
                        <div class="col-sm-6 footer1">
                            <a>Assine a newsletter</a>
                            <p>Contato: <span>vertigem@gmail.com</span></p>
                            <p>Compartilhe</p>
                            <div class="footer-social">
                                <?php wp_nav_menu(array('theme_location' => 'footer-social-menu', 'menu_id' => 'footer-social-menu')); ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-sm-6 footer2">
                            <?php wp_nav_menu(array('theme_location' => 'footer', 'menu_id' => 'footer-menu')); ?>
                        </div>

                        <?php wp_footer(); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56b22c0c5e0f926f" async="async"></script>

</body>
</html>
