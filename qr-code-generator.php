<?php
/*

Plugin Name: QR Code Generator
Description: Simple QR Code Generator Plugin for any Website or any URL.
Version: 1.0
Author: Akanksha Jain
Author URI: https://github.com/akankshajain99
Plugin URI: https://github.com/akankshajain99/WP-QRC-Generator

*/

define('QRCG_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

//display form at frontend side

add_shortcode("qr_code_generator", "qrcg_form_handler");

function qrcg_form_handler()
{
	ob_start();

	include_once QRCG_PLUGIN_DIR_PATH.'template/qrc_form.php';

	$template = ob_get_contents();

	ob_end_clean();

	return $template;
}

//add script files

add_action("wp_enqueue_scripts", "qrcg_add_script_file");

function qrcg_add_script_file()
{
	wp_register_script( 'qrcodejs', 'https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js' );
	wp_enqueue_script('qrcodejs');

	wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-3.5.1.js' );
	wp_enqueue_script('jQuery');

	wp_enqueue_script("qrcg-script-js", plugin_dir_url(__FILE__)."assets/script.js", array("jquery"));
}

//add style files

add_action("wp_enqueue_scripts", "qrcg_add_style_file");

function qrcg_add_style_file()
{
	wp_register_style( 'Bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css' );
	wp_enqueue_style('Bootstrap');
}

//display shortcode at backend side

add_action("admin_menu", "qrcg_create_admin_menu");

function qrcg_create_admin_menu()
{
	add_menu_page("QR Code Generator", "QRCG", "manage_options", "qrcg", "qrcg_show_shortcode", "dashicons-shortcode", 8);
}

function qrcg_show_shortcode()
{
	ob_start();

	include_once QRCG_PLUGIN_DIR_PATH.'template/qrc_shortcode.php';

	$template = ob_get_contents();

	ob_end_clean();

	echo $template;
}


?>