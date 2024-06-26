<?php
/** 
 * My Theme Function
 **/

//  Theme Title: 
add_theme_support('title-tag');

 

//Theme CSS and JQuery File calling.
function get_css_js_file () {
    wp_enqueue_style('wl-style', get_stylesheet_uri());
    wp_register_style('bootstrap',get_template_directory_uri().'/css/bootstrap.css', array(), '5.0.2', 'all');
    wp_enqueue_style('bootstrap');   
    
    wp_register_style('custom',get_template_directory_uri().'/css/custom.css', array(), '1.0.0', 'all');
    wp_enqueue_style('custom');
}

//JQuery
wp_enqueue_script('jquery');
wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.js', array(), '5.0.2', true);
wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array(), '1.0.0', true);
add_action('wp_enqueue_scripts', 'get_css_js_file');


//Google Fonts Enqueue
function add_google_fonts(){
    wp_enqueue_style('google_fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital@0;1&family=Oswald&display=swap', false);
}
add_action('wp_enqueue_scripts', 'add_google_fonts');



//Theme Function
function theme_customize_register($wp_customize){
    $wp_customize->add_section('header_area', array(
        'title' =>__('Header Area', 'abdullah'),
        'description' => 'If you interested to update your header area,  you can do it here.'
    ));

    $wp_customize->add_setting('logo', array(
        'default' => get_bloginfo('template_directory').'/img/logo.png',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label' => 'Upload Logo',
        'description' => 'If you interested, you can change your logo here.',
        'setting' => 'logo',
        'section' => 'header_area',
    )));

    //Menu Positon Options
    $wp_customize-> add_section('menu_option', array(
        'title' => __('Menu Positon Option', 'abdullah'),
        'description' => 'If you interested to change your menu position you can do it here. '
    ));

    $wp_customize-> add_setting('menu_position', array(
        'default' => 'right_menu',
    ));

    $wp_customize-> add_control('menu_position', array(
        'label' => 'Menu Positon',
        'description' => 'Select your menu positon',
        'setting' => 'menu_position',
        'section' => 'menu_option',
        'type'=> 'radio',
        'choices' => array(
            'left_menu' => 'Left Menu',
            'right_menu' => 'Right Menu',
            'center_menu' => 'Center Menu',
        )
    ));
}

add_action('customize_register','theme_customize_register');


//Menu Register
register_nav_menu('main_menu', __('Main Menu','abdullah'));


function me_nav_description($item_output, $item, $args){
    if (!empty($item->description)) {
        $item_output = str_replace($args->link_before  . '</a>', '<span class="walker_nav">' . $item->description . '</span>' . '</a>' , $item_output);
        
    }
    return $item_output;
}

add_filter('walker_nav_menu_start_el', 'me_nav_description', 10, 3);




