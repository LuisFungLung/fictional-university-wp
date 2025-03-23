<?php

/* 
    Plugin Name: Are you Paying Attention Quiz
    Description: Give your readers a multiple choice question.
    Version: 1.0
    Author: Luis
    Author URI: https://github.com/LuisFungLung
    
*/

if ( ! defined('ABSPATH') ) exit; // Exit if accessed directly

class AreYouPayingAttention {

    function __construct() {
        // add_action('enqueue_block_editor_assets', array($this, 'adminAssets'));
        add_action('init', array($this, 'adminAssets'));
    }

    function adminAssets() {
        /* Old way to use plugin */
        // wp_enqueue_script('ournewblocktype',plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks','wp-element'));

        /* Similar way to use the plugin */
        // wp_register_style('quizeditcss',plugin_dir_url(__FILE__) . 'build/index.css');
        // wp_register_script('ournewblocktype',plugin_dir_url(__FILE__) . 'build/index.js', array('wp-blocks','wp-element','wp-editor'));
        // register_block_type('ourplugin/are-you-paying-attention', array(
        //     'editor_script' => 'ournewblocktype',
        //     'editor_style'=> 'quizeditcss',
        //     'render_callback' => array($this, 'theHTML')
        // ));
        
        register_block_type(__DIR__, array(          
            'render_callback' => array($this, 'theHTML')
        ));
       
    }

    function theHTML($attributes){
        /* Old way to use plugin */
        // return '<h2>Today the sky is completely' . $attributes['skyColor'] . ' and the grass is '. $attributes['grassColor'] .' !!!.</h2>';

        if ( !is_admin() ) {
            /* Does not work, but it was written this way in the course */
            // wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element'), '1.0', true);
            wp_enqueue_script('attentionFrontend', plugin_dir_url(__FILE__) . 'build/frontend.js', array('wp-element', 'wp-blocks'));

            /* Similar way to use the plugin */
            // wp_enqueue_style('attentionFrontendStyles', plugin_dir_url(__FILE__) . 'build/frontend.css');
        }
      
        ob_start(); ?>
        <div class="paying-attention-update-me"> <pre style="display: none;"><?php echo wp_json_encode($attributes) ?></pre> </div>
        <?php return ob_get_clean();
    }

}

$areYouPayingAttention = new AreYouPayingAttention();