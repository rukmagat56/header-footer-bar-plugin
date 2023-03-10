<?php
  /*
  Plugin Name: Bar Plugin
  Plugin uri: www.bar-plugin.com
    Description: This popup is used for popup modal which show three random posts.
    Version: 1.0.0
    Requires at least: 4.0 
    requires php: 5.0
    author: Sunder Kandel
    Author uri:https://github.com/rukmagat56
    License: General public license
    License URI: www.general.com
    text domain:bar
    domain path:/languages
 */


function popup_scripts()
  {
    //wp_enqueue_script('scripts', plugins_url('/assets/js/myscript.js', __FILE__));
    wp_enqueue_style('styless', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css', array(), '5.3', 'all');
    wp_enqueue_script('cdmm', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js', array(), '5.3', true);
    wp_enqueue_script('cdd', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js', array(), '3.6', true);
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-script-handle', plugins_url('my-script.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
    wp_enqueue_style( 'style.css', get_stylesheet_uri() );
  }
  add_action('wp_enqueue_scripts', 'popup_scripts');

include('admin/postMeta.php');
 
include('admin/bar-menu.php');

