<?php
/**
 * vertigem functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package vertigem
 */
if (!function_exists('vertigem_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function vertigem_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on vertigem, use a find and replace
         * to change 'vertigem' to the name of your theme in all the template files.
         */
        load_theme_textdomain('vertigem', get_template_directory() . '/languages');

// Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('destaque-thumb', 755, 730, true);
        add_image_size('destaque-mobile-thumb', 410, 500, true);
        add_image_size('capa-thumb', 305, 205, true);
        add_image_size('capa-post', 1152, 660, true);
        add_image_size('capa-post-medio', 576, 430, true);
        add_image_size('foto-equipe', 130, 130, true);

// This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'vertigem'),
            'footer' => esc_html__('footer', 'vertigem'),
            'footer-social-menu' => esc_html__('footer-social-menu', 'vertigem'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

// Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('vertigem_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));
    }

endif;
add_action('after_setup_theme', 'vertigem_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function vertigem_content_width() {
    $GLOBALS['content_width'] = apply_filters('vertigem_content_width', 640);
}

add_action('after_setup_theme', 'vertigem_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function vertigem_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'vertigem'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'vertigem_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function vertigem_scripts() {
    wp_enqueue_style('vertigem-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
    wp_enqueue_style('vertigem-style', get_stylesheet_uri());

    wp_enqueue_script('jquery'); // Enqueue it!
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js');

    wp_enqueue_script('vertigem-toggle-capa', get_template_directory_uri() . '/js/toggle-capa.js', array('jquery'), '20160115', true);



    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'vertigem_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


// Register Custom Navigation Walker
require_once('wp_bootstrap_navwalker.php');

add_filter('widget_text', 'do_shortcode');

function debug($var) {
    echo "<pre>";
    var_dump($var);
    echo "<pre>";
}

function get_excerpt_by_id($post_id) {
    $the_post = get_post($post_id); //Gets post ID
    $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
    $excerpt_length = 500; //Sets excerpt length by word count
    $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
    $words = explode(' ', $the_excerpt, $excerpt_length + 1);

    if (count($words) > $excerpt_length) :
        array_pop($words);
        array_push($words, '…');
        $the_excerpt = implode(' ', $words);
    endif;

    $the_excerpt = '<p>' . $the_excerpt . '</p>';

    return $the_excerpt;
}

function the_special_excerpt($postId, $max, $continue) {
    $text = get_excerpt_by_id($postId);
    echo wp_html_excerpt($text, $max, $continue);
}

function vertigemDate() {
    global $post;
    return get_the_date('d &#8226; m &#8226; Y');
}

function vertigemMetaData() {
    global $post;
    ?>
    <span class="date-post tipo7b"><?php echo vertigemDate(); ?></span>
    <span class="date-post tipo7b barra"> | </span>
    <span class="author-post tipo10c">por</span>
    <span class="author-post tipo10b"><?php echo get_the_author(); ?></span>
    <?php
}

function getPost() {
    global $post;
    ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-with-thumb">
                    <?php the_post_thumbnail('capa-thumb') ?>  
                    <div class="post-capa-hover item-hover">
                        
                    </div>
                    <?php the_title('<h2 class="item31 item-hover">', '</h2>') ?>
                    <p class="cat-flag tipo9 <?php echo getOneCat(); ?>"><?php echo getOneCat(); ?></p> 
                    <p class="post-meta-data item-hover">
                        <?php vertigemMetaData(); ?>
                    </p>
                </div>                                       

                <div class="the_special_excerpt">
                    <?php the_special_excerpt($post->ID, 70, ' <span class="extra">{...}</span>'); ?>
                </div>


            <?php else: ?>
                <div class="post-no-thumb">
                    <?php the_title('<h2 class="item-hover item6">', '</h2>') ?>
                    <p class="post-meta-data item-hover">
                        <?php vertigemMetaData(); ?>
                    </p>
                </div>
                <div class="the_special_excerpt">
                    <?php the_special_excerpt($post->ID, 150, '{...}'); ?>
                </div>
            <?php endif; ?>
        </a>
    </div>
    <?php
}

function custom_pagination_mmgv($pagerange = '', $paged = '') {

    $numpages = $GLOBALS['wp_query']->max_num_pages;




    if (empty($pagerange)) {
        $pagerange = 2;
    }

    /**
     * This first part of our function is a fallback
     * for custom pagination inside a regular loop that
     * uses the global $paged and global $wp_query variables.
     * 
     * It's good because we can now override default pagination
     * in our theme, and use this function in default quries
     * and custom queries.
     */
    global $paged;
    if (empty($paged)) {
        $paged = 1;
    }
    if ($numpages == '') {
        global $wp_query;
        $numpages = $wp_query->max_num_pages;
        if (!$numpages) {
            $numpages = 1;
        }
    }

    /**
     * We construct the pagination arguments to enter into our paginate_links
     * function. 
     */
    $pagination_args = array(
        'base' => get_pagenum_link(1) . '%_%',
        'format' => 'page/%#%',
        'total' => $numpages,
        'current' => $paged,
        'mid_size' => 0,
        'end_size' => 5,
        'prev_text' => '',
        'next_text' => '<img src="' . get_template_directory_uri() . '/img/nav/mais_site.png"">',
        'type' => 'plain',
    );

    $paginate_links = paginate_links_mmgv($pagination_args);

    if ($paginate_links) {
        echo "<nav class='custom-pagination'>";
        //echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
        echo $paginate_links;
        echo "</nav>";
    }
}

/**
 * Retrieve paginated link for archive post pages.
 *
 * Technically, the function can be used to create paginated link list for any
 * area. The 'base' argument is used to reference the url, which will be used to
 * create the paginated links. The 'format' argument is then used for replacing
 * the page number. It is however, most likely and by default, to be used on the
 * archive post pages.
 *
 * The 'type' argument controls format of the returned value. The default is
 * 'plain', which is just a string with the links separated by a newline
 * character. The other possible values are either 'array' or 'list'. The
 * 'array' value will return an array of the paginated link list to offer full
 * control of display. The 'list' value will place all of the paginated links in
 * an unordered HTML list.
 *
 * The 'total' argument is the total amount of pages and is an integer. The
 * 'current' argument is the current page number and is also an integer.
 *
 * An example of the 'base' argument is "http://example.com/all_posts.php%_%"
 * and the '%_%' is required. The '%_%' will be replaced by the contents of in
 * the 'format' argument. An example for the 'format' argument is "?page=%#%"
 * and the '%#%' is also required. The '%#%' will be replaced with the page
 * number.
 *
 * You can include the previous and next links in the list by setting the
 * 'prev_next' argument to true, which it is by default. You can set the
 * previous text, by using the 'prev_text' argument. You can set the next text
 * by setting the 'next_text' argument.
 *
 * If the 'show_all' argument is set to true, then it will show all of the pages
 * instead of a short list of the pages near the current page. By default, the
 * 'show_all' is set to false and controlled by the 'end_size' and 'mid_size'
 * arguments. The 'end_size' argument is how many numbers on either the start
 * and the end list edges, by default is 1. The 'mid_size' argument is how many
 * numbers to either side of current page, but not including current page.
 *
 * It is possible to add query vars to the link by using the 'add_args' argument
 * and see {@link add_query_arg()} for more information.
 *
 * The 'before_page_number' and 'after_page_number' arguments allow users to
 * augment the links themselves. Typically this might be to add context to the
 * numbered links so that screen reader users understand what the links are for.
 * The text strings are added before and after the page number - within the
 * anchor tag.
 *
 * @since 2.1.0
 *
 * @global WP_Query   $wp_query
 * @global WP_Rewrite $wp_rewrite
 *
 * @param string|array $args {
 *     Optional. Array or string of arguments for generating paginated links for archives.
 *
 *     @type string $base               Base of the paginated url. Default empty.
 *     @type string $format             Format for the pagination structure. Default empty.
 *     @type int    $total              The total amount of pages. Default is the value WP_Query's
 *                                      `max_num_pages` or 1.
 *     @type int    $current            The current page number. Default is 'paged' query var or 1.
 *     @type bool   $show_all           Whether to show all pages. Default false.
 *     @type int    $end_size           How many numbers on either the start and the end list edges.
 *                                      Default 1.
 *     @type int    $mid_size           How many numbers to either side of the current pages. Default 2.
 *     @type bool   $prev_next          Whether to include the previous and next links in the list. Default true.
 *     @type bool   $prev_text          The previous page text. Default '« Previous'.
 *     @type bool   $next_text          The next page text. Default '« Previous'.
 *     @type string $type               Controls format of the returned value. Possible values are 'plain',
 *                                      'array' and 'list'. Default is 'plain'.
 *     @type array  $add_args           An array of query args to add. Default false.
 *     @type string $add_fragment       A string to append to each link. Default empty.
 *     @type string $before_page_number A string to appear before the page number. Default empty.
 *     @type string $after_page_number  A string to append after the page number. Default empty.
 * }
 * @return array|string|void String of page links or array of page links.
 */
function paginate_links_mmgv($args = '') {
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $url_parts = explode('?', $pagenum_link);

    // Get max pages and current page out of the current query, if available.
    $total = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $current = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

    // URL base depends on permalink settings.
    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    $defaults = array(
        'base' => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        'format' => $format, // ?page=%#% : %#% is replaced by the page number
        'total' => $total,
        'current' => $current,
        'show_all' => false,
        'prev_next' => true,
        'prev_text' => __('&laquo; Previous'),
        'next_text' => __('Next &raquo;'),
        'end_size' => 1,
        'mid_size' => 2,
        'type' => 'plain',
        'add_args' => array(), // array of query args to add
        'add_fragment' => '',
        'before_page_number' => '',
        'after_page_number' => ''
    );

    $args = wp_parse_args($args, $defaults);

    if (!is_array($args['add_args'])) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if (isset($url_parts[1])) {
        // Find the format argument.
        $format = explode('?', str_replace('%_%', $args['format'], $args['base']));
        $format_query = isset($format[1]) ? $format[1] : '';
        wp_parse_str($format_query, $format_args);

        // Find the query args of the requested URL.
        wp_parse_str($url_parts[1], $url_query_args);

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ($format_args as $format_arg => $format_arg_value) {
            unset($url_query_args[$format_arg]);
        }

        $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
    }

    // Who knows what else people pass in $args
    $total = (int) $args['total'];
    if ($total < 2) {
        return;
    }
    $current = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
    if ($end_size < 1) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ($mid_size < 0) {
        $mid_size = 2;
    }
    $add_args = $args['add_args'];
    $r = '';
    $page_links = array();
    $dots = false;

    //if ( $args['prev_next'] && $current && 1 < $current ) :
    $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
    $link = str_replace('%#%', $current - 1, $link);
    if ($add_args)
        $link = add_query_arg($add_args, $link);
    $link .= $args['add_fragment'];

    /**
     * Filter the paginated links for the given archive pages.
     *
     * @since 3.0.0
     *
     * @param string $link The paginated link URL.
     */
    $page_links[] = '<a class="prev page-numbers" href="' . esc_url(apply_filters('paginate_links', $link)) . '">' . $args['prev_text'] . '</a>';
    //endif;
    for ($n = 1; $n <= $total; $n++) :
        if ($n == $current) :
            $page_links[] = "<span class='page-numbers current'>" . $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number'] . "</span>";
            $dots = true;
        else :
            if ($args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size )) :
                $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                if ($add_args)
                    $link = add_query_arg($add_args, $link);
                $link .= $args['add_fragment'];

                /** This filter is documented in wp-includes/general-template.php */
                $page_links[] = "<a class='page-numbers' href='" . esc_url(apply_filters('paginate_links', $link)) . "'>" . $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number'] . "</a>";
                $dots = true;
            elseif ($dots && !$args['show_all']) :
                $page_links[] = '<span class="page-numbers dots">' . __('&hellip;') . '</span>';
                $dots = false;
            endif;
        endif;
    endfor;
    if ($args['prev_next'] && $current && ( $current < $total || -1 == $total )) :
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        if ($add_args)
            $link = add_query_arg($add_args, $link);
        $link .= $args['add_fragment'];

        /** This filter is documented in wp-includes/general-template.php */
        $page_links[] = '<a class="next page-numbers" href="' . esc_url(apply_filters('paginate_links', $link)) . '">' . $args['next_text'] . '</a>';
    endif;
    switch ($args['type']) {
        case 'array' :
            return $page_links;

        case 'list' :
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join("</li>\n\t<li>", $page_links);
            $r .= "</li>\n</ul>\n";
            break;

        default :
            $r = join("\n", $page_links);
            break;
    }
    return $r;
}

function getOneCat() {
    global $post;
    $categories = get_the_category();
    $cat = $categories[0];
    $cat = substr($cat->slug, 0, 4);
    $cat = ($cat == 'sem-') ? 'colu' : $cat;
    return $cat;
}

/**
 * Display search form.
 *
 * Will first attempt to locate the searchform.php file in either the child or
 * the parent, then load it. If it doesn't exist, then the default search form
 * will be displayed. The default search form is HTML, which will be displayed.
 * There is a filter applied to the search form HTML in order to edit or replace
 * it. The filter is 'get_search_form'.
 *
 * This function is primarily used by themes which want to hardcode the search
 * form into the sidebar and also by the search widget in WordPress.
 *
 * There is also an action that is called whenever the function is run called,
 * 'pre_get_search_form'. This can be useful for outputting JavaScript that the
 * search relies on or various formatting that applies to the beginning of the
 * search. To give a few examples of what it can be used for.
 *
 * @since 2.7.0
 *
 * @param bool $echo Default to echo and not return the form.
 * @return string|void String when $echo is false.
 */
function get_search_form_small($echo = true) {
    /**
     * Fires before the search form is retrieved, at the start of get_search_form().
     *
     * @since 2.7.0 as 'get_search_form' action.
     * @since 3.6.0
     *
     * @link https://core.trac.wordpress.org/ticket/19321
     */
    do_action('pre_get_search_form');

    $format = current_theme_supports('html5', 'search-form') ? 'html5' : 'xhtml';

    /**
     * Filter the HTML format of the search form.
     *
     * @since 3.6.0
     *
     * @param string $format The type of markup to use in the search form.
     *                       Accepts 'html5', 'xhtml'.
     */
    $format = apply_filters('search_form_format', $format);

    $search_form_template = locate_template('searchform.php');
    if ('' != $search_form_template) {
        ob_start();
        require( $search_form_template );
        $form = ob_get_clean();
    } else {
        if ('html5' == $format) {
            $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
            <input type="text" class="search-field" placeholder="" value="' . get_search_query() . '" name="s" title="' . esc_attr_x('Search for:', 'label') . '" />
            <button class="btn btn-default"><i class="fa fa-search"></i></button>
            <div class="clearfix"></div>
            </form>';
        } else {
            $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url('/')) . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s" />
		</form>';
        }
    }

    /**
     * Filter the HTML output of the search form.
     *
     * @since 2.7.0
     *
     * @param string $form The search form HTML output.
     */
    $result = apply_filters('get_search_form', $form);

    if (null === $result)
        $result = $form;

    if ($echo)
        echo $result;
    else
        return $result;
}

add_shortcode('buscar', 'get_search_form_small');

function get_search_form_mmgv_2($echo = true) {
    /**
     * Fires before the search form is retrieved, at the start of get_search_form().
     *
     * @since 2.7.0 as 'get_search_form' action.
     * @since 3.6.0
     *
     * @link https://core.trac.wordpress.org/ticket/19321
     */
    do_action('pre_get_search_form');

    $format = current_theme_supports('html5', 'search-form') ? 'html5' : 'xhtml';

    /**
     * Filter the HTML format of the search form.
     *
     * @since 3.6.0
     *
     * @param string $format The type of markup to use in the search form.
     *                       Accepts 'html5', 'xhtml'.
     */
    $format = apply_filters('search_form_format', $format);

    $search_form_template = locate_template('searchform.php');
    if ('' != $search_form_template) {
        ob_start();
        require( $search_form_template );
        $form = ob_get_clean();
    } else {
        if ('html5' == $format) {


            $form = '<form role="search" method="get" class="search-form" action="' . esc_url(home_url('/')) . '">
				<label>
					<input type="search" class="search-field" placeholder="' . esc_attr_x('Search &hellip;', 'placeholder') . '" value="' . get_search_query() . '" name="s"  />
				</label>
				
                                    <button type="submit" class="search-submit" value="' . esc_attr_x('Search', 'submit button') . '">
                                        <i class="fa fa-search"></i>                                        
                                    </button>
			</form>';
        } else {
            $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url(home_url('/')) . '">
				<div>
					<label class="screen-reader-text" for="s">' . _x('Search for:', 'label') . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="' . esc_attr_x('Search', 'submit button') . '" />
				</div>
			</form>';
        }
    }

    /**
     * Filter the HTML output of the search form.
     *
     * @since 2.7.0
     *
     * @param string $form The search form HTML output.
     */
    $result = apply_filters('get_search_form', $form);

    if (null === $result)
        $result = $form;

    if ($echo)
        echo $result;
    else
        return $result;
}

