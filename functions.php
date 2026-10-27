<?php

function hmtm_enqueue_styles() {
    wp_enqueue_style(
        'bootstrap',
        get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css',
        array(),
        null,
        'all'
    );

    wp_enqueue_style(
        'flex-slider',
        get_template_directory_uri() . '/assets/css/flex-slider.css',
        array(),
        null,
        'all'
    );

    wp_enqueue_style(
        'owl',
        get_template_directory_uri() . '/assets/css/owl.css',
        array(),
        null,
        'all'
    );

    wp_enqueue_style(
        'fontawesome',
        get_template_directory_uri() . '/assets/css/fontawesome.css',
        array(),
        null,
        'all'
    );

    wp_enqueue_style(
        'templatemo-stand-blog',
        get_template_directory_uri() . '/assets/css/templatemo-stand-blog.css',
        array('bootstrap', 'flex-slider', 'owl', 'fontawesome'),
        null,
        'all'
    );
}

function hmtm_enqueue_scripts() {
    wp_deregister_script('jquery');
    wp_register_script(
        'jquery',
        get_template_directory_uri() . '/vendor/jquery/jquery.min.js',
        array(),
        null,
        true
    );
    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'bootstrap-bundle',
        get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js',
        array('jquery'),
        null,
        true
    );

    wp_enqueue_script(
        'accordions',
        get_template_directory_uri() . '/assets/js/accordions.js',
        array('jquery'),
        null,
        true
    );

    wp_enqueue_script(
        'owl-js',
        get_template_directory_uri() . '/assets/js/owl.js',
        array('jquery'),
        null,
        true
    );

    wp_enqueue_script(
        'slick',
        get_template_directory_uri() . '/assets/js/slick.js',
        array('jquery'),
        null,
        true
    );

    wp_enqueue_script(
        'isotope',
        get_template_directory_uri() . '/assets/js/isotope.js',
        array('jquery'),
        null,
        true
    );

    wp_enqueue_script(
        'custom',
        get_template_directory_uri() . '/assets/js/custom.js',
        array('jquery', 'bootstrap-bundle', 'accordions', 'owl-js', 'slick', 'isotope'),
        null,
        true
    );
}

add_action('wp_enqueue_scripts', 'hmtm_enqueue_styles');
add_action('wp_enqueue_scripts', 'hmtm_enqueue_scripts');

function hmtm_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
}
add_action('after_setup_theme', 'hmtm_setup');

add_filter( 'use_widgets_block_editor', '__return_false' );

function hmtm_register_sidebar() {
    register_sidebar(array(
        'name' => 'Sidebar principal',
        'id' => 'main-sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="sidebar-heading"><h2>',
        'after_title' => '</h2></div>',
    ));
}
add_action('widgets_init', 'hmtm_register_sidebar');

function hmtm_wrap_widgets( $params ) {
    $itemClass = 'sidebar-item';

    if($params[0]['widget_id'] === 'search-2') { $itemClass .= ' search'; }

    if ( $params[0]['id'] !== 'main-sidebar' ) { return $params; }

    $params[0]['before_widget'] = '<div class="col-12"><div class="'. $itemClass. '">' . $params[0]['before_widget'];
    
    $params[0]['after_widget']  = $params[0]['after_widget'] . '</div></div>';

    return $params;
}
add_filter( 'dynamic_sidebar_params', 'hmtm_wrap_widgets' );

function hmtm_register_navmenu() {
    register_nav_menu('menu-principal', __('Menú Principal', 'homertema'));
}

add_action('after_setup_theme', 'hmtm_register_navmenu');

/**
 * ENLACES DEL MENÚ
 */
function hmtm_agregar_clase_li($classes, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location == 'menu-principal') {
        $classes[] = 'nav-item';
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'hmtm_agregar_clase_li', 10, 3);

function hmtm_agregar_clase_enlace($atts, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location == 'menu-principal') {
        // Si ya tiene clases, se las agregamos; si no, la creamos
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' nav-link' : 'nav-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'hmtm_agregar_clase_enlace', 10, 3);

function hmtm_clase_active_enlace($atts, $item, $args) {
    if (isset($args->theme_location) && $args->theme_location == 'menu-principal') {
        
        // Creamos la base de clases para el enlace (incluyendo 'nav-link')
        $clases_enlace = array('nav-link');

        // Si el ítem actual es la página activa, añadimos 'active'
        if (in_array('current-menu-item', $item->classes) || in_array('current_page_item', $item->classes)) {
            $clases_enlace[] = 'active';
        }

        // Unimos las clases y las asignamos
        $atts['class'] = implode(' ', $clases_enlace);
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'hmtm_clase_active_enlace', 10, 3);