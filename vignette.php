<?php
/*
 *	Plugin Name: Vignette
 *	Plugin URI: http://www.timseverien.nl
 *	Description: Plugin that adds a vignette to your layout
 *	Author: Tim Severien
 *	Version: 0.1
 *	Author URI: http://www.timseverien.nl
 */
 
new Vignette;

class Vignette {
	public function __construct() {
		register_activation_hook(__FILE__, array(&$this, 'install'));
		register_deactivation_hook(__FILE__, array(&$this, 'uninstall'));
		
		add_action('admin_menu', array(&$this, 'admin_settings'));
		add_action('get_header', array(&$this, 'load_css'));
		add_action('wp_footer', array(&$this, 'load_vignette'));
	}
	
	public function install() {
		add_option('vignette_css_ver', 'css2');
		add_option('vignette_opacity', 4);
		add_option('vignette_size', 'medium');
	}
	
	public function uninstall() {
		delete_option('vignette_css_ver');
		delete_option('vignette_opacity');
		delete_option('vignette_size');
	}
	
	public function load_css() {
		$version = get_option('vignette_css_ver');
		_e('<link type="text/css" rel="stylesheet" href="'.get_bloginfo('wpurl').'/wp-content/plugins/vignette/css/vignette-'.strtolower($version).'.css" />' . "\n");
	}
	
	public function load_vignette() {
		$version = get_option('vignette_css_ver');
		$opacity = get_option('vignette_opacity');
		$size = get_option('vignette_size');
		$path = get_bloginfo('wpurl').'/wp-content/plugins/vignette/images/';
		
		if($version == 'css3') {
			_e('<div class="vignette" style="background-image: url(\'../images/'.$size.'/'.$opacity.'-top-left.png\'), url(\'../images/'.$size.'/'.$opacity.'-top-right.png\'), url(\'../images/'.$size.'/'.$opacity.'-bottom-left.png\'), url(\'../images/'.$size.'/'.$opacity.'-bottom-right.png\');"></div>');	
		} else {
			_e('<div class="vignette vignette-'.$size.'" style="background-image: url(\''.$path.$size.'/'.$opacity.'-bottom-left.png\'); left: 0; bottom: 0;"></div><div class="vignette vignette-'.$size.'" style="background-image: url(\''.$path.$size.'/'.$opacity.'-bottom-right.png\'); right: 0; bottom: 0;"></div><div class="vignette vignette-'.$size.'" style="background-image: url(\''.$path.$size.'/'.$opacity.'-top-left.png\'); left: 0; top: 0;"></div><div class="vignette vignette-'.$size.'" style="background-image: url(\''.$path.$size.'/'.$opacity.'-top-right.png\'); right: 0; top: 0;"></div>');
		}
	}
	
	public function admin_settings() {
		add_options_page('Vignette settings', 'Vignette', 'manage_options', 'vignette', array(&$this, 'load_admin_page'));
	}
	
	public function load_admin_page() {
		require 'vignette_admin.php';
	}
}
?>