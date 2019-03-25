<?php
/*
Plugin Name: Testimonials
Plugin URI:  https://wordpress.org/plugins/
Description: Custom Plugin Development
Text Domain: testimonial-plugin
Version:     1.0
 */
defined('ABSPATH') or die('You can\t access this file');

/* Include Form Files */
require_once plugin_dir_path(__FILE__) . '/includes/tp-form.php';
require_once plugin_dir_path(__FILE__) . '/includes/tp-submit.php';
require_once plugin_dir_path(__FILE__) . '/includes/tp-settings.php';
require_once plugin_dir_path(__FILE__) . '/includes/tp-admin-options.php';
require_once plugin_dir_path(__FILE__) . '/includes/tp-display.php';

	class Testimonails {
		function __construct() {
			add_action('init', array($this, 'tp_cpt'));
			add_filter('manage_testimonial_posts_columns', 'ST4_columns_head_only_testimonials');
			add_action('manage_testimonial_posts_custom_column', 'ST4_columns_content_only_testimonials');
			add_action('manage_testimonial_custom_column', array($this, 'tp_columns'));
			add_action('init', array($this, 'tp_post_status'));
			add_action( 'init', array( $this, 'tp_init' ) );
		}

		function tp_register() {
			add_action('admin_enqueue_scripts', array($this, 'tp_enqueue'));
		}

		function tp_activate() {
			$this->tp_cpt();
			//
			flush_rewrite_rules();
		}

		function tp_deactivate() {
			//
			flush_rewrite_rules();
		}

		function tp_cpt() {
			add_post_type_support('testimonial', 'thumbnail');
			register_post_type('testimonial', [
				'public' => true,
				'label' => 'Testimonials',
				'menu_icon' => 'dashicons-admin-generic',
				'capability_type' => 'post',
				'capabilities' => array(
					'create_posts' => 'do_not_allow',
				),
				'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts
			]);
		}

		function tp_enqueue() {
			// enqueue all our scripts
			wp_enqueue_style('tpstyles', plugins_url('/assets/css/tp-style.css', __FILE__));
			wp_enqueue_script('tpscript', plugins_url('/assets/js/tp-script.js', __FILE__));
		}
		function tp_post_status() {

			if (isset($_REQUEST['submit'])) {
				$id = $_REQUEST['id'];
				$post_status = $_REQUEST['submit'];
				$pending = array(
					'ID' => $id,
					'post_status' => 'publish',
				);
				wp_update_post($pending);

				if ($post_status == 'publish') {

					$publish = array(
						'ID' => $id,
						'post_status' => 'pending',
					);
					wp_update_post($publish);
				} else {

				}
			} else {

			}
		}
		function tp_init() {

			if ( function_exists( 'load_plugin_textdomain' ) ) {
			load_plugin_textdomain( 'testimonial-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
			}

			}
		function tp_columns($post_status) {
			global $post;
			switch ($post_status) {
			case 'ID':
				$ID = get_the_ID();
				echo $ID;
				break;
			case 'status':
				$status = get_post_status();
				?>
			<?php
			break;
			}
		}
	}
	if (class_exists('Testimonails')) {
		$testimonialsplugin = new Testimonails();
		$testimonialsplugin->tp_register();
	}

register_activation_hook(__FILE__, array($testimonialsplugin, 'activate'));
register_deactivation_hook(__FILE__, array($testimonialsplugin, 'deactivate'));
